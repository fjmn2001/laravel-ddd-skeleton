<?php


namespace Medine\ERP\Provider\Domain\ValueObjects;


use Medine\ERP\Shared\Domain\ValueObjects\StringValueObject;

class ProviderName extends StringValueObject
{
    protected  $exceptionMessage = "Provider name can't be empty";
    protected $exceptionCode = 400;

    public function __construct(string $name)
    {
        $this->notEmpty($name);

        parent::__construct($name);
    }

}
