<?php

declare(strict_types=1);

namespace Medine\ERP\Company\Infrastructure\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Medine\ERP\Company\Application\Find\CompanyFinder;
use Medine\ERP\Company\Application\Find\CompanyFinderRequest;

final class CompanyGetController extends Controller
{
    private $finder;

    public function __construct(CompanyFinder $finder)
    {
        $this->finder = $finder;
    }

    public function __invoke(string $id)
    {
        $company = ($this->finder)(new CompanyFinderRequest(
            $id
        ));

        return new JsonResponse([
            'id' => $company->id(),
            'name' => $company->name(),
            'state' => $company->state(),
            'address' => $company->address(),
            'logo' => $company->logo()
        ], JsonResponse::HTTP_OK);
    }
}
