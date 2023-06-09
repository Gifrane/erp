<?php

namespace App\Exceptions;

use Throwable;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use function response;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {});

        $this->renderable(function (Throwable $e) {
            $code = $e->getCode();

            if ($code < 200 || $code > 599) {
                $code = 500;
            }

            return response()->json([ 'success' => false, 'errors' => [ $e->getMessage() ] ], $code);
        });
    }
}
