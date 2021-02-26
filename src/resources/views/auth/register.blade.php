@extends('auth.layouth')

@section('title', 'Register')
@section('content')
<div class="middle-box text-center loginscreen   animated fadeInDown">
    <div>
        <div>
            <h1 class="logo-name">CJFI</h1>
        </div>
        <h3>Welcome to Accura Web Apps</h3>
        <form class="m-t" role="form" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nama">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <select id="depo" type="text" class="form-control @error('m_depo_id') is-invalid @enderror" name="m_depo_id"  placeholder="Depo">
                </select>
                @error('m_depo_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
            </div>
            <div class="form-group">
                    <div class="checkbox i-checks"><label> <input type="checkbox" name="igree"><i></i> Agree the terms and policy </label></div>
                    @error('igree')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>
            <button
            data-sitekey="reCAPTCHA_site_key" 
            data-callback='onSubmit' 
            data-action='submit' type="submit" class=" g-recaptcha btn btn-primary block full-width m-b">Register</button>
            
            <p class="text-muted text-center"><small>Already have an account?</small></p>
            <a class="btn btn-sm btn-white btn-block" href="{{route('login')}}">Login</a>
        </form>
        <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
    </div>
</div>

@endsection
@section('script')
<script src="{{asset('js/plugins/iCheck/icheck.min.js')}}"></script>
<script>
    function onSubmit(token) {
     document.getElementById("demo-form").submit();
   }

    $(document).ready(function(){
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });

        $.ajax({
            method: "GET",
            url: '/all_depo',
            }).done(function( msg ) {
                const depo_opt = msg.map(function(a){
                    return `<option value="${a.id}">${a.nama_depo}</option>`
                })

            $('#depo').append(depo_opt);
            
        }).fail(function(a){
               console.log(a)
        });
    });
</script>
@endsection