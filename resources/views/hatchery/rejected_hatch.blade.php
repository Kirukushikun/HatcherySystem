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

        <div class="form-input col-5">
            <div class="input-container column">
                <label for="ps_no">PS no. <span></span></label>
                <select name="ps_no" id="ps_no">
                    <option value=""></option>
                    <option value="#93" {{ session('form_data.ps_no', '') == '#93' ? 'selected' : ''}}>#93</option>
                    <option value="#94" {{ session('form_data.ps_no', '') == '#94' ? 'selected' : ''}}>#94</option>
                </select>
            </div>

            <div class="input-container column">
                <label for="production_date">Production Date <span></span></label>
                <input type="date" id="production_date" name="production_date">
            </div>
            <div class="input-container column">
                <label for="set_eggs_qty">Set Egg Qty <span></span></label>
                <input type="number" id="set_eggs_qty" name="set_eggs_qty" placeholder="0">
            </div>
            <div class="input-container column">
                <label for="incubator_no">Incubator  <span></span></label>
                <select id="incubator_no" name="incubator_no">
                    <option value=""></option>
                    <option value="5" {{ session('form_data.incubator_no', '') == '1' ? 'selected' : ''}}>1</option>
                </select>
            </div>
            <div class="input-container column">
                <label for="hatcher_no">Hatch # <span></span></label>
                <select id="hatcher_no" name="hatcher_no">
                    <option value=""></option>
                    <option value="1" {{ session('form_data.hatcher_no', '') == '1' ? 'selected' : ''}}>1</option>
                </select>
            </div>

            <div class="input-container row">

                <div class="input-group">
                    <label for="unhatched">Unhatched <span></span></label>
                    <input type="number" id="unhatched" name="unhatched" placeholder="0">
                </div>
                <div class="input-group prcnt">
                    <label for="unhatched_prcnt">%</label>
                    <input type="number" id="unhatched_prcnt" name="unhatched_prcnt" placeholder="0" readonly>
                </div>

            </div>
            <div class="input-container row">

                <div class="input-group">
                    <label for="pips">Pips <span></span></label>
                    <input type="number" id="pips" name="pips" placeholder="0">
                </div>
                <div class="input-group prcnt">
                    <label for="pips_prcnt">%</label>
                    <input type="number" id="pips_prcnt" name="pips_prcnt" placeholder="0" readonly>
                </div>

            </div>
            <div class="input-container row">

                <div class="input-group">
                    <label for="rejected_chicks">Rejected Chicks <span></span></label>
                    <input type="number" id="rejected_chicks" name="rejected_chicks" placeholder="0">
                </div>
                <div class="input-group prcnt">
                    <label for="rejected_chicks_prcnt">%</label>
                    <input type="number" id="rejected_chicks_prcnt" name="rejected_chicks_prcnt" placeholder="0" readonly>
                </div>

            </div>
            <div class="input-container row">

                <div class="input-group">
                    <label for="dead_chicks">Dead Chicks <span></span></label>
                    <input type="number" id="dead_chicks" name="dead_chicks" placeholder="0">
                </div>
                <div class="input-group prcnt">
                    <label for="dead_chicks_prcnt">%</label>
                    <input type="number" id="dead_chicks_prcnt" name="dead_chicks_prcnt" placeholder="0" readonly>
                </div>

            </div>
            <div class="input-container row">

                <div class="input-group">
                    <label for="rotten">Rotten <span></span></label>
                    <input type="number" id="rotten" name="rotten" placeholder="0">
                </div>
                <div class="input-group prcnt">
                    <label for="rotten_prcnt">%</label>
                    <input type="number" id="rotten_prcnt" name="rotten_prcnt" placeholder="0" readonly>
                </div>

            </div>
            <div class="input-container column">
                <label for="pullout_date">Pull-out Date <span></span></label>
                <input type="date" id="pullout_date" name="pullout_date" value="{{ session('form_data.pullout_date', date('Y-m-d')) }}">
            </div>
            <div class="input-container column">
                <label for="hatch_date">Hatch Date <span></span></label>
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

                <select class="sort-btn" name="sort-btn" id="sort-btn">
                    <option value=""> Sort By</option>
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