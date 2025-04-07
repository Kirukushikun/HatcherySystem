@include('components.modal-notification-loader')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejected Hatch Entry</title>
    <link rel="icon" href="{{asset('images/BGC icon.ico')}}">
    
    <!-- Crucial Part on every forms -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Crucial Part on every forms/ -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link rel="stylesheet" href="/css/modal-notification-loader.css">
</head>
<body>

    @yield('modal-notification-loader')

    <div class="header">
        <img class="logo" src="/Images/BDL.png" alt="">
        <h2>REJECTED HATCH ENTRY</h2>
        <div class="exit-icon" >
            <img src="/Images/Exit-Icon.png" alt="" onclick="window.location.href='/home'">
        </div>
    </div>

    <form class="body" action="{{ route('rejected.hatch.store') }}" method="POST">
        @csrf
        <div class="form-header">
            <h4>Entry Form</h4>
        </div>

        <div class="form-input col-4">

            <div class="input-container column">
                <label for="ps_no">PS no. <i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                <x-dropdown :data-category="'ps_no'" />
            </div>
            <!-- <div class="input-container column">
                <label for="production_date">Production Date <i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                <input type="date" id="production_date" name="production_date">
            </div> -->
            <div class="input-container column">
                <label for="set_eggs_qty">Set Egg Qty <i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                <input type="number" id="set_eggs_qty" name="set_eggs_qty" placeholder="0">
            </div>
            <div class="input-container column">
                <label for="incubator_no">Incubator No.  <i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                <x-dropdown :data-category="'incubator_no'" />
            </div>
            <div class="input-container column">
                <label for="hatcher_no">Hatcher No. <i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                <x-dropdown :data-category="'hatcher_no'" />
            </div>

            <div class="input-container row">

                <div class="input-group">
                    <label for="unhatched">Unhatched<span></span></label>
                    <input type="number" id="unhatched" name="unhatched" placeholder="0">
                </div>
                <div class="input-group prcnt">
                    <label for="unhatched_prcnt">%</label>
                    <input type="number" id="unhatched_prcnt" name="unhatched_prcnt" placeholder="0" readonly>
                </div>

            </div>
            <div class="input-container row">

                <div class="input-group">
                    <label for="pips">Pips<span></span></label>
                    <input type="number" id="pips" name="pips" placeholder="0">
                </div>
                <div class="input-group prcnt">
                    <label for="pips_prcnt">%</label>
                    <input type="number" id="pips_prcnt" name="pips_prcnt" placeholder="0" readonly>
                </div>

            </div>
            <div class="input-container row">

                <div class="input-group">
                    <label for="rejected_chicks">Rejected Chicks<span></span></label>
                    <input type="number" id="rejected_chicks" name="rejected_chicks" placeholder="0">
                </div>
                <div class="input-group prcnt">
                    <label for="rejected_chicks_prcnt">%</label>
                    <input type="number" id="rejected_chicks_prcnt" name="rejected_chicks_prcnt" placeholder="0" readonly>
                </div>

            </div>
            <div class="input-container row">

                <div class="input-group">
                    <label for="dead_chicks">Dead Chicks<span></span></label>
                    <input type="number" id="dead_chicks" name="dead_chicks" placeholder="0">
                </div>
                <div class="input-group prcnt">
                    <label for="dead_chicks_prcnt">%</label>
                    <input type="number" id="dead_chicks_prcnt" name="dead_chicks_prcnt" placeholder="0" readonly>
                </div>

            </div>
            <div class="input-container row">

                <div class="input-group">
                    <label for="rotten">Rotten<span></span></label>
                    <input type="number" id="rotten" name="rotten" placeholder="0">
                </div>
                <div class="input-group prcnt">
                    <label for="rotten_prcnt">%</label>
                    <input type="number" id="rotten_prcnt" name="rotten_prcnt" placeholder="0" readonly>
                </div>

            </div>
            
        </div>

        <div class="form-input col-4">
            <!-- <div class="input-container column">
                <label for="pullout_date">Pull-out Date <i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                <input type="date" id="pullout_date" name="pullout_date" value="{{ session('form_data.pullout_date', date('Y-m-d')) }}">
            </div> -->
            <div class="input-container column">
                <label for="production_date_from">Production Date (From)<i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                <input type="date" id="production_date_from" name="production_date_from">
            </div>
            <div class="input-container column">
                <label for="production_date_to">Production Date (To)<i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                <input type="date" id="production_date_to" name="production_date_to">
            </div>
            <div class="input-container column">
                <label for="hatch_date">Hatch Date <i class="fa-solid fa-asterisk asterisk active"></i><span></span></label>
                <input type="date" id="hatch_date" name="hatch_date" value="{{ session('form_data.hatch_date', date('Y-m-d')) }}">
            </div>
            <div class="input-container row">
                <div class="input-group">
                    <label for="rejected_total">Rejected Total</label>
                    <input type="number" id="rejected_total" name="rejected_total" placeholder="0" readonly>
                </div>
                <div class="input-group prcnt">
                    <label for="rejected_total_prcnt">%</label>
                    <input type="number" id="rejected_total_prcnt" name="rejected_total_prcnt" placeholder="0" readonly>
                </div>
            </div>
        </div>

        <div class="form-action">
            <button class="save-btn">Save</button>
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

                <select class="sort-btn" name="sort_by" id="sort_by">
                    <option value="production_date_desc">Sort By: Date (Newest)</option>
                    <option value="production_date_asc">Sort By: Date (Oldest)</option>
                    <option value="ps_no_asc">Sort By: PS No.</option>
                </select>

                <div class="table-icons">
                    <i class="fa-solid fa-share-from-square" onclick="showModal('print')"></i>
                    <i class="fa-solid fa-rotate-right" onclick="refreshTable()"></i>
                </div>
                
            </div>
        </div>

        <div class="table-body">
            <livewire:rejected-hatch-table />
        </div>

        <div class="table-footer">
            <div class="pagination">
            </div>
        </div>
    </div>

    <script src="{{asset('js/rejected-hatch.js')}}" defer></script>

    <script src="{{asset('js/push-notification.js')}}" defer></script>
    <script src="{{asset('js/loading-screen.js')}}" defer></script>
</body>
</html>