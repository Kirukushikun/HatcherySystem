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
<body>
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
        <h2>EGG SHELL TEMPERATURE CHECK ENTRY</h2>
        <div class="exit-icon">
            <img src="/Images/Exit-Icon.png" alt="" onclick="window.location.href='/home'">
        </div>
    </div>

    @if($targetForm == 'egg-collection' && $targetForm != null)
        <form class="body" method="POST">
            @csrf

            <div class="form-header">
                <h4>Edit Form (Egg Collection) of {{ $targetID }}</h4>
            </div>

            <!-- <div class="form-input col-4">

                <div class="input-container column">
                    <label for="ps_no">PS no. <span></span></label>
                    <select name="ps_no" id="ps_no">
                        <option value=""></option>
                        <option value="#93" {{ session('form_data.ps_no', '') == '#93' ? 'selected' : ''}}>#93</option>
                        <option value="#94" {{ session('form_data.ps_no', '') == '#94' ? 'selected' : ''}}>#94</option>
                    </select>
                </div>
                
                <div class="input-container column">
                    <label for="setting_date">Setting Date <span></span></label>
                    <input type="date" name="setting_date" id="setting_date" value="{{ session('form_data.setting_date', '') }}">
                </div>
                <div class="input-container column">
                    <label for="incubator">Incubator # <span></span></label>
                    <select name="incubator" id="incubator">
                        <option value=""></option>
                        <option value="5" {{ session('form_data.incubator', '') == '5' ? 'selected' : ''}}>5</option>
                    </select>
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
                    <input name="temp_check_date" id="temp_check_date" type="date" value="{{ session('form_data.temp_check_date', '') }}">
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
                <button class="reset-btn" type="button">Reset</button>
            </div> -->

        </form>
    @elseif ($targetForm == 'egg-temperature' && $targetForm != null)
        <form class="body" method="POST">
            @csrf

            <div class="form-header">
                <h4>Edit Form (Egg Temperature) of {{ $targetID }}</h4>
            </div>

            <!-- <div class="form-input col-4">

                <div class="input-container column">
                    <label for="ps_no">PS no. <span></span></label>
                    <select name="ps_no" id="ps_no">
                        <option value=""></option>
                        <option value="#93" {{ session('form_data.ps_no', '') == '#93' ? 'selected' : ''}}>#93</option>
                        <option value="#94" {{ session('form_data.ps_no', '') == '#94' ? 'selected' : ''}}>#94</option>
                    </select>
                </div>
                
                <div class="input-container column">
                    <label for="setting_date">Setting Date <span></span></label>
                    <input type="date" name="setting_date" id="setting_date" value="{{ session('form_data.setting_date', '') }}">
                </div>
                <div class="input-container column">
                    <label for="incubator">Incubator # <span></span></label>
                    <select name="incubator" id="incubator">
                        <option value=""></option>
                        <option value="5" {{ session('form_data.incubator', '') == '5' ? 'selected' : ''}}>5</option>
                    </select>
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
                    <input name="temp_check_date" id="temp_check_date" type="date" value="{{ session('form_data.temp_check_date', '') }}">
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
                <button class="reset-btn" type="button">Reset</button>
            </div> -->

        </form>
    @endif
</body>
</html>