<?php


namespace Medine\ERP\Provider\Application;



use Medine\ERP\Provider\Domain\Entity\Provider;
use Medine\ERP\Provider\Domain\ValueObjects\ProviderId;
use Medine\ERP\Provider\Domain\ValueObjects\ProviderName;
use Medine\ERP\Provider\Infrastructure\ProviderRepository;

class ProviderCreator
{
    private $repository;

    public function __construct(ProviderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(ProviderCreatorRequest $request)
    {
        $provider = Provider::create(
            new ProviderId($request->id()),
            new ProviderName($request->name())
        );

        $this->repository->save($provider);
    }

}
