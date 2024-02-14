<?php

namespace App\Http\Helpers;

trait RequestHelper
{
    public function formatErrorsRequest(array $validators): string
    {
        $message = '';
        array_walk($validators, static function ($value) use (&$message) {
            $message .= $value . '|';
        });
        return substr($message, 0, -1);
    }
}
