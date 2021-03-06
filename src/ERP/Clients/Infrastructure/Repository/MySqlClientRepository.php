<?php

declare(strict_types=1);

namespace Medine\ERP\Clients\Infrastructure\Repository;

use Illuminate\Support\Facades\DB;
use Medine\ERP\Clients\Domain\Contracts\ClientRepository;
use Medine\ERP\Clients\Domain\Entity\Client;
use Medine\ERP\Clients\Domain\Entity\ClientHasEmail;
use Medine\ERP\Clients\Domain\Entity\ClientHasPhone;
use Medine\ERP\Clients\Domain\ValueObjects\ClientClientCategory;
use Medine\ERP\Clients\Domain\ValueObjects\ClientClientType;
use Medine\ERP\Clients\Domain\ValueObjects\ClientCreatedAt;
use Medine\ERP\Clients\Domain\ValueObjects\ClientDni;
use Medine\ERP\Clients\Domain\ValueObjects\ClientDniType;
use Medine\ERP\Clients\Domain\ValueObjects\ClientFrequentClientNumber;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasEmailClientId;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasEmailCreateAt;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasEmailEmail;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasEmailEmailType;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasEmailId;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasEmailUpdateAt;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasPhoneClientId;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasPhoneCreateAt;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasPhoneId;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasPhoneNumber;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasPhoneNumberType;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasPhoneUpdateAt;
use Medine\ERP\Clients\Domain\ValueObjects\ClientId;
use Medine\ERP\Clients\Domain\ValueObjects\ClientLastname;
use Medine\ERP\Clients\Domain\ValueObjects\ClientName;
use Medine\ERP\Clients\Domain\ValueObjects\ClientState;
use Medine\ERP\Clients\Domain\ValueObjects\ClientUpdatedAt;
use Medine\ERP\Shared\Infrastructure\MySqlRepository;
use function Lambdish\Phunctional\map;
use function Lambdish\Phunctional\each;

final class MySqlClientRepository  extends MySqlRepository implements ClientRepository
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
        $row = DB::table('clients')->where('clients.id', '=', $id->value())->first();

        if(empty($row))
            return null;

        $client = Client::fromDatabase(
            new ClientId($row->id),
            new ClientName($row->name),
            new ClientLastname($row->lastname),
            new ClientDni($row->dni),
            new ClientDniType($row->dni_type),
            new ClientClientType($row->client_type),
            new ClientClientCategory($row->client_category),
            new ClientFrequentClientNumber($row->frequent_client_number),
            new ClientState($row->state),
            new ClientCreatedAt($row->created_at),
            new ClientUpdatedAt($row->updated_at),
        );

        $rowPhones = DB::table('client_phones')->where('client_phones.client_id', '=', $id->value())->get();
        $rowEmails = DB::table('client_emails')->where('client_emails.client_id', '=', $id->value())->get();

        each($this->addClientPhone($client), $rowPhones);
        each($this->addClientEmail($client), $rowEmails);

        return $client;
    }


    public function matching(\Medine\ERP\Shared\Domain\Criteria $criteria): array
    {
        $query = DB::table('clients');
        $query = (new MySqlClientsFilters($query))($criteria);
        $query = $this->completeBuilder($criteria, $query);

        return $query->get()->map($this->buildClients())->toArray();
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

    private function addClientPhone(Client $client)
    {
        return function (\stdClass $item) use ($client) {
            $client->addClientPhone(ClientHasPhone::fromDatabase(
                new ClientHasPhoneId($item->id),
                new ClientHasPhoneNumber($item->number),
                new ClientHasPhoneNumberType($item->number_type),
                new ClientHasPhoneClientId($item->client_id),
                new ClientHasPhoneCreateAt($item->created_at),
                new ClientHasPhoneUpdateAt($item->updated_at)
            ));
        };
    }

    private function addClientEmail(Client $client)
    {
        return function (\stdClass $item) use ($client) {
            $client->addClientEmail(ClientHasEmail::fromDatabase(
                new ClientHasEmailId($item->id),
                new ClientHasEmailEmail($item->email),
                new ClientHasEmailEmailType($item->email_type),
                new ClientHasEmailClientId($item->client_id),
                new ClientHasEmailCreateAt($item->created_at),
                new ClientHasEmailUpdateAt($item->updated_at)
            ));
        };
    }

    private function buildClients(): \Closure
    {
        return function ($row) {
            $client = Client::fromDatabase(
                new ClientId($row->id),
                new ClientName($row->name),
                new ClientLastname($row->lastname),
                new ClientDni($row->dni),
                new ClientDniType($row->dni_type),
                new ClientClientType($row->client_type),
                new ClientClientCategory($row->client_category),
                new ClientFrequentClientNumber($row->frequent_client_number),
                new ClientState($row->state),
                new ClientCreatedAt($row->created_at),
                new ClientUpdatedAt($row->updated_at),
            );

            $rowPhones = DB::table('client_phones')->where('client_phones.client_id', '=', $client->id()->value())->get();
            $rowEmails = DB::table('client_emails')->where('client_emails.client_id', '=', $client->id()->value())->get();

            each($this->addClientPhone($client), $rowPhones);
            each($this->addClientEmail($client), $rowEmails);

            return $client;
        };
    }
}
