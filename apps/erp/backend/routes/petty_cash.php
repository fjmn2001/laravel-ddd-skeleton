<?php

declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/petty_cash', function (Request $request) {
    echo "main table";
});
