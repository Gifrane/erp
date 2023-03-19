<?php

namespace App\Http\Controllers;

use function app;
use function response;
use function ucfirst;

abstract class BaseController extends Controller
{
    /**
     * @param $function
     * @param $args
     */
    public function __call($function, $args = null)
    {
        $actionClass = $this->actionsPath.'\\'.ucfirst($function).'Action';
        $requestClass = $this->requestsPath.'\\'.ucfirst($function).'Request';

        $request = app($requestClass);
        $action = app($actionClass)->execute($request->validated());

        return $this->respond($action);
    }

    /**
     * @param array $action
     */
    protected function respond(array $action)
    {
        $status = (isset($action['status'])) ? $action['status'] : 200;

        return response()->json([
            'success' => $action['success'],
            'data' => $action['data'] ?? null,
            'errors' => $action['errors'] ?? []
        ], $status);
    }
}
