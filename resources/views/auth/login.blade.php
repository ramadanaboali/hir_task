@extends('layouts.auth.index')
@section('page_title')
    {{__('app.auth.login')}}
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
                    @if(!empty(setting()->logo))
                    <img src="{{setting()->logo}}" width="150px" alt="logo icon">
                    @endif
                </div>
                <div class="card-title text-uppercase text-center py-3">{{__('app.auth.login')}}</div>
                <form method="POST" id="submited_form"  class="text-center" style="color: #757575;" action="{{ route('login') }}">
                     @csrf
                    <div class="form-group">
                        <label for="exampleInputUsername" class="sr-only">Username</label>
                        <div class="position-relative has-icon-right">
                            <input type="text" id="userName" class="form-control input-shadow @error('userName') is-invalid @enderror" placeholder="{{__('app.auth.name')}}"  name="userName" value="{{ old('userName') }}">
                            <div class="form-control-position">
                                <i class="icon-user"></i>
                            </div>
                            @error('userName')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                           </span>
                            @enderror

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword" class="sr-only">Password</label>
                        <div class="position-relative has-icon-right">
                            <input id="password" class="form-control input-shadow @error('password') is-invalid @enderror" type="password" placeholder="{{__('app.auth.password')}}"  name="password" value="{{ old('password') }}">

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
                                                <div class="form-row">
                                                    <div class="form-group col-6">
                                                        <div class="icheck-material-primary">
                                                            <input type="checkbox" id="user-checkbox" checked="" />
                                                            <label for="user-checkbox">Remember me</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-6 text-right">
                                                        <a href="{{Url('/password/reset')}}" class="">{{__('app.auth.Forgot')}}</a>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-block">{{__('app.auth.login')}}</button>


                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center py-3">
{{--                                        <p class="mb-0">{{__('app.auth.donothaveaccount')}}<a href="{{ route('register') }}">{{__('app.auth.register')}}</a></p>--}}
                                    </div>
                                </div>


@endsection
@push('js')
    <script src="{{url('/validator')}}/login.js"></script>
@endpush
