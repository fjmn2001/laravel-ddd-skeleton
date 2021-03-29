<?php

declare(strict_types=1);


namespace Medine\ERP\ClientCategories\Application\Creator;


use Medine\ERP\ClientCategories\Domain\Contracts\ClientCategoryRepository;
use Medine\ERP\ClientCategories\Domain\Entity\ClientCategory;
use Medine\ERP\ClientCategories\Domain\ValueObjects\ClientCategoryCompanyId;
use Medine\ERP\ClientCategories\Domain\ValueObjects\ClientCategoryDescription;
use Medine\ERP\ClientCategories\Domain\ValueObjects\ClientCategoryId;
use Medine\ERP\ClientCategories\Domain\ValueObjects\ClientCategoryName;
use Medine\ERP\ClientCategories\Domain\ValueObjects\ClientCategoryState;

final class ClientCategoryCreator
{
    private $repository;

    public function __construct(
        ClientCategoryRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function __invoke(ClientCategoryCreatorRequest $request)
    {
        $clienCategory = ClientCategory::create(
            new ClientCategoryId($request->id()),
            new ClientCategoryCompanyId($request->companyId()),
            new ClientCategoryName($request->name()),
            new ClientCategoryDescription($request->description()),
            new ClientCategoryState($request->state())
        );

        $this->repository->save($clienCategory);
    }

}
