<?php

declare(strict_types=1);

namespace App\Services\WeArePentagon;

use App\Services\Concerns\BuildBaseRequest;
use App\Services\Concerns\CanSendGetRequest;
use App\Services\Concerns\CanSendPostRequest;
use App\Services\Resources\ApiDataResource;


class WeArePentagonService

{
    use BuildBaseRequest;
    use CanSendGetRequest;
    use CanSendPostRequest;

    public function __construct(
        private readonly string $baseUrl,
        private readonly string $apiToken,
        private readonly string $client_id,
        private readonly string $client_secret
    ) {}

    public function apiData(): ApiDataResource
    {
        return new ApiDataResource(
            service: $this,
        );
    }
}
