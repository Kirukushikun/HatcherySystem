@include('components.modal-notification-loader')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Egg Temperature Check Entry</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="/Images/BGC icon.ico">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/modal-notification-loader.css">
    <!-- Crucial Part on every forms -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Crucial Part on every forms/ -->

</head>
<body id="body">

    @yield('modal-notification-loader')

    <div class="header">
        <img class="logo" src="/Images/BDL.png" alt="">
        <h2>EGG SHELL TEMPERATURE CHECK ENTRY</h2>
        <div class="exit-icon">
            <img src="/Images/Exit-Icon.png" alt="" onclick="window.location.href='/home'">
        </div>
    </div>

    <form class="body">
        <div class="form-header">
            <h4>Entry Form</h4>
        </div>

        <div class="form-input col-4">

            <div class="input-container column">
                <label for="ps_no">PS No. <span></span></label>
                <x-dropdown :data-category="'ps_no'" />
            </div>
            
            <div class="input-container column">
                <label for="setting_date">Setting Date <span></span></label>
                <input type="date" name="setting_date" id="setting_date" value="{{ session('form_data.setting_date', date('Y-m-d')) }}">
            </div>
            <div class="input-container column">
                <label for="incubator_no">Incubator No. <span></span></label>
                <x-dropdown :data-category="'incubator_no'" />
            </div>
            <div class="input-container column">
                <label for="location">Location <span></span></label>
                <select name="location" id="location">
                    <option value=""></option>
                    <option value="Top" {{ session('form_data.location', '') == 'Top' ? 'selected' : ''}}>Top</option>
                    <option value="Mid" {{ session('form_data.location', '') == 'Mid' ? 'selected' : ''}}>Mid</option>
                    <option value="Low" {{ session('form_data.location', '') == 'Low' ? 'selected' : ''}}>Low</option>
                </select>
            </div>
            <div class="input-container column">
                <label for="temp_check_date">Temperature Check Date <span></span></label>
                <input name="temp_check_date" id="temp_check_date" type="date" value="{{ session('form_data.temp_check_date', date('Y-m-d')) }}">
            </div>
            <div class="input-container column">
                <label for="temperature">Temperature <span></span></label>
                <select name="temperature" id="temperature">
                    <option value=""></option>
                    <option value="37.8 Above" {{ session('form_data.temperature', '') == '37.8 Above' ? 'selected' : ''}}>37.8 Above</option>
                    <option value="37.7 Below" {{ session('form_data.temperature', '') == '37.7 Below' ? 'selected' : ''}}>37.7 Below</option>
                </select>
            </div>
            <div class="input-container column">
                <label for="quantity">Quantity <span></span></label>
                <input name="quantity" id="quantity" type="number" value="{{ session('form_data.quantity', '') }}">
            </div>
        </div>

        <div class="form-action">
            <button class="save-btn" type="submit">Save</button>
            <button class="reset-btn" type="reset">Reset</button>
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

                <!-- <label for="sort-btn">Sort By:</label> -->
                <select class="sort-btn" name="sort-btn" id="sort-btn">
                    <option value="created_at_desc">Sort By: Date (Newest)</option>
                    <option value="created_at_asc">Sort By: Date (Oldest)</option>
                    <option value="temperature_asc">Sort By: Temperature (High-Low)</option>
                    <option value="temperature_desc">Sort By: Temperature (Low-High)</option>
                    <option value="quantity_desc">Sort By: Quantity (Desc)</option>
                    <option value="quantity_asc">Sort By: Quantity (Asc)</option>
                </select>

                <div class="table-icons">
                    <i class="fa-solid fa-share-from-square" onclick="showModal('print')"></i>
                    <i class="fa-solid fa-rotate-right" onclick="refreshTable()"></i>
                </div>
                
            </div>

        </div>
        <div class="table-body">

            <livewire:egg-temperature-table />

        </div>
        <div class="table-footer">
            <div class="pagination">
            </div>
        </div>
    </div>

    <script src="{{asset('js/egg-temperature.js')}}" defer></script>
    
    <script src="{{asset('js/push-notification.js')}}" defer></script>
    <script src="{{asset('js/loading-screen.js')}}" defer></script>

</body>
</html>