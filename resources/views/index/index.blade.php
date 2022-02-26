@extends('layouts.app')

@section('content')

<div class="flex items-center justify-center">

    <livewire:create
        :model="$item"
     />

</div>

@endsection