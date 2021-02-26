@extends('backend.index')
@section('content')
<div class="container">
    <a href="{{url('/system/user_manager')}}" class="btn btn-primary">Back to User</a>
    <hr class="border">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Create User</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <form>
                    <p>Sign in today for more expirience.</p>
                    <div class="form-group row"><label class="col-lg-2 col-form-label">Email</label>

                        <div class="col-lg-10"><input type="email" placeholder="Email" class="form-control"> <span class="form-text m-b-none">Example block-level help text here.</span>
                        </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-2 col-form-label">Password</label>

                        <div class="col-lg-10"><input type="password" placeholder="Password" class="form-control"></div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-offset-2 col-lg-10">
                            <div class="i-checks"><label> <input type="checkbox"><i></i> Remember me </label></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button class="btn btn-sm btn-white" type="submit">Sign in</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    
@endsection
@push('script')
    <script>
         
    </script>
@endpush