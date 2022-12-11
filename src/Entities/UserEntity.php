<?php

namespace Diogobaeder\OauthServerExample\Entities;

use League\OAuth2\Server\Entities\UserEntityInterface;

class UserEntity implements UserEntityInterface
{

    public function getIdentifier(): string
    {
        return "some-user-id";
    }
}