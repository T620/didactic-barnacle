<?php

namespace App\Controller;

class JsonController
{
    public function response(array $data, int $status = 200, array $headers = []): Response
    {
        return new Response(json_encode($data), $status, $headers);
    }
}