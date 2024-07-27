<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Traits\APIReturnTrait;

class UpdateParameterRequest extends FormRequest
{
    
    use APIReturnTrait;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'nullable|string',
            'icon' => 'nullable|image',
            'icon_gray' => 'nullable|image'
        ];
    }

    public function messages(): array
    {
        return [
            'image' => 'Иконка должна быть изображением',
            'type.exists' => 'Тип параметра должен быть 1 или 2',
            'title.string' => 'Заголовок должен быть строкой',
        ];
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new HttpResponseException(
            $this->sendError('Ошибка валидации', $validator->errors())
        );
    }
}
