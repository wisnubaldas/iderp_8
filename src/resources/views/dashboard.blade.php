@extends('layouts.index')
@section('content')
    <div class="wrapper wrapper-content animated {{ $master['animate'] }}">
        @if(\View::exists('dashboard.'.strtolower(session('user.modul'))))
            @include('dashboard.'.strtolower(session('user.modul')))
        @endif
    </div>
@endsection