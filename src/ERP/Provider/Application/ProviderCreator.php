<?php


namespace Medine\ERP\Provider\Application;



use Medine\ERP\Provider\Domain\Entity\Provider;

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
            $request->id(),
            $request->name()
        );
        dd($provider);
    }

}
