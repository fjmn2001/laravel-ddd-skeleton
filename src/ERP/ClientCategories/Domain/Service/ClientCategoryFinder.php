<?php

declare(strict_types=1);

namespace Medine\ERP\ClientCategories\Domain\Service;

use Medine\ERP\ClientCategories\Domain\Contracts\ClientCategoryRepository;
use Medine\ERP\ClientCategories\Domain\ValueObjects\ClientCategoryId;

final class ClientCategoryFinder
{
    private $repository;

    public function __construct(
        ClientCategoryRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function __invoke(ClientCategoryId $id)
    {
        $clientCategory = $this->repository->find($id);
        if (null === $clientCategory) {
            throw new ClientCategoryNotExistsException($id);
        }

        return $clientCategory;
    }
}
