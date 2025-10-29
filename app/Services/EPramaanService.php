<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class EPramaanService
{
    protected $url;
    protected $aesKey;
    protected $scope;
    protected $responseType;
    protected $codeMethod;
    protected $clientId;
    protected $clientSecret;

    public function __construct()
    {
        $this->url = config('epramaan.url');
        $this->aesKey = config('epramaan.aes_key');
        $this->scope = config('epramaan.scope');
        $this->responseType = config('epramaan.response_type');
        $this->codeMethod = config('epramaan.code_method');
        $this->clientId = config('epramaan.client_id');
        $this->clientSecret = config('epramaan.client_secret');
    }

    // Generate login URL
    public function getLoginUrl($redirectUri)
    {
        return $this->url . '/authorize?' . http_build_query([
            'response_type' => $this->responseType,
            'client_id' => $this->clientId,
            'redirect_uri' => $redirectUri,
            'scope' => $this->scope,
            'state' => bin2hex(random_bytes(8)), // optional
        ]);
    }

    // Exchange code for access token
    public function getAccessToken($code, $redirectUri)
    {
        $response = Http::asForm()->post($this->url . '/token', [
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $redirectUri,
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
        ]);

        return $response->json();
    }

    // Optional AES decryption
    public function decryptToken($encryptedToken)
    {
        return openssl_decrypt(base64_decode($encryptedToken), 'AES-128-ECB', $this->aesKey, OPENSSL_RAW_DATA);
    }
}
