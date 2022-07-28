<!-- Wrapper Start -->
<div class="wrapper">


		@include('layouts.dashboard.partials._aside.base')

		@include('layouts.dashboard.partials._header.base')
            <div class="content-wrapper">
                <div class="container-fluid">
                    <div class="text-center" >
                        @if (session()->has('success'))
                            <div class="alert alert-icon-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <div class="alert-icon icon-part-success">
                                    <i class="fa fa-check"></i>
                                </div>
                                <div class="alert-message">
                                    <span>{{ session('success') }}</span>
                                </div>
                            </div>

                        @endif
                        @if (session()->has('error'))
                            <div class="alert alert-icon-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <div class="alert-icon icon-part-danger">
                                    <i class="fa fa-times"></i>
                                </div>
                                <div class="alert-message">
                                    <span>{{session('error')}}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                @yield('content')
                </div>
            </div>




       @include('layouts.dashboard.partials._footer.base')

</div>

