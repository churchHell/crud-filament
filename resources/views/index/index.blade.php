@extends('layouts.app')

@section('content')

<div class="flex items-center justify-center">

    <livewire:create
        :model="$item"
        :fields="['properties']"
        :types="['is_active' => 'Toggle', 
            'show' => 'Toggle', 
            'activated_at' => 'DateTimePicker',
            'category_id' => 'BelongsToSelect',
            'properties' => 'Repeater'
        ]"
        :relations="[
            'category_id' => ['category', 'name'],
            'properties' => ['properties', 'name', $properties]
        ]"
     />

</div>

@endsection