<?php

declare(strict_types=1);


namespace Medine\ERP\Clients\Application\Creator;


use Medine\ERP\Clients\Domain\Contracts\ClientRepository;

use Medine\ERP\Clients\Domain\Entity\Client;
use Medine\ERP\Clients\Domain\Entity\ClientHasEmail;
use Medine\ERP\Clients\Domain\Entity\ClientHasPhone;

use Medine\ERP\Clients\Domain\ValueObjects\ClientId;
use Medine\ERP\Clients\Domain\ValueObjects\ClientDni;
use Medine\ERP\Clients\Domain\ValueObjects\ClientName;
use Medine\ERP\Clients\Domain\ValueObjects\ClientState;
use Medine\ERP\Clients\Domain\ValueObjects\ClientDniType;
use Medine\ERP\Clients\Domain\ValueObjects\ClientLastname;
use Medine\ERP\Clients\Domain\ValueObjects\ClientClientType;
use Medine\ERP\Clients\Domain\ValueObjects\ClientClientCategory;
use Medine\ERP\Clients\Domain\ValueObjects\ClientFrequentClientNumber;

use Medine\ERP\Clients\Domain\ValueObjects\ClientHasEmailId;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasEmailEmail;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasEmailEmailType;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasEmailClientId;

use Medine\ERP\Clients\Domain\ValueObjects\ClientHasPhoneId;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasPhoneNumber;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasPhoneNumberType;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasPhoneClientId;

use function Lambdish\Phunctional\each;

final class ClientCreator
{
    private $repository;

    public function __construct(ClientRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(ClientCreatorRequest $request)
    {
        $client = Client::create(
            new ClientId($request->id()),
            new ClientName($request->name()),
            new ClientLastname($request->lastmane()),
            new ClientDni($request->dni()),
            new ClientDniType($request->dniType()),
            new ClientClientType($request->clientType()),
            new ClientClientCategory($request->clientCategory()),
            new ClientFrequentClientNumber($request->frequentClientNumber()),
            new ClientState($request->state()),
        );

        each($this->addClientPhone($client), $request->phones());
        each($this->addClientEmail($client), $request->emails());

        dd($client);
        $this->repository->save($client);
    }

    private function addClientPhone(Client $client): \Closure
    {
        return function (array $item) use ($client) {
            $client->addClientPhone(ClientHasPhone::create(
                new ClientHasPhoneId($item['id']),
                new ClientHasPhoneNumber($item['number']),
                new ClientHasPhoneNumberType($item['number_type']),
                new ClientHasPhoneClientId($client->id()->value()),
            ));
        };
    }

    private function addClientEmail(Client $client): \Closure
    {
        return function (array $item) use ($client) {
            $client->addClientEmail(ClientHasEmail::create(
                new ClientHasEmailId($item['id']),
                new ClientHasEmailEmail($item['email']),
                new ClientHasEmailEmailType($item['email_type']),
                new ClientHasEmailClientId($client->id()->value()),
            ));
        };
    }
}
