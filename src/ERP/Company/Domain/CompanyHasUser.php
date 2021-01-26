<?php

declare(strict_types=1);


namespace Medine\ERP\Company\Domain;


final class CompanyHasUser
{
    private $id;
    private $companyId;
    private $userId;
    private $rolId;
    private $status;

    private function __construct(
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

    public static function create(string $companyId, string $userId, string $rolId)
    {
        return new self(
            Uuid::random(),
            $companyId,
            $userId,
            $rolId,
            'todo: valueobje for status'
        );
    }
}
