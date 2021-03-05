<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Medine\ERP\Company\Application\Response\CompaniesResponse;
use Medine\ERP\Company\Application\Response\CompanyResponse;
use function Lambdish\Phunctional\map;
use function Lambdish\Phunctional\first;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    $user = $request->user();

    $searcher = new \Medine\ERP\Company\Application\Search\CompanySearcher(new \Medine\ERP\Company\Infrastructure\MySqlCompanyRepository);
    $response = ($searcher)(new \Medine\ERP\Company\Application\Search\CompanySearcherRequest(
        [
            ['field' => 'state', 'value' => ['active']],
            ['field' => 'user', 'value' => [$user->id]]
        ]
    ));
    $companies = map(function (CompanyResponse $response) {
        return [
            'id' => $response->id(),
            'name' => $response->name(),
            'logo' => $response->logo()
        ];
    }, $response->companies());

    return [
        'id' => $user->id,
        'email' => $user->email,
        'name' => $user->name,
        'companies' => $companies,
        'company' => first($companies)
    ];
});
