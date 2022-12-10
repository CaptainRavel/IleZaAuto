@extends('layouts.app')

@section('content')
<html>
<head>
    
    @livewireStyles
</head>
<body>
@livewire('carbasedropdown')
    @livewireScripts
</body>
</html>
@endsection
