@extends('layouts.app')

@section('content')
@livewire('edituserauto', ['user_cars' => $user_cars, 'models'=>$models])    
@livewireScripts
@endsection
