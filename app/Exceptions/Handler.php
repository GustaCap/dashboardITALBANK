<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        // dd($request);
        if ($exception instanceof HttpResponseException) {
            return response()->json([
                'errors' => [
                      'status' => '500',
                      'title' => 'Internal server error',
                      'detail'=> 'The server encountered an unexpected condition that prevented it from fulfilling the request.'
                  ]
                ],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        if ($exception instanceof NotFoundHttpException) {
            return response()->json([
                'errors' => [
                      'status' => '404',
                      'title' => 'Http Not Found',
                      'detail'=> 'The requested resource is not available.'
                  ]
                ],Response::HTTP_NOT_FOUND);
        }
        return parent::render($request, $exception);
    }


}
