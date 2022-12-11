<?php

namespace Diogobaeder\OauthServerExample\Repositories;

use Diogobaeder\OauthServerExample\Entities\AccessToken;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface;

class AccessTokenRepository implements AccessTokenRepositoryInterface
{

    public function getNewToken(ClientEntityInterface $clientEntity, array $scopes, $userIdentifier = null): AccessTokenEntityInterface
    {
        $token = new AccessToken();
        $token->setIdentifier("some-id");
        $token->setExpiryDateTime(\DateTimeImmutable::createFromFormat("Y-m-d","2300-01-01"));
        foreach ($scopes as $scope) {
            $token->addScope($scope);
        }
        return $token;
    }

    public function persistNewAccessToken(AccessTokenEntityInterface $accessTokenEntity): void
    {
        // Let's pretend we persist it.
    }

    public function revokeAccessToken($tokenId): void
    {
        // No need to revoke in this example implementation.
    }

    public function isAccessTokenRevoked($tokenId): bool
    {
        return false;
    }
}