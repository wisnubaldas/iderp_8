@extends('layouts.index')
@section('content')
<div class="wrapper wrapper-content animated {{ $master['animate'] }}">
    <div class="row">
        @if (count($master['modul']) == 0)
            @include('layouts.error',['title'=>'Anda tidak terdaftar di modul IDERP'])
        @else
        @foreach ($master['modul'] as $v)
        <div class="col-lg-3">
            <div class="widget style1 navy-bg module-bg">
                <a href="{{route('dashboard',Crypt::encryptString($v->name))}}" class="text-white">
                <div class="row vertical-align">
                    <div class="col-3">
                        <i class="{{ $v->icon }}"></i>
                    </div>
                    <div class="col-9 text-right">
                        <h2 class="font-bold">{{ $v->name }}</h2>
                        <p>{{ $v->ket }}</p>
                    </div>
                </div>
                </a>
            </div>
        </div>
    @endforeach
        @endif

    </div>
</div>

@endsection