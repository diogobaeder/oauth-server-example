<?php

namespace Diogobaeder\OauthServerExample\Entities;

use League\OAuth2\Server\Entities\ScopeEntityInterface;
use League\OAuth2\Server\Entities\Traits\ScopeTrait;

/**
 * This is just a hard-coded scope that always returns the same identifier.
 */
class Scope implements ScopeEntityInterface
{
    use ScopeTrait;

    public function getIdentifier(): string
    {
        return "some-scope";
    }
}