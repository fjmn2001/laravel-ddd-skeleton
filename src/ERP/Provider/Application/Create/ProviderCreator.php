<?php


namespace Medine\ERP\Provider\Application\Create;



use Medine\ERP\Provider\Domain\Entity\Provider;
use Medine\ERP\Provider\Domain\ValueObjects\ProviderId;
use Medine\ERP\Provider\Domain\ValueObjects\ProviderName;
use Medine\ERP\Provider\Infrastructure\Persistence\MySqlProviderRepository;

class ProviderCreator
{
    private $repository;

    public function __construct(MySqlProviderRepository $repository)
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
