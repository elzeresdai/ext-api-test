<?php

declare(strict_types=1);

namespace App\Services\Resources;

use App\Services\WeArePentagon\WeArePentagonService;
use Illuminate\Http\Client\Response;
use Illuminate\Http\JsonResponse;

class ApiDataResource
{
    public function __construct(
        private readonly WeArePentagonService $service,
    ) {
    }

    public function getApiData(): Response
    {
        $data = $this->setToken();

        return $this->service->get(
            request: $this->service->buildRequestWithToken($data->json('access_token')),
            url: "/get-random-test-feed",
        );

    }

    private function setToken(): Response
    {
        return $this->service->post(
            request: $this->service->buildRequestWithBasicAuth(),
            url: "/access-token",
        );
    }
}
