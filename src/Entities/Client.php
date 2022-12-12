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
        $this->redirectUri = "http://127.0.0.1:5000/authorize";
        $this->isConfidential = true;
    }

    public function getIdentifier(): string
    {
        return "some-id";
    }
}