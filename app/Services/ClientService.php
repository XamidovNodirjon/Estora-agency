<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\ClientInterface;
use App\Repositories\ClientRepository;

class ClientService
{

    protected $clientRepository;

    public function __construct(ClientInterface $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }


    public function getAllClients()
    {
        return $this->clientRepository->all();
    }

    public function getClientDetails($id, $withProducts = true)
    {
        $client = $this->clientRepository->show($id, $withProducts);

        if (!$client) {
            throw new \Exception("Bunday mijoz mavjud emas");
        }

        return $client;
    }
}