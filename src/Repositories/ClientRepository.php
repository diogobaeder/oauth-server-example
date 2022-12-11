<?php

namespace Diogobaeder\OauthServerExample\Repositories;

use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\ClientRepositoryInterface;
use Diogobaeder\OauthServerExample\Entities\Client;

class ClientRepository implements ClientRepositoryInterface{
    public function getClientEntity($clientIdentifier): ClientEntityInterface
    {
        return new Client();
    }

    public function validateClient($clientIdentifier, $clientSecret, $grantType): void
    {
        // Let's suppose the client is always valid.
    }
}