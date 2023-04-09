<?php

namespace App\Http\Controllers;

use App\Services\Resources\ApiDataResource;
use App\Services\WeArePentagon\WeArePentagonService;
use Illuminate\Http\Client\Response;

class WeArePentagonController extends Controller
{
    public function __construct(
        private readonly ApiDataResource $api
    ) {
    }

    public function storeData()
    {
        $data = $this->api->getApiData();
        // dd($data->json());
    }

}
