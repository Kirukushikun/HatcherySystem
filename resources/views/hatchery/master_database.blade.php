@include('components.modal-notification-loader')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hatchery Master Database</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="{{asset('images/BGC icon.ico')}}">
    <!-- Crucial Part on every forms -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Crucial Part on every forms/ -->
    <link rel="stylesheet" href="{{asset('css/styles_master_db.css')}}">
    <link rel="stylesheet" href="/css/modal-notification-loader.css">
    <style>
        #frcst-save{
            width: 100%;
            border:solid 3px #EC8B18;
            background-color: transparent;
            color: #EC8B18;
            padding: 10px;
            border-radius: 7px;
            cursor: pointer;

            font-weight: 500;
        }
        #frcst-save:hover{
            background-color: #EC8B18;
            color: white;
        }

        .data-display{
            position: relative;

            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: start;

            text-align: center;

            border-radius: 10px;
            background-color: white;
            padding: 40px 40px;

            gap: 20px;

            /* Add bounce animation */
            animation: bounce 0.2s ease-out;
            height: calc(100vh - 60px);
            width: calc(100% - 30%);
        }

        .data-header{
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }
        .data-header h2{
            text-align: start;
            font-weight: 500;
            font-size: 22px;
        }
        .data-header i{
            font-size: 25px;
            cursor: pointer;
        }

        .card-form .input-group label{
            position: relative;
            text-align: start;
        }

        .card-form .input-group{
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 100%;
        }

        .data-container{
            width: 100%;
            height: 100%;
            overflow-x: auto;
            padding-right: 30px;
            display: flex;
            flex-direction: column;
            gap: 40px;
        }

        .data-container .input-group input{
            background-color: #F6F4F1;
            border: solid 2px #e2e2e2;
            border-radius: 5px;
            padding: 8px 12px;

            font-size: 15px;
            font-weight: 300;

            width: 100%;
            /* margin-top: 10px; */
        }

        .data-container .input-group select{
            background-color: #F6F4F1;
            border: solid 2px #e2e2e2;
            border-radius: 5px;
            padding: 8px 12px;

            font-size: 15px;
            font-weight: 300;

            width: 100%;
            /* margin-top: 10px; */
        }

        .data-container .input-container{
            display: flex;
            align-items: center;
            gap: 20px;

        }
        .data-container .input-group.prcnt{
            width: 30%;
        }
        .data-container .input-group input{
            background-color: #F6F4F1;
            border: solid 2px #e2e2e2;
            border-radius: 5px;
            padding: 8px 12px;

            font-size: 15px;
            font-weight: 300;

            width: 100%;
            margin-top: 10px;
        }


        .data-container .card{
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 100%;

            margin-bottom: 20px;
        }
        .data-container .card-label{
            display: flex;
            align-items: center;
            
            font-size: 18px;
            font-weight: 600;
        }.data-container .card-label span{
            color: #EC8B18;
            display: flex;
            margin-right: 10px;
        }.data-container .card-label i{
            color: #EC8B18;
        }

        .data-container .card-form{
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            gap: 20px;
        }

        .activeBatch{
            display: flex;
            gap: 7px;
            align-items: center;
        }
        .activeBatch i{
            color: #EC8B18;
            font-size: 10px;
        }
    </style>
</head>
<body>

    <input type="hidden" id="batch_no" name="batch_no" value="{{$batch_no}}">
    <input type="hidden" id="current_step" name="current_step" value="{{$current_step}}">


    @yield('modal-notification-loader') 

    <div class="header">
        <img class="logo" src="/Images/BDL.png" alt="">
        <h2>HATCHERY MASTER DATABASE</h2>
        <div class="exit-icon" >
            <img src="/Images/Exit-Icon.png" alt="" onclick="window.location.href='/home'">
        </div>
    </div>

    <div class="body-split">
        <div class="sidebar">
            <a href="#card1" class="active"><div></div><p>1</p></a>
            <a href="#card2"><div></div><p>2</p></a>
            <a href="#card3"><div></div><p>3</p></a>
            <a href="#card4"><div></div><p>4</p></a>
            <a href="#card5"><div></div><p>5</p></a>
            <a href="#card6"><div></div><p>6</p></a>
            <a href="#card7"><div></div><p>7</p></a>
            <a href="#card8"><div></div><p>8</p></a>
            <a href="#card10"><div></div><i class="fa-solid fa-clipboard-list"></i></a>
            <a href="#card13"><div></div><i class="fa-solid fa-table"></i></a>
        </div>

        <div class="form-entries">
            <form class="card c1" id="card1">

                <div class="card-label active">
                    <span>1</span>
                    <p>Collected Eggs</p>
                </div>

                <div class="card-form col-2">
                    <div class="input-group">
                        <label class="label" for="ps_no">PS no. 
                            <!-- <i class="fa-solid fa-asterisk asterisk active"></i> -->
                            <span></span>
                        </label>
                        <x-dropdown :data-category="'ps_no'" />
                    </div>
                    <div class="input-group">
                        <label class="label" for="collected_qty">Collected Quantity 
                            <!-- <i class="fa-solid fa-asterisk asterisk active"></i> -->
                            <span></span>
                        </label>
                        <input type="number" name="collected_qty" id="collected_qty" placeholder="0">
                    </div>
                    <div class="input-group">
                        <label class="label" for="production_date_from">Production Date (From) 
                            <!-- <i class="fa-solid fa-asterisk asterisk active"></i> -->
                            <span></span>
                        </label>
                        <input type="date" name="production_date_from" id="production_date_from">
                    </div>
                    <div class="input-group">
                        <label class="label" for="production_date_to">Production Date (To) 
                            <!-- <i class="fa-solid fa-asterisk asterisk active"></i> -->
                            <span></span>
                        </label>
                        <input type="date" name="production_date_to" id="production_date_to">
                    </div>
                </div>

                <div class="form-action">
                    <button class="save-btn" type="submit">Save</button>
                    <!-- <button class="reset-btn" type="button">Reset</button> -->
                </div>

            </form>

            <form class="card c2" id="card2">

                <div class="card-label">
                    <span>2</span>
                    <p>Storage Pullout Process</p>
                </div>

                <div class="card-form col-2">

                    <div class="input-group">
                        <label class="label" for="pullout_date">Pullout Date 
                            <!-- <i class="fa-solid fa-asterisk asterisk active"></i> -->
                            <span></span>
                        </label>
                        <input type="date" name="pullout_date" id="pullout_date">
                    </div>
                    
                    <div class="input-group">
                        <label class="label" for="settable_eggs_qty">Set. Egg Quantity 
                            <!-- <i class="fa-solid fa-asterisk asterisk active"></i> -->
                            <span></span>
                        </label>
                        <input type="number" name="settable_eggs_qty" id="settable_eggs_qty" placeholder="0">
                    </div>
                    <div class="input-group">
                        <label class="label" for="incubator_no">Incubator No.  
                            <!-- <i class="fa-solid fa-asterisk asterisk active"></i><span></span> -->
                        </label>
                        <select name="incubator_no[]" id="incubator_no" multiple multiselect-select-all="true" multiselect-search="true" data-multiselect="true">
                            <x-multiselect-dropdown :data-category="'incubator_no'" />
                        </select>
                    </div>
                    <div class="input-container">
                        <div class="input-group">
                            <label class="label" for="prime_qty">Prime Quantity 
                                <!-- <i class="fa-solid fa-asterisk asterisk active"></i> -->
                                <span></span>
                            </label>
                            <input type="number" name="prime_qty" id="prime_qty" placeholder="0">
                        </div>   
                        <div class="input-group prcnt">
                            <label class="label" for="prime_prcnt">%</label>
                            <input type="text" name="prime_prcnt" id="prime_prcnt" placeholder="0" readonly>
                        </div>                     
                    </div>
                    <br>
                    <div class="input-container">
                        <div class="input-group">
                            <label class="label" for="jp_qty">JP Quantity 
                                <!-- <i class="fa-solid fa-asterisk asterisk active"></i> -->
                                <span></span>
                            </label>
                            <input type="number" name="jp_qty" id="jp_qty" placeholder="0">
                        </div>   
                        <div class="input-group prcnt">
                            <label class="label" for="jp_prcnt">% <span></span></label>
                            <input type="text" name="jp_prcnt" id="jp_prcnt" placeholder="0" readonly>
                        </div>                     
                    </div>
                </div>

                <div class="form-action">
                    <button class="save-btn" type="submit">Save</button>
                    <!-- <button class="reset-btn" type="button">Reset</button> -->
                </div>

            </form>

            <form class="card c3" id="card3">

                <div class="card-label">
                    <span>3</span>
                    <p>10th Day Candling Process</p>
                </div>

                <div class="card-form col-2">
                    <div class="input-group">
                        <label class="label" for="d10_candling_date">Day 10 Candling Date 
                            <!-- <i class="fa-solid fa-asterisk asterisk active"></i> -->
                            <span></span>
                        </label>
                        <input type="date" name="d10_candling_date" id="d10_candling_date" readonly>
                    </div>
                    <div class="input-group">
                        <label class="label" for="d10_candling_qty">Day 10 Breakout Quantity 
                            <!-- <i class="fa-solid fa-asterisk asterisk active"></i> -->
                            <span></span>
                        </label>
                        <input type="number" name="d10_candling_qty" id="d10_candling_qty" placeholder="0">
                    </div>
                    <div class="input-group">
                        <label class="label" for="d10_breakout_qty">Day 10 Sampling Quantity 
                            <!-- <i class="fa-solid fa-asterisk asterisk active"></i> -->
                            <span></span>
                        </label>
                        <input type="number" name="d10_breakout_qty" id="d10_breakout_qty" placeholder="0">
                    </div>
                    <div class="input-group">
                        <label class="label" for="d10_breakout_prcnt">Day 10 Breakout %</label>
                        <input type="text" name="d10_breakout_prcnt" id="d10_breakout_prcnt" placeholder="0" readonly>
                    </div>
                    <br>
                    <div class="input-group">
                        <label class="label" for="d10_inc_qty">Day 10  Inc Quantity</label>
                        <input type="text" name="d10_inc_qty" id="d10_inc_qty" placeholder="0" readonly>
                    </div>
                </div>

                <div class="form-action">
                    <button class="save-btn" type="submit">Save</button>
                    <!-- <button class="reset-btn" type="button">Reset</button> -->
                </div>

            </form>

            <form class="card c4" id="card4">

                <div class="card-label">
                    <span>4</span>
                    <p>18th Day Candling Process</p>
                </div>

                <div class="card-form">
                    <div class="input-group">
                        <label class="label" for="d18_candling_date">Day 18.5 Candling Date  
                            <!-- <i class="fa-solid fa-asterisk asterisk active"></i> -->
                            <span></span>
                        </label>
                        <input type="date" name="d18_candling_date" id="d18_candling_date" readonly>
                    </div>
                    <br>
                    <div class="input-container">
                        <div class="input-group">
                            <label class="label" for="infertiles_qty">Infertiles Quantity 
                                <!-- <i class="fa-solid fa-asterisk asterisk active"></i> -->
                                <span></span>
                            </label>
                            <input type="number" name="infertiles_qty" id="infertiles_qty" placeholder="0">
                        </div>
                        
                        <div class="input-group">
                            <label class="label" for="embryonic_eggs_qty">Embryonic Eggs Quantity <span></span></label>
                            <input type="text" name="embryonic_eggs_qty" id="embryonic_eggs_qty" placeholder="0" readonly>
                        </div>
                    </div>

                </div>

                <div class="form-action">
                    <button class="save-btn" type="submit">Save</button>
                    <!-- <button class="reset-btn" type="button">Reset</button> -->
                </div>

            </form>

            <form class="card c5" id="card5">
                <div class="card-label">
                    <span>5</span>
                    <p>Hatcher Pullout Process</p>
                </div>

                <div class="card-form col-2">
                    <div class="input-group">
                        <label class="label" for="hatcher_no">Hatcher No 
                            <!-- <i class="fa-solid fa-asterisk asterisk active"></i> -->
                            <span></span>
                        </label>
                        <select name="hatcher_no[]" id="hatcher_no" multiple multiselect-select-all="true" multiselect-search="true" data-multiselect="true">
                            <x-multiselect-dropdown :data-category="'hatcher_no'" />
                        </select>
                    </div>
                    <div class="input-group">
                        <label class="label" for="hatcher_date">Hatcher Date 
                            <!-- <i class="fa-solid fa-asterisk asterisk active"></i> -->
                            <span></span>
                        </label>
                        <input type="date" name="hatcher_date" id="hatcher_date" >
                    </div>
                    <div class="input-group">
                        <label class="label" for="rejected_hatch_qty">Rejected Hatch Qty 
                            <!-- <i class="fa-solid fa-asterisk asterisk active"></i> -->
                            <span></span>
                        </label>
                        <input type="number" name="rejected_hatch_qty" id="rejected_hatch_qty" placeholder="0">
                    </div>
                    <div class="input-group">
                        <label class="label" for="accepted_hatch_qty">Good Hatch Qty <span></span></label>
                        <input type="text" name="accepted_hatch_qty" id="accepted_hatch_qty" placeholder="0" readonly>
                    </div>
                </div>

                <div class="form-action">
                    <button class="save-btn" type="submit">Save</button>
                    <!-- <button class="reset-btn" type="button">Reset</button> -->
                </div>
            </form>

            <form class="card c6" id="card6">
                <div class="card-label">
                    <span>6</span>
                    <p>Sexing</p>
                </div>

                <div class="card-form">
                    <div class="input-group">
                        <label class="label" for="cock_qty">Cockerels Quantity 
                            <!-- <i class="fa-solid fa-asterisk asterisk active"></i> -->
                            <span></span>
                        </label>
                        <input type="number" name="cock_qty" id="cock_qty" placeholder="0">
                    </div>
                    <br>
                    <div class="input-group">
                        <label class="label" for="dop_qty">DOP Quantity <span></span></label>
                        <input type="text" name="dop_qty" id="dop_qty" placeholder="0" readonly>
                    </div>
                </div>

                <div class="form-action">
                    <button class="save-btn" type="submit">Save</button>
                    <!-- <button class="reset-btn" type="button">Reset</button> -->
                </div>
            </form>

            <form class="card c7" id="card7">
                <div class="card-label">
                    <span>7</span>
                    <p>QC/QA Process Entry</p>
                </div>

                <div class="card-form">
                    <div class="input-group">
                        <label class="label" for="qc_date">QC Date 
                            <!-- <i class="fa-solid fa-asterisk asterisk active"></i> -->
                            <span></span>
                        </label>
                        <input type="date" name="qc_date" id="qc_date">
                    </div>
                    <br>
                    <div class="input-container">
                        <div class="input-group">
                            <label class="label" for="rejected_dop_qty">Rejected DOP Qty 
                                <!-- <i class="fa-solid fa-asterisk asterisk active"></i> -->
                                <span></span>
                            </label>
                            <input type="number" name="rejected_dop_qty" id="rejected_dop_qty" placeholder="0">
                        </div>
                        
                        <div class="input-group">
                            <label class="label" for="accepted_dop_qty">Good DOP Qty <span></span></label>
                            <input type="text" name="accepted_dop_qty" id="accepted_dop_qty" placeholder="0" readonly>
                        </div>
                    </div>

                </div>

                <div class="form-action">
                    <button class="save-btn" type="submit">Save</button>
                    <!-- <button class="reset-btn" type="button">Reset</button> -->
                </div>
            </form>

            <form class="card c10" id="card9">
                <div class="card-label">
                    <i class="fa-solid fa-clipboard-list"></i>
                    <p>Forecast Base on Last Hatch</p>
                </div>

                <div class="card-form col-33">
                    <div class="input-container">
                        <div class="input-group">
                            <label class="label" for="infertile_qty">Infertile Qty</label>
                            <input type="number" name="infertile_qty" id="infertile_qty" placeholder="0" readonly>
                        </div>
                        
                        <div class="input-group prcnt">
                            <label class="label" for="infertile_prcnt">% <span></span></label>
                            <input type="number" name="infertile_prcnt" id="infertile_prcnt" placeholder="0">
                        </div>
                    </div>

                    <div class="input-container">
                        <div class="input-group">
                            <label class="label" for="frcst_cock_qty">Cock Qty</label>
                            <input type="number" name="frcst_cock_qty" id="frcst_cock_qty" placeholder="0" readonly>
                        </div>
                        
                        <div class="input-group prcnt">
                            <label class="label" for="frcst_cock_prcnt">% <span></span></label>
                            <input type="number" name="frcst_cock_prcnt" id="frcst_cock_prcnt" placeholder="0">
                        </div>
                    </div>
                    <br>
                    <div class="input-container">
                        <div class="input-group">
                            <label class="label" for="frcst_rejected_hatch_qty">Rejected Hatch Qty</label>
                            <input type="number" name="frcst_rejected_hatch_qty" id="frcst_rejected_hatch_qty" placeholder="0" readonly>
                        </div>
                        
                        <div class="input-group prcnt">
                            <label class="label" for="frcst_rejected_hatch_prcnt">% <span></span></label>
                            <input type="number" name="frcst_rejected_hatch_prcnt" id="frcst_rejected_hatch_prcnt" placeholder="0">
                        </div>
                    </div>
                    <div class="input-container">
                        <div class="input-group">
                            <label class="label" for="frcst_rejected_dop_qty">Rejected DOP Qty</label>
                            <input type="number" name="frcst_rejected_dop_qty" id="frcst_rejected_dop_qty" placeholder="0" readonly>
                        </div>
                        
                        <div class="input-group prcnt">
                            <label class="label" for="frcst_rejected_dop_prcnt">% <span></span></label>
                            <input type="number" name="frcst_rejected_dop_prcnt" id="frcst_rejected_dop_prcnt" placeholder="0">
                        </div>
                    </div>
                    <div class="input-group">
                        <label class="label" for="forecast_total_qty">Total Qty</label>
                        <input type="number" name="forecast_total_qty" id="forecast_total_qty" placeholder="0" readonly>
                    </div>
                    
                </div>

                <div class="card-label">
                    <i class="fa-solid fa-box"></i>
                    <p>Forecast # of Boxes</p>
                </div>

                <div class="card-form col-33">
                    <div class="input-group">
                        <label class="label" for="frcst_total_boxes">Total</label>
                        <input type="text" name="frcst_total_boxes" id="frcst_total_boxes" placeholder="0" readonly>
                    </div>
                    <div class="input-group">
                        <label class="label" for="frcst_settable_eggs_prcnt">%</label>
                        <input type="text" name="frcst_settable_eggs_prcnt" id="frcst_settable_eggs_prcnt" placeholder="0" readonly>
                    </div>
                    <br>
                    <div class="input-group">
                        <label class="label" for="frcst_prime">Prime</label>
                        <input type="text" name="frcst_prime" id="frcst_prime" placeholder="0" readonly>
                    </div>
                    <div class="input-group">
                        <label class="label" for="frcst_jr_prime">Junior Prime</label>
                        <input type="text" name="frcst_jr_prime" id="frcst_jr_prime" placeholder="0" readonly>
                    </div>
                    <div class="input-group">
                        <label class="label" for="">DOP Booking</label>
                        <button type="button" style="width: 100%; margin-top: 10px; color: white; background-color: #EC8B18; border: none; padding: 10px; border-radius: 7px; cursor: pointer; font-size: 15px;">View / Entry</button>
                    </div>
                </div>

                <div class="form-action">
                    <button class="save-btn" id="frcst-save" type="submit">Save</button>
                </div>
            
            </form>

            <form class="card c8" id="card8">
                <div class="card-label">
                    <span>8</span>
                    <p>Dispath Process Entry</p>
                </div>

                <div class="card-form">
                    <div class="input-group">
                        <label class="label" for="dispatch_prime_qty">Prime Qty 
                            <!-- <i class="fa-solid fa-asterisk asterisk active"></i> -->
                            <span></span>
                        </label>
                        <input type="number" name="dispatch_prime_qty" id="dispatch_prime_qty" placeholder="0">
                    </div>
                    <br>
                    <div class="input-group">
                        <label class="label" for="dispatch_jr_prime_qty">Jr Prime Qty 
                            <!-- <i class="fa-solid fa-asterisk asterisk active"></i> -->
                            <span></span>
                        </label>
                        <input type="number" name="dispatch_jr_prime_qty" id="dispatch_jr_prime_qty" placeholder="0">
                    </div>
                </div>

                <div class="form-action">
                    <button class="save-btn" type="submit">Save</button>
                    <!-- <button class="reset-btn" type="button">Reset</button> -->
                </div>
            </form>

            <form class="card c12" id="card10">
                <h1 id="total_boxes">0</h1>
                <p>Forcasted Number of <br> Boxes</p>
            </form>

            <div class="card c13" id="card11">
                <div class="table-header">
                    <h4>Data List</h4>
        
                    <div class="table-action">
                        <div class="search-bar">
                            <input type="text" placeholder="Search...">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
        
                        <select class="sort-btn" name="sort_by" id="sort_by">
                            <option value="batch_no_desc">Sort By: Batch No (Desc)</option>
                            <option value="batch_no_asc">Sort By: Batch No (Asc)</option>
                           
                        </select>
        
                        <div class="table-icons">
                            <!-- <i class="fa-solid fa-file-circle-plus"></i> -->
                            <!-- <i class="fa-solid fa-print"></i> -->
                            <i class="fa-solid fa-rotate-right" onclick="loadData()"></i>
                            <i class="fa-solid fa-file-circle-plus" onclick="location.reload();"></i>
                        </div>
                        
                    </div>
        
                </div>
                <div class="table-body">
                    <livewire:master-database-table />
                </div>
                <div class="table-footer">
                    <div class="pagination">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('js/multiselect-dropdown-masterdb.js')}}" defer></script>
    <script src="{{asset('js/master_database_form.js')}}" defer></script>
    <script src="{{asset('js/master_database_formula.js')}}" defer></script>

    <script>
        //GENERATE IN PROGRESS BATCH DATA
        document.addEventListener("DOMContentLoaded", function() {
            let batchData = @json($batchData); // Laravel safely converts PHP to JSON

            if (batchData && batchData.length > 0) {
                batchData.forEach(record => {
                    let step = record.current_step;
                    let processData = record.process_data || {};

                    // Example: Accessing "collected_eggs" data if step is 1
                    if (step === 2 && processData.collected_eggs) {
                        document.getElementById("ps_no").value = processData.collected_eggs.ps_no;
                        document.getElementById("collected_qty").value = processData.collected_eggs.collected_qty;
                        document.getElementById("production_date_to").value = processData.collected_eggs.production_date_to;
                        document.getElementById("production_date_from").value = processData.collected_eggs.production_date_from;
                    } else if (step === 3 && processData.storage_pullout) {

                        const incubatorSelect = document.getElementById("incubator_no");
                        const selectedValues = processData.storage_pullout.incubator_no || []; // Default to empty array

                        Array.from(incubatorSelect.options).forEach(option => {
                            option.selected = selectedValues.includes(option.value);
                        });

                        incubatorSelect.dispatchEvent(new Event('change'));
                        
                        document.getElementById("pullout_date").value = processData.storage_pullout.pullout_date;
                        document.getElementById("settable_eggs_qty").value = processData.storage_pullout.settable_eggs_qty;
                        document.getElementById("prime_qty").value = processData.storage_pullout.prime_qty;
                        document.getElementById("prime_prcnt").value = processData.storage_pullout.prime_prcnt;
                        document.getElementById("jp_qty").value = processData.storage_pullout.jp_qty;
                        document.getElementById("jp_prcnt").value = processData.storage_pullout.jp_prcnt;

                        document.getElementById("d10_candling_date").value = processData.storage_pullout.pullout_date_d10;
                        document.getElementById("d18_candling_date").value = processData.storage_pullout.pullout_date_d18;
                        document.getElementById("hatcher_date").value = processData.storage_pullout.pullout_date_d21;
                    } else if (step === 4 && processData.setter_process) {
                        document.getElementById("d10_candling_date").value = processData.setter_process.d10_candling_date;
                        document.getElementById("d10_candling_qty").value = processData.setter_process.d10_candling_qty;
                        document.getElementById("d10_breakout_qty").value = processData.setter_process.d10_breakout_qty;
                        document.getElementById("d10_breakout_prcnt").value = processData.setter_process.d10_breakout_prcnt;
                        document.getElementById("d10_inc_qty").value = processData.setter_process.d10_inc_qty;
                        
                    } else if (step === 5 && processData.candling_process) {
                        document.getElementById("d18_candling_date").value = processData.candling_process.d18_candling_date;
                        document.getElementById("infertiles_qty").value = processData.candling_process.infertiles_qty;
                        document.getElementById("embryonic_eggs_qty").value = processData.candling_process.embryonic_eggs_qty;
                    } else if (step === 6 && processData.hatcher_pullout){
                        const hatcherSelect = document.getElementById("hatcher_no");
                        const selectedValues = processData.hatcher_pullout.hatcher_no || []; // Default to empty array

                        Array.from(hatcherSelect.options).forEach(option => {
                            option.selected = selectedValues.includes(option.value);
                        });

                        hatcherSelect.dispatchEvent(new Event('change'));

                        document.getElementById("hatcher_no").value = processData.hatcher_pullout.hatcher_no;
                        document.getElementById("hatcher_date").value = processData.hatcher_pullout.hatcher_date;
                        document.getElementById("rejected_hatch_qty").value = processData.hatcher_pullout.rejected_hatch_qty;
                        document.getElementById("accepted_hatch_qty").value = processData.hatcher_pullout.accepted_hatch_qty;
                    } else if (step === 7 && processData.sexing){
                        document.getElementById("cock_qty").value = processData.sexing.cock_qty;
                        document.getElementById("dop_qty").value = processData.sexing.dop_qty;
                    } else if (step === 8 && processData.qc_qa_process){
                        document.getElementById("qc_date").value = processData.qc_qa_process.qc_date;
                        document.getElementById("rejected_dop_qty").value = processData.qc_qa_process.rejected_dop_qty;
                        document.getElementById("accepted_dop_qty").value = processData.qc_qa_process.accepted_dop_qty;
                    } else if (step === 10 && processData.forecast){
                        document.getElementById("infertile_qty").value = processData.forecast.infertile_qty;
                        document.getElementById("infertile_prcnt").value = processData.forecast.infertile_prcnt;

                        document.getElementById("frcst_cock_qty").value = processData.forecast.frcst_cock_qty;
                        document.getElementById("frcst_cock_prcnt").value = processData.forecast.frcst_cock_prcnt;

                        document.getElementById("frcst_rejected_hatch_qty").value = processData.forecast.frcst_rejected_hatch_qty;
                        document.getElementById("frcst_rejected_hatch_prcnt").value = processData.forecast.frcst_rejected_hatch_prcnt;

                        document.getElementById("frcst_rejected_dop_qty").value = processData.forecast.frcst_rejected_dop_qty;
                        document.getElementById("frcst_rejected_dop_prcnt").value = processData.forecast.frcst_rejected_dop_prcnt;

                        document.getElementById("forecast_total_qty").value = processData.forecast.forecast_total_qty;


                        //
                        document.getElementById("frcst_total_boxes").value = processData.forecast.frcst_total_boxes;
                        document.getElementById("frcst_settable_eggs_prcnt").value = processData.forecast.frcst_settable_eggs_prcnt;

                        document.getElementById("frcst_prime").value = processData.forecast.frcst_prime;
                        document.getElementById("frcst_jr_prime").value = processData.forecast.frcst_jr_prime;

                    } 
                    else if (step === 9 && processData.dispath_process){
                        document.getElementById("dispatch_prime_qty").value = processData.dispath_process.dispatch_prime_qty;
                        document.getElementById("dispatch_jr_prime_qty").value = processData.dispath_process.dispatch_jr_prime_qty;
                    } else if (step === 11 && processData.frcst_box){
                        document.getElementById("total_boxes").innerText = processData.frcst_box.total_boxes;
                    }
                });
            }

            // function generateCurrentStepData(){
            //     if (currentStep == 3) {
            //         let pulloutDate = new Date(pulloutStorage.pullout_date.value); // Get pullout date
    
            //         // Calculate Day 10 Candling Date
            //         let pulloutDay10 = new Date(pulloutDate); // Clone date
            //         pulloutDay10.setDate(pulloutDay10.getDate() + 10); // Add 10 days
            //         setterProcess.d10_candling_date.value = pulloutDay10.toISOString().split('T')[0]; // Format YYYY-MM-DD

            //         // Calculate Day 18.5 Candling Date
            //         let pulloutDay18_5 = new Date(pulloutDate); // Clone date
            //         pulloutDay18_5.setDate(pulloutDay18_5.getDate() + 18); // Add 18 full days
            //         pulloutDay18_5.setHours(pulloutDay18_5.getHours() + 12); // Add 12 hours (0.5 day)

            //         // Format for input field (only date part)
            //         candlingProcess.d18_candling_date.value = pulloutDay18_5.toISOString().split('T')[0]; 

            //         // Calculate Day 21 Candling Date
            //         let pulloutDay21 = new Date(pulloutDate); // Clone date
            //         pulloutDay21.setDate(pulloutDay21.getDate() + 21); // Add 10 days
            //         hatcherProcess.hatcher_date.value = pulloutDay21.toISOString().split('T')[0]; // Format YYYY-MM-DD
                
            //         //------------------------
            //         let pulloutQty = Number(pulloutStorage.settable_eggs_qty.value) || 0;
            //         setterProcess.d10_inc_qty.value = pulloutQty;
            //     }
            // }

            // generateCurrentStepData();
            
        });
    </script>


    <script src="{{asset('js/loading-screen.js')}}" defer></script>
    <script src="{{asset('js/push-notification.js')}}" defer></script>    

</body>
</html>