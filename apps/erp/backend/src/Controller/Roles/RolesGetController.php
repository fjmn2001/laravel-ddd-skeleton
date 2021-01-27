<?php

declare(strict_types=1);

namespace Medine\Apps\ERP\Backend\Controller\Roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\Roles\Application\RolResponse;
use Medine\ERP\Roles\Application\Search\RolSearcher;
use Medine\ERP\Roles\Application\Search\RolSearcherRequest;
use function Lambdish\Phunctional\map;

final class RolesGetController extends Controller
{
    private $searcher;

    public function __construct(RolSearcher $searcher)
    {
        $this->searcher = $searcher;
    }

    public function __invoke(Request $request)
    {
        $response = ($this->searcher)(new RolSearcherRequest(
            $request->get('filters', []),
            $request->get('order_by'),
            $request->get('order'),
            $request->get('limit'),
            $request->get('offset')
        ));

        $rows = map(function (RolResponse $rolResponse) {
            return [
                'id' => $rolResponse->id(),
                'name' => $rolResponse->name(),
                'description' => $rolResponse->description(),
                'superuser' => $rolResponse->superuser(),
                'status' => $rolResponse->status()
            ];
        }, $response->roles());

        return new JsonResponse([
            'page' => 1,
            'records' => 1,
            'rows' => $rows,
            'total' => 1
        ], JsonResponse::HTTP_OK);
    }
}
