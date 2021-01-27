<?php

declare(strict_types=1);


namespace Medine\ERP\Company\Domain;


final class CompanieHasUsers
{
    private $id;
    private $companyId;
    private $userId;
    private $rolId;
    private $status;

    public function __construct(
        string $id,
        string $companyId,
        string $userId,
        string $rolId,
        string $status
    )
    {
        $this->id = $id;
        $this->companyId = $companyId;
        $this->userId = $userId;
        $this->rolId = $rolId;
        $this->status = $status;
    }
}
