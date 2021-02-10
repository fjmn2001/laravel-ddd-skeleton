<?php

declare(strict_types=1);

namespace Medine\Apps\ERP\Backend\Controller\Roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\Roles\Application\RolCreator;
use Medine\ERP\Roles\Application\RolCreatorRequest;

final class RolPostController extends Controller
{
    private $creator;

    public function __construct(RolCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(Request $request)
    {
        $this->validateRequest($request);
        ($this->creator)(new RolCreatorRequest(
            $request->id,
            $request->name,
            $request->description,
            $request->superuser,
            $request->company_id
        ));

        return new JsonResponse([], JsonResponse::HTTP_CREATED);
    }

    private function validateRequest(Request $request): void
    {
        $request->validate([
            'name' => 'required|max:25',
            'description' => 'max:25',
            'superuser' => 'required|max:3'
        ]);
    }
}
