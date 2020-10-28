@extends('layouts.index')
@section('content')
<div class="wrapper wrapper-content animated {{ $master['animate'] }}">
    @dump($master)
</div>

@endsection