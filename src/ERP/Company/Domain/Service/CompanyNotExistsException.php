<?php


namespace Medine\ERP\Company\Domain\Service;


use Medine\ERP\Company\Domain\ValueObjects\CompanyId;

class CompanyNotExistsException extends \InvalidArgumentException
{
    public function __construct(CompanyId $id)
    {
        $message = "The company with id: {$id->value()} do not exists.";
        parent::__construct($message);
    }
}
