<?php

declare(strict_types=1);

namespace Medine\Apps\ERP\Backend\Controller\Locations;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\Locations\Application\Create\LocationCreator;
use Medine\ERP\Locations\Application\Create\LocationCreatorRequest;

final class LocationsPostController extends Controller
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
            $request->state,
            $request->direction,
            $request->companyId,
            $request->itemState
        ));

        return new JsonResponse([], JsonResponse::HTTP_CREATED);
    }
}
