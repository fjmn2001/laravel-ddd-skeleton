<?php


namespace Medine\ERP\Provider\Application\Update;


use Medine\ERP\Provider\Domain\ValueObjects\ProviderId;
use Medine\ERP\Provider\Domain\ValueObjects\ProviderName;
use Medine\ERP\Provider\Infrastructure\Persistence\MySqlProviderRepository;

class ProviderUpdater
{

    private $repository;

    public function __construct(MySqlProviderRepository $repository)
    {
        $this->repository = $repository;
    }
    public function __invoke(ProviderUpdateRequest $request)
    {
        $provider =  $this->repository->find(new ProviderId($request->id()));
        $provider->changeName(new ProviderName($request->name()));

        $this->repository->update($provider);

    }
}
