<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

final class DBTransaction
{
    public function handle($request, Closure $next)
    {
        DB::beginTransaction();

        try {
            $response = $next($request);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        if ($response instanceof JsonResponse && $response->getStatusCode() > 399) {
            DB::rollBack();
        } else {
            DB::commit();
        }

        return $response;
    }
}
