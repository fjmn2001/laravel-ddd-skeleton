<?php


namespace Medine\ERP\Provider\Application;


use Medine\ERP\Provider\Domain\ValueObjects\ProviderId;
use Medine\ERP\Provider\Infrastructure\ProviderRepository;

class ProviderFinder
{

    private $repository;

    public function __construct(ProviderRepository $repository)
    {
        $this->repository = $repository;
    }
    public function __invoke(ProviderFinderRequest $request)
    {
        $provider = $this->repository->find(new ProviderId($request->id()));

        return new ProviderResponse(
            $provider->id()->value(),
            $provider->name()->value()
        );
    }

}
