<?php

namespace App\Macroses;

use Illuminate\Database\Eloquent\{Builder, Model};

class ArrMixin
{

    public function keys_modify()
    {   
        return function (array $data, string $prepend = '', string $append = ''): array
        {
            $keys = array_map(fn($key) => $prepend.$key.$append, array_keys($data));
            return array_combine($keys, $data);
        };
    }

    public function mergeWithOffset()
    {   
        return function (array $first, array $second): array
        {
            foreach($second as $key => $val){
                array_splice($first, $key, 0, [$key => $val]);
            }
            return $first;
        };
    }
    
}