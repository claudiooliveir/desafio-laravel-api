<?php

namespace App\Exceptions;

use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Throwable
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
         // Registro não encontrado
    if ($exception instanceof ModelNotFoundException) {
        return response()->json([
            'message' => 'Recurso não encontrado'
        ], 404);
    }

    // Rota inexistente
    if ($exception instanceof NotFoundHttpException) {
        return response()->json([
            'message' => 'Rota não encontrada'
        ], 404);
    }

    // Erro de validação
    if ($exception instanceof ValidationException) {
        return response()->json([
            'message' => 'Erro de validação',
            'errors' => $exception->errors()
        ], 422);
    }

    return parent::render($request, $exception);
}
}



