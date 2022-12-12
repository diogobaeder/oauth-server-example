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
        $this->redirectUri = "http://localhost:8889/";
        $this->isConfidential = true;
    }

    public function getIdentifier(): string
    {
        return "some-id";
    }
}