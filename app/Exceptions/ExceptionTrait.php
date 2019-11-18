<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait ExceptionTrait
{
    public function apiException($request, $e)
    {
        if ($this->isModel($e)) {
            return $this->modelNotFound();
        }

        if ($this->isHttp($e)) {
            return $this->httpNotFound();
        }

        return parent::render($request, $exception);

    }

    public function isModel($e)
    {
        return $e instanceof ModelNotFoundException;
    }

    public function modelNotFound()
    {
        return response()->json([
            'errors' => 'Product Model Not Found',
        ], Response::HTTP_NOT_FOUND);

    }

    public function isHttp($e)
    {
        return $e instanceof NotFoundHttpException;
    }

    public function httpNotFound()
    {
        return response()->json([
            'errors' => 'Invalid route',
        ], Response::HTTP_NOT_FOUND);

    }
}
