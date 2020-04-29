<?php

namespace App\Exceptions;

use Exception;
use App\Traits\RestTrait;
use App\Traits\RestExceptionHandlerTrait;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
	use RestTrait;
    use RestExceptionHandlerTrait;

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
        if(!$this->isApiCall($request)) {
            $retval = parent::render($request, $exception);
        } else {
			$json = [
				'status' => 0,
				'method' => $request->route()->getActionMethod(),
				'message' => 'Some error occur, please contact to support !',
				'error' => $exception->getMessage(),

				// 'status' => $exception->getCode(),

			];

			$retval = response()->json($json, 400);
			//$retval = $this->getJsonResponseForException($request, $exception);
			//$retval = parent::render($request, $exception);
        }

        return $retval;
    }
}
