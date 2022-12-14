<?php

namespace App\Services;

use App\Clients\Integrations\IntegrationClientInterface;
use App\Clients\Integrations\LocalizaClient;
use App\Clients\Integrations\MovidaClient;
use App\Exceptions\InvalidClientException;
use Exception;

class FindIntegration {

    public function handle(string $company, int $id): array
    {
        $client = $this->getClient($company);
        
        $user = $client->findById($id);

        return $user;
    }

    private function getClient($company): IntegrationClientInterface
    {
        return match($company) {
            'movida'   => new MovidaClient,
            'localiza' => new LocalizaClient,
            default => throw InvalidClientException::invalidName()
        };  
    }        
}