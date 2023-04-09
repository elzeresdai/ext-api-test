<?php

declare(strict_types=1);

namespace App\Services\Resources;

use App\Services\WeArePentagon\WeArePentagonService;

class ApiDataResource
{
    public function __construct(
        private readonly WeArePentagonService $service,
    ) {}

    
}
