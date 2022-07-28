@extends('layouts.auth.index')
@section('page_title')
    {{__('app.auth.ResetPassword')}}
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
                <div class="card-title text-uppercase pb-2">{{__('app.auth.ResetPassword')}}</div>
                <p class="pb-2">Please enter your email address. You will receive a link to create a new password via email.</p>

                <!-- Form -->

                    <form method="POST" id="submited_form"  class="text-center" style="color: #757575;" action="{{ route('password.update')  }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group">
                            <label for="email" class="">Email Address</label>
                            <div class="position-relative has-icon-right">
                                <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{__('app.auth.email')}}"  name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus/>
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


                        <button type="submit" class="btn btn-warning btn-block mt-3" id="registerfbtn">{{__('app.auth.ResetPassword')}}</button>
                    </form>
            </div>
        </div>
        <div class="card-footer text-center py-3">
            <p class="mb-0">Return to the <a  href="{{ route('login') }}">{{__('app.auth.login')}}</a></p>
        </div>
    </div>



@endsection
@push('js')
    <script src="{{url('/validator')}}/register.js"></script>
    <script>
        jQuery(document).ready(function () {
            $('#registerbtn').attr('disabled','disabled');
            $('#registercheckbox').on('change',function() {

                if (this.checked) {
                    $('#registerbtn').removeAttr('disabled');
                } else {
                    $('#registerbtn').attr('disabled','disabled');
                }
            });
        });
    </script>
@endpush
