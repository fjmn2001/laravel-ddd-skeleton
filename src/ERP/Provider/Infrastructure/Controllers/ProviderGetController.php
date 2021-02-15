<?php


namespace Medine\ERP\Provider\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Medine\ERP\Provider\Application\Find\ProviderFinder;
use Medine\ERP\Provider\Application\Find\ProviderFinderRequest;

class ProviderGetController extends Controller
{
    private $providerFinder;

    public function __construct(ProviderFinder $providerFinder)
    {
        $this->providerFinder = $providerFinder;
    }
    public function __invoke(string $id)
    {
        $response = ($this->providerFinder)(new ProviderFinderRequest($id));

        return new JsonResponse([
            'id' => $response->id(),
            'name' => $response->name()
        ], JsonResponse::HTTP_OK);
    }
}
