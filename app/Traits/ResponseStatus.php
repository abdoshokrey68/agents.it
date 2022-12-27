<?php

namespace App\Traits;

trait ResponseStatus {

    public function successResponse ($data = [], $message = "Success", $code = 200) {
        return [
            'data'  => $data,
            'message'   => $message,
            'code'      => $code
        ];
    }

    public function errorResponse ($message = "Some Thing Went Wrong", $code)
    {
        return [
            'message'       => $message,
            'code'          => $code
        ];
    }


}
