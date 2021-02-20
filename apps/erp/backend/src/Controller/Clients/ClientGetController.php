<?php

declare(strict_types=1);

namespace Medine\Apps\ERP\Backend\Controller\Clients;

use App\Http\Controllers\Controller;
use Medine\ERP\Clients\Application\Find\ClientFinder;
use Medine\ERP\Clients\Application\Find\ClientFinderRequest;

final class ClientGetController extends Controller
{
    private $finder;

    public function __construct(ClientFinder $finder)
    {
        $this->finder = $finder;
    }

    public function __invoke(string $id)
    {
        $client = ($this->finder)(new ClientFinderRequest($id));
    }
}
