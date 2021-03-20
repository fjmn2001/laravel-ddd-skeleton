<?php

declare(strict_types=1);

namespace Medine\ERP\Clients\Domain\Service;

use Illuminate\Http\JsonResponse;
use Medine\ERP\Clients\Domain\ValueObjects\ClientId;

final class ClientNotExistsException extends \InvalidArgumentException
{

    public function __construct(ClientId $id)
    {
        $message = "The client with id: {$id->value()} do not exists.";
        parent::__construct($message, JsonResponse::HTTP_NOT_FOUND);
    }
}
