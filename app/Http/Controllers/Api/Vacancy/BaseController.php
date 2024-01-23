<?php

namespace App\Http\Controllers\Api\Vacancy;

use App\Http\Controllers\Controller;
use App\Services\Vacancy\Service;

class BaseController extends Controller
{
    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }
}
