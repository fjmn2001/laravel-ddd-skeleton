<?php


namespace Medine\ERP\Provider\Application;


use Medine\ERP\Provider\Domain\ValueObjects\ProviderId;
use Medine\ERP\Provider\Domain\ValueObjects\ProviderName;
use Medine\ERP\Provider\Infrastructure\ProviderRepository;

class ProviderUpdater
{

    private $repository;

    public function __construct(ProviderRepository $repository)
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
