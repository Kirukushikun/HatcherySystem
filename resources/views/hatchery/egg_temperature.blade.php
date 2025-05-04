@include('components.modal-notification-loader')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Egg Temperature Check Entry</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="{{asset('images/BGC icon.ico')}}">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('css/modal-notification-loader.css')}}">
    <!-- Crucial Part on every forms -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Crucial Part on every forms/ -->

    <style>

    </style>

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

        <div class="form-input col-3">
            <div class="input-container column">
                <label for="temp_check_date">Temperature Check Date <i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                <input name="temp_check_date" id="temp_check_date" type="date" value="{{ session('form_data.temp_check_date', date('Y-m-d')) }}">
            </div>
            <div class="input-container column">
                <label for="setting_date">Setting Date <i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                <input name="setting_date" id="setting_date" type="date" value="{{ session('form_data.setting_date', date('Y-m-d')) }}">
            </div>
            <div class="input-container column">
                <label for="hatch_date">Hatch Date <i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                <input name="hatch_date" id="hatch_date" type="date" value="{{ session('form_data.hatch_date', date('Y-m-d')) }}">
            </div>
        </div>

        <div class="form-header chamber">
            <h4>OVERALL</h4>
            <div class="line"></div>
        </div>

        <div class="form-input col-4">
            <div class="input-container column">
                <label for="temp_check_qty">Temperature Check QTY <i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                <input name="temp_check_qty" id="temp_check_qty" type="number" value="{{ session('form_data.temp_check_qty', '') }}" placeholder="0">
            </div>

            <div class="input-container row">
                <div class="input-group">
                    <label for="ovrl_above_temp_qty">Above <b>100.5 °F</b>  QTY <i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                    <input type="number" id="ovrl_above_temp_qty" name="ovrl_above_temp_qty" placeholder="0">
                </div>
                <div class="input-group prcnt">
                    <label for="ovrl_above_temp_prcnt">%</label>
                    <input type="number" id="ovrl_above_temp_prcnt" name="ovrl_above_temp_prcnt" placeholder="0" readonly>
                </div>
            </div>

            <div class="input-container row">
                <div class="input-group">
                    <label for="ovrl_below_temp_qty">Below <b>100.4 °F</b> QTY<span></span></label>
                    <input type="number" id="ovrl_below_temp_qty" name="ovrl_below_temp_qty" placeholder="0" readonly>
                </div>
                <div class="input-group prcnt">
                    <label for="ovrl_below_temp_prcnt">%</label>
                    <input type="number" id="ovrl_below_temp_prcnt" name="ovrl_below_temp_prcnt" placeholder="0" readonly>
                </div>
            </div>
        </div>

        <div class="form-header chamber">
            <h4>LEFT</h4>
            <div class="line"></div>
        </div>

        <div class="form-input col-4">
            <div class="input-container column">
                <label for="left_ps_no">PS No. <i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                <x-dropdown :data-category="'left_ps_no'" />
            </div>

            <div class="input-container row">
                <div class="input-group">
                    <label for="left_above_temp_qty">Above <b>100.5 °F</b>  QTY<span></span></label>
                    <input type="number" id="left_above_temp_qty" name="left_above_temp_qty" placeholder="0">
                </div>
                <div class="input-group prcnt">
                    <label for="left_above_temp_prcnt">%</label>
                    <input type="number" id="left_above_temp_prcnt" name="left_above_temp_prcnt" placeholder="0" readonly>
                </div>
            </div>

            <div class="input-container row">
                <div class="input-group">
                    <label for="left_below_temp_qty">Below <b>100.4 °F</b> QTY<span></span></label>
                    <input type="number" id="left_below_temp_qty" name="left_below_temp_qty" placeholder="0">
                </div>
                <div class="input-group prcnt">
                    <label for="left_below_temp_prcnt">%</label>
                    <input type="number" id="left_below_temp_prcnt" name="left_below_temp_prcnt" placeholder="0" readonly>
                </div>
            </div>

            <div class="input-container column">
                <label for="total_left_qty">Total Left QTY</label>
                <input name="total_left_qty" id="total_left_qty" type="number" value="{{ session('form_data.quantity', '') }}" placeholder="0" readonly>
            </div>
        </div>

        <div class="form-header chamber">
            <h4>RIGHT</h4>
            <div class="line"></div>
        </div>

        <div class="form-input col-4">
            <div class="input-container column">
                <label for="right_ps_no">PS No. <i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                <x-dropdown :data-category="'right_ps_no'" />
            </div>

            <div class="input-container row">
                <div class="input-group">
                    <label for="right_above_temp_qty">Above <b>100.5 °F</b>  QTY<span></span></label>
                    <input type="number" id="right_above_temp_qty" name="right_above_temp_qty" placeholder="0" readonly>
                </div>
                <div class="input-group prcnt">
                    <label for="right_above_temp_prcnt">%</label>
                    <input type="number" id="right_above_temp_prcnt" name="right_above_temp_prcnt" placeholder="0" readonly>
                </div>
            </div>

            <div class="input-container row">
                <div class="input-group">
                    <label for="right_below_temp_qty">Below <b>100.4 °F</b> QTY<span></span></label>
                    <input type="number" id="right_below_temp_qty" name="right_below_temp_qty" placeholder="0" readonly>
                </div>
                <div class="input-group prcnt">
                    <label for="right_below_temp_prcnt">%</label>
                    <input type="number" id="right_below_temp_prcnt" name="right_below_temp_prcnt" placeholder="0" readonly>
                </div>
            </div>

            <div class="input-container column">
                <label for="total_right_qty">Total Right QTY</label>
                <input name="total_right_qty" id="total_right_qty" type="number" value="{{ session('form_data.quantity', '') }}" placeholder="0" readonly>
            </div>

            <br>
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

    <script src="{{asset('js/form-functions.js')}}" defer></script>
    <script src="{{asset('js/egg-temperature.js')}}" defer></script>
    <script src="{{asset('js/push-notification.js')}}" defer></script>
    <script src="{{asset('js/loading-screen.js')}}" defer></script>

</body>
</html>