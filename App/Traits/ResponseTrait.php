<?php

namespace App\Traits;

trait ResponseTrait {
    public function sendResponse($data=null, $message = '', $status = 200) {
        $response = [
            'data' => $data,
            'message' => $message,
            'status' => $status
        ];


        http_response_code($status);
        echo json_encode($response);
    }
}