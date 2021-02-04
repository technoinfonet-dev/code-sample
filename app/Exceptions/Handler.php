<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {   

        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) 
        {   

           if(\Request::segment(2) == ADMIN_KEYWORD()){
                
                return redirect()->route('admin.errors.404');
                
            }else {

               // return redirect()->route('front.errors.404');
               return \Redirect::to('/404');
            }
        } 

        // if ($request->wantsJson()) {   

        //     return $this->handleApiException($request, $exception);

        // } else {

            $retval = parent::render($request, $exception);

        // }

        return $retval;
    }

    private function handleApiException($request, Exception $exception)
    {   
        $exception = $this->prepareException($exception);

        if ($exception instanceof \Illuminate\Http\Exception\HttpResponseException) {
            $exception = $exception->getResponse();
        }

        if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
            $exception = $this->unauthenticated($request, $exception);
        }

        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            $exception = $this->convertValidationExceptionToResponse($exception, $request);
        }

        return $this->customApiResponse($exception);
    }

    private function customApiResponse($exception)
    {
        if (method_exists($exception, 'getStatusCode')) {
            $statusCode = $exception->getStatusCode();
        } else {
            $statusCode = 500;
        }

        $response = [];

        $response['status'] = $statusCode;

        switch ($statusCode) {
            case 401:
                $response['message'] = 'Unauthorized';
                // $response['message'] = $exception->getMessage();;
                break;
            case 403:
                $response['message'] = 'Forbidden';
                break;
            case 404:
                $response['message'] = 'Not Found';
                break;
            case 405:
                $response['message'] = 'Method Not Allowed';
                break;
            case 422:
                $response['message'] = $exception->original['message'];
                $response['errors'] = $exception->original['errors'];
                break;
            default:
                $response['message'] = ($statusCode == 500) ? 'Internal Server Error' : $exception->getMessage();
                break;
        }

        if (config('app.debug')) {
            // $response['trace'] = $exception->getTrace();
            $response['data'] = (object)[];

        }else{

            $response['data'] = (object)[];
        }

        return response()->json($response, $statusCode);
    }
}