<?php

declare(strict_types=1);

namespace Medine\ERP\Shared\Domain;

use Medine\ERP\Shared\Domain\ValueObjects\Catalog\CatalogId;
use Medine\ERP\Shared\Domain\ValueObjects\Catalog\CatalogModule;
use Medine\ERP\Shared\Domain\ValueObjects\Catalog\CatalogOrder;
use Medine\ERP\Shared\Domain\ValueObjects\Catalog\CatalogTag;
use Medine\ERP\Shared\Domain\ValueObjects\Catalog\CatalogType;
use Medine\ERP\Shared\Domain\ValueObjects\Catalog\CatalogValue;

final class Catalog
{
    private $id;
    private $tag;
    private $value;
    private $type;
    private $module;
    private $order;

    private function __construct(
        CatalogId $id,
        CatalogTag $tag,
        CatalogValue $value,
        CatalogType $type,
        CatalogModule $module,
        CatalogOrder $order
    )
    {
        $this->id = $id;
        $this->tag = $tag;
        $this->value = $value;
        $this->type = $type;
        $this->module = $module;
        $this->order = $order;
    }

    public function id(): CatalogId
    {
        return $this->id;
    }

    public function tag(): CatalogTag
    {
        return $this->tag;
    }

    public function value(): CatalogValue
    {
        return $this->value;
    }

    public function type(): CatalogType
    {
        return $this->type;
    }

    public function module(): CatalogModule
    {
        return $this->module;
    }

    public function order(): CatalogOrder
    {
        return $this->order;
    }

    public static function fromDatabase(
        CatalogId $id,
        CatalogTag $tag,
        CatalogValue $value,
        CatalogType $type,
        CatalogModule $module,
        CatalogOrder $order
    ): self
    {
        return new self($id, $tag, $value, $type, $module, $order);
    }
}
