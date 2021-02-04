<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

class ApiCommonFunctionController extends Controller
{

    /**
     * This function is used for send response.
     * @param $status int 
     * @param $result object
     * @param $message string
     * @return json
     * @author Bhargav Upadhyay
     */
    public function sendResponse($status,$result, $message)
    {   
        $response = [
            'status' => $status,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    /**
     * This function is used for send error.
     * @param $error string 
     * @param $errorMessages array
     * @param $code int
     * @return json
     * @author Bhargav Upadhyay
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'status' => $code,
            'message' => $error,
            'data' => (object)[]
        ];
        if(!empty($errorMessages)){
            $response['data'] = $error;
        }
        return response()->json($response);
    }
}