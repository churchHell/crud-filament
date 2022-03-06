<?php

namespace App\Http\Livewire\Traits;

use Illuminate\Support\Arr;

trait InputTypesTrait
{

    private array $inputTypes = [
        'password' => 'password',
        'email' => 'email',
        '_at' => 'datetime-local',
        'is_' => 'checkbox',
        '_id' => 'select',
    ];

    public function inputTypesGenerate(array $fields): array
    {
        $types = [];
        foreach($fields as $field){
            foreach($this->inputTypes as $fieldTypePart => $inputType){
                if(str($field)->substrCount($fieldTypePart)){
                    $types[$field] = $inputType;
                    break;
                }
                $types[$field] = 'text';
            }
        }
        return $types;
    }

}
