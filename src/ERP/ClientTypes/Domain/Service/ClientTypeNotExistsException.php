<?php

declare(strict_types=1);

namespace Medine\ERP\ClientTypes\Domain\Service;

use Illuminate\Http\JsonResponse;
use Medine\ERP\ClientTypes\Domain\ValueObjects\ClientTypeId;

final class ClientTypeNotExistsException extends \InvalidArgumentException
{
    public function __construct(ClientTypeId $id)
    {
        $message = "The client type with id: {$id->value()} do not exists.";
        parent::__construct($message, JsonResponse::HTTP_NOT_FOUND);
    }
}
