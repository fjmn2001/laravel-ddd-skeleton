<?php

declare(strict_types=1);

namespace Medine\Apps\ERP\Backend\Controller\Locations;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\Locations\Application\Create\LocationCreator;
use Medine\ERP\Locations\Application\Create\LocationCreatorRequest;

final class LocationsPostController
{
    private $creator;

    public function __construct(LocationCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(Request $request): JsonResponse
    {
        ($this->creator)(new LocationCreatorRequest(
            $request->id,
            $request->code,
            $request->name,
            $request->mainContact,
            $request->barcode,
            $request->address,
            $request->itemState,
            $request->state,
            $request->companyId,
            $request->user()->id
        ));

        return new JsonResponse([], JsonResponse::HTTP_CREATED);
    }
}
