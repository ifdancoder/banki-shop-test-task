<?php

namespace App\Services;

use App\Models\Parameter;
use App\Traits\APIReturnTrait;

class ParameterService
{
    use APIReturnTrait;
    
    public function get($id)
    {
        $parameter = Parameter::where('id', $id)->get();

        if (!$parameter) {
            return;
        }

        return $parameter->first();
    }

    public function getAll($data)
    {
        $parameters = Parameter::query();

        if (isset($data['type'])) {
            $parameters->where('type', $data['type']);
        }

        if (isset($data['id'])) {
            $parameters->where('id', $data['id']);
        }

        if (isset($data['title'])) {
            $parameters->where('title', 'like', '%' . $data['title'] . '%');
        }

        return $parameters->get();
    }

    public function delete($id)
    {
        $parameter = $this->get($id);

        if (!$parameter) {
            return;
        }

        return $parameter->delete();
    }

    public function deleteImage($id, $data)
    {
        $parameter = $this->get($id);
        
        $image_type = $data['type'];

        if (!$parameter) {
            return;
        }

        $result = $parameter->deleteImage($image_type);

        if (!$result) {
            return;
        }

        return $parameter;
    }

    public function create($data)
    {
        $parameter = Parameter::create($data);

        $this->processImages($parameter, $data);

        return $parameter;
    }

    public function update($id, $data)
    {
        $parameter = $this->get($id);

        if (!$parameter) {
            return;
        }

        $this->processImages($parameter, $data);

        $parameter->update($data);

        return $parameter;
    }

    public function processImages($parameter, $data) {
        if ($parameter->type == 1) {
            return;
        }
        if (isset($data['icon'])) {
            $icon = $data['icon'];
            $parameter->storeImage($icon, 1);
        }
        if (isset($data['icon_gray'])) {
            $icon = $data['icon_gray'];
            $parameter->storeImage($icon, 2);
        }
    }
}