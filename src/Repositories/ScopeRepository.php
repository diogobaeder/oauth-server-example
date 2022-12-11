<?php

namespace Diogobaeder\OauthServerExample\Repositories;

use Diogobaeder\OauthServerExample\Entities\Scope;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\ScopeEntityInterface;
use League\OAuth2\Server\Repositories\ScopeRepositoryInterface;

class ScopeRepository implements ScopeRepositoryInterface
{

    public function getScopeEntityByIdentifier($identifier): ScopeEntityInterface
    {
        return new Scope();
    }

    public function finalizeScopes(array $scopes, $grantType, ClientEntityInterface $clientEntity, $userIdentifier = null)
    {
        // Let's pretend there's nothing to do with the scopes, they're all fine.
    }
}