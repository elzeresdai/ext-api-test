<?php

declare(strict_types=1);

namespace App\Services\WeArePentagon;
use App\Services\Concerns\BuildBaseRequest;
use App\Services\Concerns\CanSendGetRequest;

class WeArePentagonService

{
    use BuildBaseRequest;
    use CanSendGetRequest;

    public function __construct(
        private readonly string $baseUrl,
        private readonly string $apiToken,
    ) {}


    
}
