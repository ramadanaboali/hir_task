
<div class="text-center" style="width:400px; margin:0 auto;">

    @if(session('danger'))

        <div class="alert text-white bg-danger" role="alert">
            <div class="iq-alert-icon">
                <i class="ri-information-line"></i>
            </div>
            <div class="iq-alert-text"> {!! session('danger') !!}</div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="ri-close-line"></i>
            </button>
        </div>
    @endif

        @if(session('success'))

            <div class="alert text-white bg-primary" role="alert">
                <div class="iq-alert-icon">
                    <i class="ri-information-line"></i>
                </div>
                <div class="iq-alert-text">{!! session('success') !!}</div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="ri-close-line"></i>
                </button>
            </div>
        @endif

</div>



