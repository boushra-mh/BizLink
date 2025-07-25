<?php

namespace App\Exceptions;
use Illuminate\Http\Request;

use Exception;

class InvalidLoginException extends Exception
{
    public function render(Request $request)
    {
          return response()->json([
            'success' => false,
            'message' => __('messages.invalid_credentials'),
        ], 401);
    }
}
