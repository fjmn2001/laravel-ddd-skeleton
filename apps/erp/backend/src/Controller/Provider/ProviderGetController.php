<?php


namespace Medine\Apps\ERP\Backend\Controller\Provider;


use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Medine\ERP\Provider\Application\ProviderFinder;
use Medine\ERP\Provider\Application\ProviderFinderRequest;

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

        return response()->json($response, JsonResponse::HTTP_OK);
    }
}
