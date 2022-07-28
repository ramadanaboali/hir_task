@extends('layouts.auth.index')
@section('page_title')
    {{__('app.auth.register')}}
@endsection
@section('content')
    <div class="card card-authentication1 mx-auto my-5">
        <div class="text-center" style="width:400px; margin:0 auto;">
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <h4>{{$errors->first()}}</h4>
                </div>
            @endif
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {!! session('success') !!}
                </div>
            @endif
            @if(session('danger'))
                <div class="alert alert-danger" role="alert">
                    {!! session('danger') !!}
                </div>
            @endif

        </div>
        <div class="card-body">
            <div class="card-content p-2">
                <div class="text-center">
                    <img src="assets/images/logo-icon.png" width="150px" alt="logo icon">
                </div>
                <div class="card-title text-uppercase text-center py-3">{{__('app.auth.register')}}</div>
                <form method="POST" id="submited_form"  class="text-center" style="color: #757575;" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="sr-only">Name</label>
                        <div class="position-relative has-icon-right">
                            <input type="text" id="name" class="form-control input-shadow @error('name') is-invalid @enderror" placeholder="{{__('app.auth.name')}}"  name="name" value="{{ old('name') }}">
                            <div class="form-control-position">
                                <i class="icon-user"></i>
                            </div>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                           </span>
                            @enderror

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="sr-only">Email</label>
                        <div class="position-relative has-icon-right">
                            <input type="email" id="email" class="form-control input-shadow @error('email') is-invalid @enderror" placeholder="{{__('app.auth.email')}}"  name="name" value="{{ old('email') }}">
                            <div class="form-control-position">
                                <i class="icon-envelope-open"></i>
                            </div>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                           </span>
                            @enderror

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone" class="sr-only">Phone</label>
                        <div class="position-relative has-icon-right">
                            <input type="text" id="phone" class="form-control input-shadow @error('phone') is-invalid @enderror" placeholder="{{__('app.auth.phone')}}"  name="phone" value="{{ old('phone') }}">
                            <div class="form-control-position">
                                <i class="icon-user"></i>
                            </div>
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                           </span>
                            @enderror

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="sr-only">Password</label>
                        <div class="position-relative has-icon-right">
                            <input type="password" id="password" class="form-control input-shadow @error('password') is-invalid @enderror" placeholder="{{__('app.auth.password')}}"  name="password" value="{{ old('password') }}">
                            <div class="form-control-position">
                                <i class="icon-lock"></i>
                            </div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                           </span>
                            @enderror

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="sr-only">Password</label>
                        <div class="position-relative has-icon-right">
                            <input type="password" id="password_confirmation" class="form-control input-shadow @error('password_confirmation') is-invalid @enderror" placeholder="{{__('app.auth.password_confirmation')}}"  name="password_confirmation" value="{{ old('password_confirmation') }}">
                            <div class="form-control-position">
                                <i class="icon-lock"></i>
                            </div>
                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                           </span>
                            @enderror

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="icheck-material-primary">
                            <input type="checkbox" id="user-checkbox"/>
                            <label for="user-checkbox">{{__('app.auth.accept')}}<a href="/terms">{{__('app.auth.termsConditions')}}</a></label>
                        </div>
                    </div>

                    <button type="submit"  id="registerbtn" class="btn btn-primary btn-block">{{__('app.auth.register')}}</button>


                </form>
            </div>
        </div>
        <div class="card-footer text-center py-3">
            <p class="mb-0">{{__('app.auth.alreadyhaveaccount')}}<a href="{{ route('login') }}">{{__('app.auth.login')}}</a></p>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{url('/validator')}}/register.js"></script>
    <script>
        jQuery(document).ready(function () {
            $('#registerbtn').attr('disabled','disabled');
            $('#user-checkbox').on('change',function() {

                if (this.checked) {
                    $('#registerbtn').removeAttr('disabled');
                } else {
                    $('#registerbtn').attr('disabled','disabled');
                }
            });
        });
    </script>
@endpush
