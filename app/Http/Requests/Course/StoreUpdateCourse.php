<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateCourse extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        // pega o terceiro segmento da url, que é onde temos o id do curso que está sendo editado
        // url: http://localhost:8989/admin/courses/0b5561e3-7030-4056-a2f6-00b02916ac72
        // $id = $this->segment(3); 

        // tambem podemos acessar esse id dessa maneira
        // recuperou o nome 'course' listando as rotas pelo comando 'php artisan rout:list' e vendo a rota de 'PUT'
        // $id = $this->course;

        $rules = [
            'name' => [
                'required',
                'min:3',
                'max:255',
                //"unique:courses,name,{$id},id", // para quando estivermos editando, não vir a mensagem que o nome de curso já existe
                Rule::unique('courses')->ignore($this->course) // pode fazer assim ou como acima
            ],
            'image' => [
                'nullable',
                'image',
                'max:1024',
            ],
            'description' => [
                'nullable',
                'min:3',
                'max:9999',
            ],
            'available' => [
                'nullable',
                'boolean',
            ],
        ];

        // if ($this->method() == 'PUT') { // se a Request for um PUT, podemos determinar outra regra
        //     $rules['image'] = [
        //         'nullable',
        //         'image',
        //         'max:2048',
        //     ];
        // }

        return $rules;
    }
}
