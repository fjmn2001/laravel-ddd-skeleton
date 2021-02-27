<?php

declare(strict_types=1);

namespace Medine\ERP\Shared\Domain;

interface CatalogRepository
{
    public function matching(Criteria $criteria);
}
