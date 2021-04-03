<?php

declare(strict_types=1);

namespace Medine\ERP\ClientCategories\Domain\Service;

use Illuminate\Http\JsonResponse;
use Medine\ERP\ClientCategories\Domain\ValueObjects\ClientCategoryId;

final class ClientCategoryNotExistsException extends \InvalidArgumentException
{

    public function __construct(ClientCategoryId $id)
    {
        $message = "The client category with id: {$id->value()} do not exists.";
        parent::__construct($message, JsonResponse::HTTP_NOT_FOUND);
    }
}
