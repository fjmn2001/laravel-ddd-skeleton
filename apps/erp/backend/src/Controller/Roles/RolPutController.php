<?php

declare(strict_types=1);

namespace Medine\Apps\ERP\Backend\Controller\Roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\Roles\Application\Update\RolUpdater;
use Medine\ERP\Roles\Application\Update\RolUpdaterRequest;

final class RolPutController extends Controller
{
    private $updater;

    public function __construct(RolUpdater $updater)
    {
        $this->updater = $updater;
    }

    public function __invoke(string $id, Request $request)
    {
        $this->validateRequest($request);
        ($this->updater)(new RolUpdaterRequest(
            $id,
            $request->name,
            $request->description,
            $request->superuser,
            $request->state
        ));

        return new JsonResponse([], JsonResponse::HTTP_OK);
    }

    private function validateRequest(Request $request): void
    {
        $request->validate([
            'name' => 'required|max:25',
            'description' => 'max:25',
            'superuser' => 'required|max:3',
            'state' => 'required|max:25'
        ]);
    }
}
