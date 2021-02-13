<?php


namespace Medine\Apps\ERP\Backend\Controller\Provider;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Medine\ERP\Provider\Application\ProviderUpdater;
use Medine\ERP\Provider\Application\ProviderUpdateRequest;

class ProviderPutController
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

        return response()->json([], JsonResponse::HTTP_OK);
    }

}
