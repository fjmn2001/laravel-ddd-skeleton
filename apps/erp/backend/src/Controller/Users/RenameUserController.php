<?php
declare(strict_types=1);

namespace Medine\Apps\ERP\Backend\Controller\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\Users\Application\Update\UserRenamer;
use Medine\ERP\Users\Application\Update\UserRenamerRequest;

final class RenameUserController extends Controller
{
    private $renamer;

    public function __construct(UserRenamer $renamer)
    {
        $this->renamer = $renamer;
    }

    public function __invoke(string $email, Request $request)
    {
        ($this->renamer)(new UserRenamerRequest(
            $email,
            $request->input('name', '')
        ));

        return response()->json([], JsonResponse::HTTP_OK);
    }
}
