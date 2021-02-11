<?php

declare(strict_types=1);

namespace Medine\ERP\Clients\Infrastructure\Repository;

use Illuminate\Support\Facades\DB;
use Medine\ERP\Clients\Domain\Contracts\ClientRepository;
use Medine\ERP\Clients\Domain\Entity\Client;
use Medine\ERP\Clients\Domain\Entity\ClientHasEmail;
use Medine\ERP\Clients\Domain\Entity\ClientHasPhone;
use Medine\ERP\Clients\Domain\ValueObjects\ClientId;
use function Lambdish\Phunctional\map;

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
            'created_at' => $client->createdAt()->value(),
            'updated_at' => $client->updatedAt()->value(),
        ]);

        $phones = map($this->retrievePhone(), $client->phones());
        $emails = map($this->retrieveEmail(), $client->emails());

        DB::table('client_phones')->insert($phones);
        DB::table('client_emails')->insert($emails);
    }

    public function update(Client $company): void
    {
        DB::table('clients')->where('clients.id', $company->id()->value())->take(1)->update([

        ]);
    }

    public function find(ClientId $id): ?Client
    {
    }




    private function retrieveEmail(): \Closure
    {
        return function ($email) {
            return [
                'id' => $email->id()->value(),
                'email' => $email->email()->value(),
                'email_type' => $email->emailType()->value(),
                'client_id' => $email->clientId()->value(),
                'created_at' => $email->createdAt()->value(),
                'updated_at' => $email->updatedAt()->value(),

            ];
        };
    }

    private function retrievePhone(): \Closure
    {
        return function (ClientHasPhone $phone) {
            return [
                'id' => $phone->id()->value(),
                'number' => $phone->number()->value(),
                'number_type' => $phone->numberType()->value(),
                'client_id' => $phone->clientId()->value(),
                'created_at' => $phone->createdAt()->value(),
                'updated_at' => $phone->updatedAt()->value()
            ];
        };
    }
}
