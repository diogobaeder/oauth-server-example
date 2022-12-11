<?php

require __DIR__ . '/../vendor/autoload.php';

use Diogobaeder\OauthServerExample\Entities\UserEntity;
use Diogobaeder\OauthServerExample\Repositories\AccessTokenRepository;
use Diogobaeder\OauthServerExample\Repositories\AuthCodeRepository;
use Diogobaeder\OauthServerExample\Repositories\ClientRepository;
use Diogobaeder\OauthServerExample\Repositories\RefreshTokenRepository;
use Diogobaeder\OauthServerExample\Repositories\ScopeRepository;
use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\Exception\OAuthServerException;
use League\OAuth2\Server\Grant\AuthCodeGrant;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use \Defuse\Crypto\Key;

$clientRepository = new ClientRepository();
$scopeRepository = new ScopeRepository();
$accessTokenRepository = new AccessTokenRepository();
$authCodeRepository = new AuthCodeRepository();
$refreshTokenRepository = new RefreshTokenRepository();

// The keys below were created only for this example project, DO NOT USE IN PRODUCTION!
$privateKey = 'file://' . __DIR__ . '/../src/private.key';
$encryptionKey = 'def00000037bbc6e50d2cf28a0bafa9cbf69343f2ead7886d45a07ef913f26d26326405fda9026bf23ff097691643f3c9eaaf3ef63b21f51c756dd7d7e2b8e400fda3fda';

$server = new AuthorizationServer(
    $clientRepository,
    $accessTokenRepository,
    $scopeRepository,
    $privateKey,
    Key::loadFromAsciiSafeString($encryptionKey)
);

$grant = new AuthCodeGrant(
    $authCodeRepository,
    $refreshTokenRepository,
    new \DateInterval('PT10M')
);

$grant->setRefreshTokenTTL(new \DateInterval('P1M'));
$server->enableGrantType(
    $grant,
    new \DateInterval('P1M')
);



$app = AppFactory::create();

$app->get('/authorize', function (Request $request, Response $response) use ($server) {

    try {
        $authRequest = $server->validateAuthorizationRequest($request);

        $authRequest->setUser(new UserEntity()); // an instance of UserEntityInterface
        $authRequest->setAuthorizationApproved(true);

        return $server->completeAuthorizationRequest($authRequest, $response);

    } catch (OAuthServerException $exception) {
        return $exception->generateHttpResponse($response);

    } catch (\Exception $exception) {
        $body = $response->getBody();
        $body->write($exception->getMessage());
        return $response->withStatus(500)->withBody($body);

    }
});

$app->post('/access_token', function (Request $request, Response $response) use ($server) {

    try {
        return $server->respondToAccessTokenRequest($request, $response);

    } catch (\League\OAuth2\Server\Exception\OAuthServerException $exception) {
        return $exception->generateHttpResponse($response);

    } catch (\Exception $exception) {
        $body = $response->getBody();
        $body->write($exception->getMessage());
        return $response->withStatus(500)->withBody($body);
    }
});


$app->run();
