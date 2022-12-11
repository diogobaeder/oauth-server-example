<?php

namespace Diogobaeder\OauthServerExample\Repositories;

use Diogobaeder\OauthServerExample\Entities\RefreshToken;
use League\OAuth2\Server\Entities\RefreshTokenEntityInterface;
use League\OAuth2\Server\Repositories\RefreshTokenRepositoryInterface;

class RefreshTokenRepository implements RefreshTokenRepositoryInterface
{

    public function getNewRefreshToken(): RefreshTokenEntityInterface
    {
        $token = new RefreshToken();
        $token->setIdentifier("some-id");
        $token->setExpiryDateTime(\DateTimeImmutable::createFromFormat("Y-m-d","2300-01-01"));
        return $token;
    }

    public function persistNewRefreshToken(RefreshTokenEntityInterface $refreshTokenEntity)
    {
        // Let's pretend we persist it.
    }

    public function revokeRefreshToken($tokenId)
    {
        // No need to revoke in this example implementation.
    }

    public function isRefreshTokenRevoked($tokenId)
    {
        return false;
    }
}