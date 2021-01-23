<?php

declare(strict_types=1);

namespace Medine\Apps\ERP\Backend\Controller\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Medine\ERP\Users\Application\UserCreator;
use Medine\ERP\Users\Application\UserCreatorRequest;

final class UserPostController extends Controller
{
    private $creator;

    public function __construct(UserCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(Request $request)
    {
        $this->validateRequest($request);
        ($this->creator)(new UserCreatorRequest(
            $request->input('name'),
            $request->input('email'),
            Hash::make($request->input('password')),
        ));

        return new JsonResponse([], JsonResponse::HTTP_CREATED);
    }

    private function validateRequest(Request $request): void
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|max:255'
        ]);
    }
}
