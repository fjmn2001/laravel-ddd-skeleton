<?php

declare(strict_types=1);

namespace Medine\ERP\Items\Infrastructure\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\Items\Application\Update\ItemUpdater;
use Medine\ERP\Items\Application\Update\ItemUpdaterRequest;

final class ItemPutController
{
    private $updater;

    public function __construct(ItemUpdater $updater)
    {
        $this->updater = $updater;
    }

    public function __invoke(string $id, Request $request)
    {
        ($this->updater)(new ItemUpdaterRequest(
            $id,
            $request->name,
            $request->description,
            $request->state,
            $request->user()->id
        ));

        return new JsonResponse([], JsonResponse::HTTP_OK);
    }
}
