@extends('auth.layouth')

@section('title', 'Login')

@section('content')
<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>
            <h1 class="logo-name">CJFI</h1>
        </div>
        <h3>Welcome to Accura Web Apps</h3>
        <hr />
        <h3 class="text-danger">Terimakasih sudah melakukan registrasi,<br>silahkan hubungi Administrator untuk aktifasi user,</h3>
        <hr />
        <a class="btn btn-sm btn-white btn-block" href="{{route('register')}}">Create an account</a>
        <a class="btn btn-sm btn-white btn-block" href="{{route('login')}}">Login</a>
        <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
    </div>
</div>
@endsection
