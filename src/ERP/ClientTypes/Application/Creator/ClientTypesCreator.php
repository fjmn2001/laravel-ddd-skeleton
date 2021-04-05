<?php

declare(strict_types=1);

namespace Medine\ERP\ClientTypes\Application\Creator;

use Medine\ERP\ClientCategories\Domain\Entity\ClientCategory;
use Medine\ERP\ClientCategories\Domain\ValueObjects\ClientCategoryDescription;
use Medine\ERP\ClientCategories\Domain\ValueObjects\ClientCategoryId;
use Medine\ERP\ClientCategories\Domain\ValueObjects\ClientCategoryName;
use Medine\ERP\ClientCategories\Domain\ValueObjects\ClientCategoryState;
use Medine\ERP\ClientTypes\Domain\Contracts\ClientTypeRepository;
use Medine\ERP\ClientTypes\Domain\Entity\ClientType;
use Medine\ERP\ClientTypes\Domain\ValueObjects\ClientTypeCompanyId;
use Medine\ERP\ClientTypes\Domain\ValueObjects\ClientTypeDescription;
use Medine\ERP\ClientTypes\Domain\ValueObjects\ClientTypeId;
use Medine\ERP\ClientTypes\Domain\ValueObjects\ClientTypeName;
use Medine\ERP\ClientTypes\Domain\ValueObjects\ClientTypeState;

final class ClientTypesCreator
{
    private $repository;

    public function __construct(
        ClientTypeRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function __invoke(ClientTypesCreatorRequest $request)
    {
        $clientType = ClientType::create(
            new ClientTypeId($request->id()),
            new ClientTypeCompanyId($request->companyId()),
            new ClientTypeName($request->name()),
            new ClientTypeDescription($request->description()),
            new ClientTypeState($request->state())
        );

        $this->repository->save($clientType);
    }

}
