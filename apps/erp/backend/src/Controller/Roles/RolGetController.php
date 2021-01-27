<?php

declare(strict_types=1);

namespace Medine\Apps\ERP\Backend\Controller\Roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Medine\ERP\Roles\Application\Find\RolFinder;
use Medine\ERP\Roles\Application\Find\RolFinderRequest;

final class RolGetController extends Controller
{
    private $finder;

    public function __construct(RolFinder $finder)
    {
        $this->finder = $finder;
    }

    public function __invoke(string $id)
    {
        $rolResponse = ($this->finder)(new RolFinderRequest(
            $id
        ));

        return new JsonResponse([
            'id' => $rolResponse->id(),
            'name' => $rolResponse->name(),
            'description' => $rolResponse->description(),
            'superuser' => $rolResponse->superuser(),
            'status' => $rolResponse->status()
        ], JsonResponse::HTTP_OK);
    }
}
