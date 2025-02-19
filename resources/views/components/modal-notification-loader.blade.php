@section('modal-notification-loader')
    <div class="loading-screen">
        <div class="loader"></div>
    </div>

    <!-- PUSH NOTIFICATION -->
    @if(session()->has('error'))
        <div class="push-notification danger">
            <i class="fa-solid fa-bell danger"></i>
            <div class="notification-message">
                <h4>{{session('error')}}</h4>
                <p>{{session('error_message')}}</p>
            </div>
            <i class="fa-solid fa-xmark" id="close-notification"></i>
        </div>
    @elseif(session()->has('success'))
        <div class="push-notification success">
            <i class="fa-solid fa-bell success"></i>
            <div class="notification-message">
                <h4>{{session('success')}}</h4>
                <p>{{session('success_message')}}</p>
            </div>
            <i class="fa-solid fa-xmark" id="close-notification"></i>
        </div>
    @endif
    
    <div class="modal" id="modal">

    </div>
@endsection