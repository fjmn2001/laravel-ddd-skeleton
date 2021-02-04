<?php

declare(strict_types=1);

namespace Medine\Apps\ERP\Backend\Controller\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Medine\ERP\Users\Application\Create\PasswordResetTokenCreator;
use Medine\ERP\Users\Application\Create\PasswordResetTokenCreatorRequest;

final class PasswordRequestController extends Controller
{
    private $creator;

    public function __construct(PasswordResetTokenCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(Request $request)
    {
        $this->validateRequest($request);
        ($this->creator)(new PasswordResetTokenCreatorRequest(
            $request->email,
            Str::random(60)
        ));

        return new JsonResponse([], JsonResponse::HTTP_CREATED);
    }

    private function validateRequest(Request $request): void
    {
        $request->validate([
            'email' => 'required|email'
        ]);
    }
}
