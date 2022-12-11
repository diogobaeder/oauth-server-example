<?php

namespace Diogobaeder\OauthServerExample\Repositories;

use Diogobaeder\OauthServerExample\Entities\AuthCode;
use League\OAuth2\Server\Entities\AuthCodeEntityInterface;
use League\OAuth2\Server\Repositories\AuthCodeRepositoryInterface;

class AuthCodeRepository implements AuthCodeRepositoryInterface
{
    public function getNewAuthCode(): AuthCodeEntityInterface
    {
        $code = new AuthCode();
        $code->setIdentifier("some-id");
        $code->setExpiryDateTime(\DateTimeImmutable::createFromFormat("Y-m-d","2300-01-01"));
        return $code;
    }

    public function persistNewAuthCode(AuthCodeEntityInterface $authCodeEntity): void
    {
        // Let's pretend we persist it.
    }

    public function revokeAuthCode($codeId): void
    {
        // No need to revoke in this example implementation.
    }

    public function isAuthCodeRevoked($codeId): bool
    {
        return false;
    }
}