<?php


namespace Medine\ERP\Provider\Domain\ValueObjects;


use Medine\ERP\Shared\Domain\ValueObjects\StringValueObject;

class ProviderId extends StringValueObject
{
    protected  $exceptionMessage = "Provider id can't be empty";
    protected $exceptionCode = 400;

    public function __construct(string $id)
    {
        $this->notEmpty($id);

        parent::__construct($id);
    }

}
