<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Egg Collection Entry</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="/Images/BGC icon.ico">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/modal-notification-loader.css">
    <!-- Crucial Part on every forms -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Crucial Part on every forms/ -->

</head>
<body>
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
    <div class="header">
        <img class="logo" src="/Images/BDL.png" alt="">
        <h2>EGG COLLECTION ENTRY</h2>
        <div class="exit-icon" >
            <img src="/Images/Exit-Icon.png" alt="" onclick="window.location.href='/home'">
        </div>
    </div>

    <form class="body" action="{{route('egg.collection.store')}}" method="POST">
        @csrf
        <div class="form-header">
            <h4>Entry Form</h4>
        </div>
        <div class="form-input col-4">  
            <div class="input-container column">
                <label for="ps_no">PS no. <span></span></label>
                <select name="ps_no" id="ps_no">
                    <option value="" selected></option>
                    <option value="93" {{ session('form_data.ps_no', '') == '93' ? 'selected' : ''}}>93</option>
                    <option value="95" {{ session('form_data.ps_no', '') == '95' ? 'selected' : ''}}>95</option>
                    <option value="98" {{ session('form_data.ps_no', '') == '98' ? 'selected' : ''}}>98</option>
                </select>
            </div>
            <div class="input-container column">
                <label for="house_no">House no. <span></span></label>
                <select name="house_no" id="house_no">
                    <option value=""selected></option>
                    <option value="1" {{ session('form_data.house_no', '') == '1' ? 'selected' : ''}}>1</option>
                    <option value="2" {{ session('form_data.house_no', '') == '2' ? 'selected' : ''}}>2</option>
                    <option value="3" {{ session('form_data.house_no', '') == '3' ? 'selected' : ''}}>3</option>
                </select>
            </div>
            <div class="input-container column">
                <label for="production_date">Production Date <span></span></label>
                <input type="date" name="production_date" id="production_date" value="{{ session('form_data.production_date', '') }}">
            </div>
            <div class="input-container column">
                <label for="collection_time">Collection Time (hh:mm) <span></span></label>
                <input type="time" name="collection_time" id="collection_time" value="{{ session('form_data.collection_time', '') }}">
            </div>
            <div class="input-container column">
                <label for="collection_eggs_quantity">Collected Eggs Quantity <span></span></label>
                <input type="number" name="collection_eggs_quantity" id="collection_eggs_quantity" value="{{ session('form_data.collection_eggs_quantity', '') }}" placeholder="0">
            </div>
        </div>
        <div class="form-action">
            <button class="save-btn" type="submit">Save</button>
            <button class="reset-btn" type="button">Reset</button>
        </div>
    </form>

    <div class="datalist">
        <div class="table-header">
            <h4>Data List</h4>

            <div class="table-action">
                <div class="search-bar">
                    <input type="text" placeholder="Search...">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>

                <select class="sort-btn" name="sort_by" id="sort_by">
                    <option value="production_date_asc">Sort By: Date (Oldest)</option>
                    <option value="production_date_desc">Sort By: Date (Newest)</option>
                    <option value="ps_no_asc">Sort By: PS No.</option>
                    <option value="house_no_asc">Sort By: House No.</option>
                    <option value="collected_qty_asc">Sort By: Quantity (Asc)</option>
                    <option value="collected_qty_desc">Sort By: Quantity (Desc)</option>
                </select>

                <div class="table-icons">
                    <i class="fa-solid fa-print"></i>
                    <i class="fa-solid fa-rotate-right"></i>
                </div>
                
            </div>

        </div>
        <div class="table-body">
            <livewire:egg-collection-table />
        </div>
        <div class="table-footer">
            <div class="pagination">
            </div>
        </div>
    </div>

    <script src="{{asset('js/egg-collection.js')}}" defer></script>
    <script src="{{asset('js/loading-screen.js')}}" defer></script>
    <script src="{{asset('js/push-notification.js')}}" defer></script>

</body>
</html>