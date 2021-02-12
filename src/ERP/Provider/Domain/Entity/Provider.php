<?php


namespace Medine\ERP\Provider\Domain\Entity;


use Medine\ERP\Provider\Domain\ValueObjects\ProviderId;
use Medine\ERP\Provider\Domain\ValueObjects\ProviderName;

final class Provider
{
    private $id;
    private $name;

    public function __construct(ProviderId $id, ProviderName $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public static function create(ProviderId $id, ProviderName $name)
    {
        return new self(
            $id,
            $name
        );
    }

    public function id()
    {
        return $this->id->value();
    }

    public function name()
    {
        return $this->name->value();
    }
}
