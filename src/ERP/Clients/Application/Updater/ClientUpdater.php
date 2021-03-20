<?php

declare(strict_types=1);


namespace Medine\ERP\Clients\Application\Updater;


use Medine\ERP\Clients\Domain\Contracts\ClientRepository;
use Medine\ERP\Clients\Domain\Entity\Client;
use Medine\ERP\Clients\Domain\Entity\ClientHasEmail;
use Medine\ERP\Clients\Domain\Entity\ClientHasPhone;
use Medine\ERP\Clients\Domain\ValueObjects\ClientClientCategory;
use Medine\ERP\Clients\Domain\ValueObjects\ClientClientType;
use Medine\ERP\Clients\Domain\ValueObjects\ClientDniType;
use Medine\ERP\Clients\Domain\ValueObjects\ClientFrequentClientNumber;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasEmailClientId;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasEmailEmail;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasEmailEmailType;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasEmailId;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasPhoneClientId;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasPhoneId;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasPhoneNumber;
use Medine\ERP\Clients\Domain\ValueObjects\ClientHasPhoneNumberType;
use Medine\ERP\Clients\Domain\ValueObjects\ClientId;
use Medine\ERP\Clients\Domain\ValueObjects\ClientName;
use Medine\ERP\Clients\Domain\ValueObjects\ClientState;
use function Lambdish\Phunctional\each;

final class ClientUpdater
{
    private $repository;

    public function __construct(
        ClientRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function __invoke(ClientUpdaterRequest $request)
    {
        $client = $this->repository->find(new ClientId($request->id()));

        $client->changeName(new ClientName($request->name()));
        $client->changeDniType(new ClientDniType($request->dniType()));
        $client->changeClientType(new ClientClientType($request->clientType()));
        $client->changeClientCategory(new ClientClientCategory($request->clientCategory()));
        $client->changeFrequentClientNumbrer(new ClientFrequentClientNumber($request->frequentClientNumber()));
        $client->changeState(new ClientState($request->state()));
        $client->restartPhones();
        $client->restartEmails();

        each($this->addClientPhone($client), $request->phones());
        each($this->addClientEmail($client), $request->emails());

        $this->repository->update($client);
    }

    private function addClientPhone(Client $client): \Closure
    {
        return function (array $item) use ($client) {

            if(!empty($item['number']))
                $client->addClientPhone(ClientHasPhone::create(
                    new ClientHasPhoneId($item['id']),
                    new ClientHasPhoneNumber($item['number']),
                    new ClientHasPhoneNumberType(!empty($item['numberType']) ? $item['numberType'] : ''),
                    new ClientHasPhoneClientId($client->id()->value()),
                ));

        };
    }

    private function addClientEmail(Client $client): \Closure
    {
        return function (array $item) use ($client) {

            if(!empty($item['email']))
                $client->addClientEmail(ClientHasEmail::create(
                    new ClientHasEmailId($item['id']),
                    new ClientHasEmailEmail($item['email']),
                    new ClientHasEmailEmailType( !empty($item['emailType']) ? $item['emailType'] : ''),
                    new ClientHasEmailClientId($client->id()->value()),
                ));
        };
    }
}
