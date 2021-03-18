<?php

declare(strict_types=1);

namespace Medine\ERP\Items\Infrastructure\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\Items\Application\Update\ItemStateUpdater;
use Medine\ERP\Items\Application\Update\ItemStateUpdaterRequest;

final class ItemStatePutController
{
    private $updater;

    public function __construct(ItemStateUpdater $updater)
    {
        $this->updater = $updater;
    }

    public function __invoke(string $id, Request $request)
    {
        ($this->updater)(new ItemStateUpdaterRequest(
            $request->id,
            $request->state,
            $request->user()->id
        ));

        return new JsonResponse([], JsonResponse::HTTP_OK);
    }
}
