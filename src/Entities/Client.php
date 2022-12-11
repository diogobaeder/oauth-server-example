<?php

namespace Diogobaeder\OauthServerExample\Entities;

use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\Traits\ClientTrait;

/**
 * Just a hard-coded client implementation.
 */
class Client implements ClientEntityInterface
{
    use ClientTrait;

    function __construct()
    {
        $this->name = "Some name";
        $this->redirectUri = "https://some.uri.example.com";
    }

    public function getIdentifier(): string
    {
        return "some-id";
    }
}