<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateParameterRequest;
use App\Http\Requests\UpdateParameterRequest;
use App\Http\Resources\ParameterCollection;
use App\Http\Resources\ParameterResource;
use App\Traits\APIReturnTrait;
use Illuminate\Http\Request;
use App\Http\Requests\IndexParameterRequest;
use App\Services\ParameterService;

class ParameterController extends Controller
{
    use APIReturnTrait;

    private $parameterService;

    public function __construct(ParameterService $parameterService)
    {
        $this->parameterService = $parameterService;
    }

    public function index(IndexParameterRequest $request)
    {
        $parameters = $this->parameterService->getAll($request->validated());
        return $this->sendResponse('Параметры', new ParameterCollection($parameters), $code = 200);
    }

    public function show($id, Request $request)
    {
        $parameter = $this->parameterService->get($id);

        if (!$parameter) {
            return $this->sendError('Параметр не найден');
        }

        return $this->sendResponse('Параметр', new ParameterResource($parameter), $code = 200);
    }

    public function create(CreateParameterRequest $request)
    {
        $parameter = $this->parameterService->create($request->validated());

        return $this->sendResponse('Параметр создан', new ParameterResource($parameter), $code = 201);
    }

    public function update(UpdateParameterRequest $request, $id)
    {
        $parameter = $this->parameterService->get($id);

        $parameter = $this->parameterService->update($id, $request->validated());

        if (!$parameter) {
            return $this->sendError('Параметр не найден', $code = 404);
        }

        return $this->sendResponse('Параметр обновлен', new ParameterResource($parameter), $code = 201);

    }

    public function delete($id)
    {
        $result = $this->parameterService->delete($id);

        if (!$result) {
            return $this->sendError('Параметр не найден', $code = 404);
        }

        return $this->sendResponse('Параметр удален');
    }
}
