<?php


namespace Medine\ERP\Provider\Application\Find;


use Medine\ERP\Provider\Application\ProviderResponse;
use Medine\ERP\Provider\Domain\ValueObjects\ProviderId;
use Medine\ERP\Provider\Infrastructure\Persistence\MySqlProviderRepository;

class ProviderFinder
{

    private $repository;

    public function __construct(MySqlProviderRepository $repository)
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
