<?php

declare(strict_types=1);

namespace Medine\ERP\Clients\Infrastructure\Repository;

use Illuminate\Support\Facades\DB;
use Medine\ERP\Clients\Domain\Contracts\ClientRepository;
use Medine\ERP\Clients\Domain\Entity\Client;
use Medine\ERP\Clients\Domain\ValueObjects\ClientId;

final class MySqlClientRepository implements ClientRepository
{

    public function save(Client $client): void
    {
        DB::table('clients')->insert([
            'id' => $client->id()->value(),
            'name' => $client->name()->value(),
            'lastname' => $client->lastname()->value(),
            'dni' => $client->dni()->value(),
            'dni_type' => $client->dniType()->value(),
            'client_type' => $client->clientType()->value(),
            'client_category' => $client->clientCategory()->value(),
            'frequent_client_number' => $client->frequentClientNumber()->value(),
            'state' => $client->state()->value(),
            'created_at' => $client->CreatedAt()->value(),
            'updated_at' => $client->UpdatedAt()->value(),
        ]);
    }

    public function update(Client $company): void
    {
        DB::table('clients')->where('clients.id', $company->id()->value())->take(1)->update([

        ]);
    }

    public function find(ClientId $id): ?Client
    {
    }

}
