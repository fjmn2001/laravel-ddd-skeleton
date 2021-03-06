<?php

declare(strict_types=1);

namespace Medine\ERP\Shared\Application\Response;

final class CatalogResponse
{
    private $tag;
    private $value;

    public function __construct(string $tag, string $value)
    {
        $this->tag = $tag;
        $this->value = $value;
    }

    public function tag(): string
    {
        return $this->tag;
    }

    public function value(): string
    {
        return $this->value;
    }
}
