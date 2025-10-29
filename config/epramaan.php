<?php

return [
    'url' => env('EPRAMAAN_URL', 'https://epramaan.gov.in'), // ePramaan base URL
    'aes_key' => env('EPRAMAAN_AES_KEY'),
    'scope' => env('EPRAMAAN_SCOPE', 'openid'),
    'response_type' => env('EPRAMAAN_RESPONSE_TYPE', 'code'),
    'code_method' => env('EPRAMAAN_CODE_METHOD', 'POST'),
    'client_id' => env('EPRAMAAN_CLIENT_ID'),
    'client_secret' => env('EPRAMAAN_CLIENT_SECRET'),
];
