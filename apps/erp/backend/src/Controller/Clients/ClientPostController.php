<?php

declare(strict_types=1);

namespace Medine\Apps\ERP\Backend\Controller\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\Clients\Application\Creator\ClientCreator;
use Medine\ERP\Clients\Application\Creator\ClientCreatorRequest;

final class ClientPostController extends Controller
{
    private $creator;

    public function __construct(ClientCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(Request $request): JsonResponse
    {
        ($this->creator)(new ClientCreatorRequest(
            $request->input('id'),
            $request->input('companyId'),
            $request->input('name'),
            $request->input('lastname'),
            $request->input('dni'),
            $request->input('dniType'),
            $request->input('clientType'),
            $request->input('clientCategory'),
            $request->input('frequentClientNumber', ''),
            $request->input('state'),
            $request->input('phones'),
            $request->input('emails'),
        ));
        return response()->json([], JsonResponse::HTTP_CREATED);
    }
}
