<?php

namespace App\Macroses;

class StringableMixin
{

    public function only()
    {   
        return function(array $only = [], string $separator = ' '): string
        {
            $intersected = array_intersect($only, explode($separator, $this->value));
            return implode($separator, $intersected);
        };
    }

    public function divide()
    {   
        return function(array $only = [], string $separator = ' '): array
        {
            $exploded = explode($separator, $this->value);
            $intersectedWithOnly = array_intersect($only, $exploded);
            $diffedWithoutOnly = array_diff($exploded, $only);
            return [implode($separator, $diffedWithoutOnly), implode($separator, $intersectedWithOnly)];
        };
    }

    public function last()
    {   
        return function(string $separator = '.'): string
        {        
            $exploded = explode($separator, $this->value);
            return $exploded[count($exploded) - 1];
        };
    }

    // public function sizes()
    // {   
    //     return function(): string
    //     {
    //         return $this->only(['xs', 's', 'm', 'l']);
    //     };
    // }

    // public function divideSizes()
    // {
    //     return function(): array
    //     {
    //         return $this->divide(['xs', 's', 'm', 'l']);
    //     };
    // }

    // public function divideColors()
    // {
    //     return function(): array
    //     {
    //         return $this->divide(['default', 'primary', 'accent', 'info', 'error', 'success']);
    //     };
    // }
    
}