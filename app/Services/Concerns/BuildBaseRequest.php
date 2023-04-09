<?php

declare(strict_types=1);

namespace App\Services\Concerns;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

trait BuildBaseRequest
{
    public function buildRequestWithToken($token): PendingRequest
    {
        return $this->withBaseUrl()->timeout(
            seconds: 15,
        )->withToken(
            token: $token,
        );
    }

    public function buildRequestWithBasicAuth(): PendingRequest
    {
        return $this->withBaseUrl()->timeout(
            seconds: 15,
        )->withBasicAuth(
            username: $this->client_id,
            password: $this->client_secret,
        )->asForm(
            ['grant_type' => 'client_credentials']
        );
    }

    public function withBaseUrl(): PendingRequest
    {
        return Http::baseUrl(
            url: $this->baseUrl,
        );
    }
}
