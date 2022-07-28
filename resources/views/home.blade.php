@extends('layouts.dashboard.index')
@section('page_title')
    {{__('app.home')}}
@endsection
@section('content')
    <!--Start Dashboard Content-->


        <div class="row mt-3">
            <div class="col-12 col-lg-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-0">{{$users}} <span class="float-right"><i class="fa fa-eye"></i></span></h5>
                        <div class="progress my-3" style="height:3px;">
                            <div class="progress-bar gradient-deepblue" style="width:55%"></div>
                        </div>
                        <p class="mb-0 small-font"> {{__('app.crud.table.user')}} <span class="float-right"> <i class="zmdi zmdi-long-arrow-up"></i></span></p>
                    </div>
                </div>
            </div>
    
    
    
    
            <div class="col-12 col-lg-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-0">{{$rooms}} <span class="float-right"><i class="fa fa-eye"></i></span></h5>
                        <div class="progress my-3" style="height:3px;">
                            <div class="progress-bar gradient-deepblue" style="width:55%"></div>
                        </div>
                        <p class="mb-0 small-font"> {{__('app.rooms')}} <span class="float-right"> <i class="zmdi zmdi-long-arrow-up"></i></span></p>
                    </div>
                </div>
            </div>
    
    
            <div class="col-12 col-lg-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-0">{{$devices}} <span class="float-right"><i class="fa fa-eye"></i></span></h5>
                        <div class="progress my-3" style="height:3px;">
                            <div class="progress-bar gradient-deepblue" style="width:55%"></div>
                        </div>
                        <p class="mb-0 small-font"> {{__('app.devices')}} <span class="float-right"> <i class="zmdi zmdi-long-arrow-up"></i></span></p>
                    </div>
                </div>
            </div>
    
            <div class="col-12 col-lg-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-0">{{$userRooms}} <span class="float-right"><i class="fa fa-eye"></i></span></h5>
                        <div class="progress my-3" style="height:3px;">
                            <div class="progress-bar gradient-deepblue" style="width:55%"></div>
                        </div>
                        <p class="mb-0 small-font"> {{__('app.userRooms')}} <span class="float-right"> <i class="zmdi zmdi-long-arrow-up"></i></span></p>
                    </div>
                </div>
            </div>
    
            <div class="col-12 col-lg-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-0">{{$userRoomDevices}} <span class="float-right"><i class="fa fa-eye"></i></span></h5>
                        <div class="progress my-3" style="height:3px;">
                            <div class="progress-bar gradient-deepblue" style="width:55%"></div>
                        </div>
                        <p class="mb-0 small-font"> {{__('app.userRoomDevices')}} <span class="float-right"> <i class="zmdi zmdi-long-arrow-up"></i></span></p>
                    </div>
                </div>
            </div>
    
    
        </div><!--End Row-->



@endsection
