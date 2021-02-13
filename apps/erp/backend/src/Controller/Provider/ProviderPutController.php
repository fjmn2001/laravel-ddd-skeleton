<?php


namespace Medine\Apps\ERP\Backend\Controller\Provider;


use App\Http\Controllers\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\Provider\Application\ProviderUpdater;
use Medine\ERP\Provider\Application\ProviderUpdateRequest;

class ProviderPutController extends Controller
{
    private $providerUpdate;

    public function __construct(ProviderUpdater $providerUpdate)
    {
        $this->providerUpdate = $providerUpdate;
    }
    public function __invoke(string $id,Request $request)
    {
        ($this->providerUpdate)(new ProviderUpdateRequest(
            $id,
            $request->name
        ));

        return new JsonResponse([], JsonResponse::HTTP_OK);
    }

}
