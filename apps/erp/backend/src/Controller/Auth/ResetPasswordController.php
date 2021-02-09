<?php

declare(strict_types=1);

namespace Medine\Apps\ERP\Backend\Controller\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\Users\Application\Update\PasswordUpdater;
use Medine\ERP\Users\Application\Update\PasswordUpdaterRequest;

final class ResetPasswordController extends Controller
{
    private $updater;

    public function __construct(PasswordUpdater $updater)
    {
        $this->updater = $updater;
    }

    public function __invoke(Request $request)
    {
        $this->validateRequest($request);
        ($this->updater)(new PasswordUpdaterRequest(
            $request->email,
            $request->password,
            $request->token
        ));

        return new JsonResponse([], JsonResponse::HTTP_CREATED);
    }

    private function validateRequest(Request $request): void
    {
        if ($request->password != $request->passwordConfirmation) {
            throw new \Exception("The password confirmation does not match.");
        }

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'token' => 'required'
        ]);
    }
}
