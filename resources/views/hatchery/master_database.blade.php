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
</head>
<body>
    <input type="hidden" id="batch_no" name="batch_no" value="{{ isset($batch_no) ? $batch_no : '' }}">
    <input type="hidden" id="current_step" name="current_step" value="{{ isset($current_step) ? $current_step : '1' }}">


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
            <a href="#card9"><div></div><p>9</p></a>
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
                        <label for="ps_no">PS no. <span></span></label>
                        <x-dropdown :data-category="'ps_no'" />
                    </div>
                    <div class="input-group">
                        <label for="collected_qty">Collected Quantity <span></span></label>
                        <input type="number" name="collected_qty" id="collected_qty" placeholder="0">
                    </div>
                    <div class="input-group">
                        <label for="production_date_from">Production Date (From) <span></span></label>
                        <input type="date" name="production_date_from" id="production_date_from">
                    </div>
                    <div class="input-group">
                        <label for="production_date_to">Production Date (To) <span></span></label>
                        <input type="date" name="production_date_to" id="production_date_to">
                    </div>
                </div>

                <div class="form-action">
                    <button class="save-btn" type="submit">Save</button>
                    <button class="reset-btn" type="reset">Reset</button>
                </div>

            </form>

            <form class="card c2" id="card2">
                <div class="card-label">
                    <span>2</span>
                    <p>Classification for Storage</p>
                </div>

                <div class="card-form">
                    <div class="input-container">
                        <div class="input-group">
                            <label for="non_settable_eggs">Non-settable Eggs</label>
                            <input type="number" name="non_settable_eggs" id="non_settable_eggs" value="0">
                        </div>
                        <div class="input-group">
                            <label for="settable_eggs">Settable Eggs</label>
                            <input type="number" name="settable_eggs" id="settable_eggs" placeholder="0" readonly>
                        </div>
                    </div>
                    <br>

                    <div class="input-group">
                        <label for="remaining_balance">Remaining Balance</label>
                        <input type="number" name="remaining_balance" id="remaining_balance" placeholder="0" readonly>
                    </div>
                </div>

                <div class="form-action">
                    <button class="save-btn" type="submit">Save</button>
                    <button class="reset-btn" type="reset">Reset</button>
                </div>
            </form>

            <form class="card c3" id="card3">

                <div class="card-label">
                    <span>3</span>
                    <p>Storage Pullout Process</p>
                </div>

                <div class="card-form col-2">

                    <div class="input-group">
                        <label for="pullout_date">Pullout Date <span></span></label>
                        <input type="date" name="pullout_date" id="pullout_date">
                    </div>
                    
                    <div class="input-group">
                        <label for="settable_eggs_qty">Set. Egg Quantity <span></span></label>
                        <input type="number" name="settable_eggs_qty" id="settable_eggs_qty" placeholder="0">
                    </div>
                    <div class="input-group">
                        <label for="incubator_no">Incubator No. <span></span></label>
                        <x-dropdown :data-category="'incubator_no'" />
                    </div>
                    <div class="input-container">
                        <div class="input-group">
                            <label for="prime_qty">Prime Quantity <span></span></label>
                            <input type="number" name="prime_qty" id="prime_qty" placeholder="0">
                        </div>   
                        <div class="input-group prcnt">
                            <label for="prime_prcnt">%</label>
                            <input type="text" name="prime_prcnt" id="prime_prcnt" placeholder="0" readonly>
                        </div>                     
                    </div>
                    <br>
                    <div class="input-container">
                        <div class="input-group">
                            <label for="jp_qty">JP Quantity <span></span></label>
                            <input type="number" name="jp_qty" id="jp_qty" placeholder="0">
                        </div>   
                        <div class="input-group prcnt">
                            <label for="jp_prcnt">% <span></span></label>
                            <input type="text" name="jp_prcnt" id="jp_prcnt" placeholder="0" readonly>
                        </div>                     
                    </div>
                </div>

                <div class="form-action">
                    <button class="save-btn" type="submit">Save</button>
                    <button class="reset-btn" type="reset">Reset</button>
                </div>

            </form>

            <form class="card c4" id="card4">

                <div class="card-label">
                    <span>4</span>
                    <p>Setter Process Entry</p>
                </div>

                <div class="card-form col-2">
                    <div class="input-group">
                        <label for="d10_candling_date">Day 10 Candling Date <span></span></label>
                        <input type="date" name="d10_candling_date" id="d10_candling_date">
                    </div>
                    <div class="input-group">
                        <label for="d10_candling_qty">Day 10 Candling Quantity <span></span></label>
                        <input type="number" name="d10_candling_qty" id="d10_candling_qty" placeholder="0">
                    </div>
                    <div class="input-group">
                        <label for="d10_breakout_qty">Day 10 Breakout Quantity <span></span></label>
                        <input type="number" name="d10_breakout_qty" id="d10_breakout_qty" placeholder="0">
                    </div>
                    <div class="input-group">
                        <label for="d10_breakout_prcnt">Day 10 Breakout %</label>
                        <input type="text" name="d10_breakout_prcnt" id="d10_breakout_prcnt" placeholder="0" readonly>
                    </div>
                    <br>
                    <div class="input-group">
                        <label for="d10_inc_qty">Day 10  Inc Quantity</label>
                        <input type="text" name="d10_inc_qty" id="d10_inc_qty" placeholder="0" readonly>
                    </div>
                </div>

                <div class="form-action">
                    <button class="save-btn" type="submit">Save</button>
                    <button class="reset-btn" type="reset">Reset</button>
                </div>

            </form>

            <form class="card c5" id="card5">

                <div class="card-label">
                    <span>5</span>
                    <p>Candling Process Entry</p>
                </div>

                <div class="card-form">

                    <div class="input-group">
                        <label for="d18_candling_date">Day 18.5 Candling Date <span></span></label>
                        <input type="date" name="d18_candling_date" id="d18_candling_date">
                    </div>
                    <br>
                    <div class="input-group">
                        <label for="infertiles_qty">Infertiles Quantity <span></span></label>
                        <input type="number" name="infertiles_qty" id="infertiles_qty" placeholder="0">
                    </div>
                    <br>    
                    <div class="input-group">
                        <label for="embyonic_eggs_qty">Embryonic Eggs Quantity <span></span></label>
                        <input type="text" name="embyonic_eggs_qty" id="embyonic_eggs_qty" placeholder="0" readonly>
                    </div>

                </div>

                <div class="form-action">
                    <button class="save-btn" type="submit">Save</button>
                    <button class="reset-btn" type="reset">Reset</button>
                </div>

            </form>

            <form class="card c6" id="card6">

                <div class="card-label">
                    <span>5.1</span>
                    <p>Egg Shell Temperature Check</p>
                </div>

                <div class="card-form">
                    <div class="input-container">
                
                        <label for="">TOP LOCATION </label>
                        <div class="input-container">
                            <div class="input-group">
                                <label for="top_above_temp_qty">37.8 <span></span></label>
                                <input type="number" name="top_above_temp_qty" id="top_above_temp_qty" placeholder="0">
                            </div>   
                            <div class="input-group prcnt">
                                <label for="top_above_temp_prcnt">%</label>
                                <input type="text" name="top_above_temp_prcnt" id="top_above_temp_prcnt" placeholder="0" readonly>
                            </div>                    
                        </div>
                        <div class="input-container">
                            <div class="input-group">
                                <label for="top_below_temp_qty">37.7 <span></span></label>
                                <input type="number" name="top_below_temp_qty" id="top_below_temp_qty" placeholder="0">
                            </div>   
                            <div class="input-group prcnt">
                                <label for="top_below_temp_prcnt">%</label>
                                <input type="text" name="top_below_temp_prcnt" id="top_below_temp_prcnt" placeholder="0" readonly>
                            </div>                    
                        </div>
                    </div>
                    <br>
                    <div class="input-container">
                        <label for="">MID LOCATION </label>
                        <div class="input-container">
                            <div class="input-group">
                                <label for="mid_above_temp_qty">37.8 <span></span></label>
                                <input type="number" name="mid_above_temp_qty" id="mid_above_temp_qty" placeholder="0">
                            </div>   
                            <div class="input-group prcnt">
                                <label for="mid_above_temp_prcnt">%</label>
                                <input type="text" name="mid_above_temp_prcnt" id="mid_above_temp_prcnt" placeholder="0" readonly>
                            </div>                    
                        </div>
                        <div class="input-container">
                            <div class="input-group">
                                <label for="mid_below_temp_qty">37.7 <span></span></label>
                                <input type="number" name="mid_below_temp_qty" id="mid_below_temp_qty" placeholder="0">
                            </div>   
                            <div class="input-group prcnt">
                                <label for="mid_below_temp_prcnt">%</label>
                                <input type="text" name="mid_below_temp_prcnt" id="mid_below_temp_prcnt" placeholder="0" readonly>
                            </div>                    
                        </div>
                    </div>
                    <br>
                    <div class="input-container">
                        <label for="">LOW LOCATION </label>
                        <div class="input-container">
                            <div class="input-group">
                                <label for="low_above_temp_qty">37.8 <span></span></label>
                                <input type="number" name="low_above_temp_qty" id="low_above_temp_qty" placeholder="0">
                            </div>   
                            <div class="input-group prcnt">
                                <label for="low_above_temp_prcnt">%</label>
                                <input type="text" name="low_above_temp_prcnt" id="low_above_temp_prcnt" placeholder="0" readonly>
                            </div>                    
                        </div>
                        <div class="input-container">
                            <div class="input-group">
                                <label for="low_below_temp_qty">37.7 <span></span></label>
                                <input type="number" name="low_below_temp_qty" id="low_below_temp_qty" placeholder="0">
                            </div>   
                            <div class="input-group prcnt">
                                <label for="low_below_temp_prcnt">%</label>
                                <input type="text" name="low_below_temp_prcnt" id="low_below_temp_prcnt" placeholder="0" readonly>
                            </div>                    
                        </div>
                    </div>
                </div>

                <div class="form-action">
                    <button class="save-btn" type="submit">Save</button>
                    <button class="reset-btn" type="reset">Reset</button>
                </div>
            </form>

            <form class="card c7" id="card7">
                <div class="card-label">
                    <span>6</span>
                    <p>Hatcher Pullout Process</p>
                </div>

                <div class="card-form col-2">
                    <div class="input-group">
                        <label for="hatcher_no">Hatcher No <span></span></label>
                        <x-dropdown :data-category="'hatcher_no'" />
                    </div>
                    <div class="input-group">
                        <label for="hatcher_date">Hatcher Date <span></span></label>
                        <input type="date" name="hatcher_date" id="hatcher_date">
                    </div>
                    <div class="input-group">
                        <label for="rejected_hatch_qty">Rejected Hatch Qty <span></span></label>
                        <input type="number" name="rejected_hatch_qty" id="rejected_hatch_qty" placeholder="0">
                    </div>
                    <div class="input-group">
                        <label for="accepted_hatch_qty">Good Hatch Qty <span></span></label>
                        <input type="text" name="accepted_hatch_qty" id="accepted_hatch_qty" placeholder="0" readonly>
                    </div>
                </div>

                <div class="form-action">
                    <button class="save-btn" type="submit">Save</button>
                    <button class="reset-btn" type="reset">Reset</button>
                </div>
            </form>

            <form class="card c8" id="card8">
                <div class="card-label">
                    <span>7</span>
                    <p>Sexing</p>
                </div>

                <div class="card-form">
                    <div class="input-group">
                        <label for="cock_qty">Cockerels Quantity <span></span></label>
                        <input type="number" name="cock_qty" id="cock_qty" placeholder="0">
                    </div>
                    <br>
                    <div class="input-group">
                        <label for="dop_qty">DOP Quantity <span></span></label>
                        <input type="text" name="dop_qty" id="dop_qty" placeholder="0" readonly>
                    </div>
                </div>

                <div class="form-action">
                    <button class="save-btn" type="submit">Save</button>
                    <button class="reset-btn" type="reset">Reset</button>
                </div>

                
            </form>

            <form class="card c9" id="card9">
                <div class="card-label">
                    <span>8</span>
                    <p>QC/QA Process Entry</p>
                </div>

                <div class="card-form">
                    <div class="input-group">
                        <label for="qc_date">QC Date <span></span></label>
                        <input type="date" name="qc_date" id="qc_date">
                    </div>
                    <br>
                    <div class="input-container">
                        <div class="input-group">
                            <label for="rejected_dop_qty">Rejected DOP Qty <span></span></label>
                            <input type="number" name="rejected_dop_qty" id="rejected_dop_qty" placeholder="0">
                        </div>
                        
                        <div class="input-group">
                            <label for="accepted_dop_qty">Good DOP Qty <span></span></label>
                            <input type="text" name="accepted_dop_qty" id="accepted_dop_qty" placeholder="0" readonly>
                        </div>
                    </div>

                </div>

                <div class="form-action">
                    <button class="save-btn" type="submit">Save</button>
                    <button class="reset-btn" type="reset">Reset</button>
                </div>
            </form>

            <form class="card c10" id="card10">
                <div class="card-label">
                    <p>Forecast Base on Last Hatch</p>
                </div>

                <div class="card-form col-33">
                    <div class="input-container">
                        <div class="input-group">
                            <label for="infertile_qty">Infertile Qty</label>
                            <input type="number" name="infertile_qty" id="infertile_qty" placeholder="0" readonly>
                        </div>
                        
                        <div class="input-group prcnt">
                            <label for="infertile_prcnt">% <span></span></label>
                            <input type="number" name="infertile_prcnt" id="infertile_prcnt" placeholder="0">
                        </div>
                    </div>

                    <div class="input-container">
                        <div class="input-group">
                            <label for="frcst_cock_qty">Cock Qty</label>
                            <input type="number" name="frcst_cock_qty" id="frcst_cock_qty" placeholder="0" readonly>
                        </div>
                        
                        <div class="input-group prcnt">
                            <label for="frcst_cock_prcnt">% <span></span></label>
                            <input type="number" name="frcst_cock_prcnt" id="frcst_cock_prcnt" placeholder="0">
                        </div>
                    </div>
                    <br>
                    <div class="input-container">
                        <div class="input-group">
                            <label for="frcst_rejected_hatch_qty">Rejected Hatch Qty</label>
                            <input type="number" name="frcst_rejected_hatch_qty" id="frcst_rejected_hatch_qty" placeholder="0" readonly>
                        </div>
                        
                        <div class="input-group prcnt">
                            <label for="frcst_rejected_hatch_prcnt">% <span></span></label>
                            <input type="number" name="frcst_rejected_hatch_prcnt" id="frcst_rejected_hatch_prcnt" placeholder="0">
                        </div>
                    </div>
                    <div class="input-container">
                        <div class="input-group">
                            <label for="frcst_rejected_dop_qty">Rejected DOP Qty</label>
                            <input type="number" name="frcst_rejected_dop_qty" id="frcst_rejected_dop_qty" placeholder="0" readonly>
                        </div>
                        
                        <div class="input-group prcnt">
                            <label for="frcst_rejected_dop_prcnt">% <span></span></label>
                            <input type="number" name="frcst_rejected_dop_prcnt" id="frcst_rejected_dop_prcnt" placeholder="0">
                        </div>
                    </div>
                    <div class="input-group">
                        <label for="forecast_total_qty">Total Qty</label>
                        <input type="number" name="forecast_total_qty" id="forecast_total_qty" placeholder="0" readonly>
                    </div>
                    
                </div>

                <div class="card-label">
                    <p>Forecast # of Boxes</p>
                </div>

                <div class="card-form col-33">
                    <div class="input-group">
                        <label for="frcst_total_boxes">Total</label>
                        <input type="text" name="frcst_total_boxes" id="frcst_total_boxes" placeholder="0">
                    </div>
                    <div class="input-group">
                        <label for="frcst_settable_eggs_prcnt">%</label>
                        <input type="text" name="frcst_settable_eggs_prcnt" id="frcst_settable_eggs_prcnt" placeholder="0">
                    </div>
                    <br>
                    <div class="input-group">
                        <label for="frcst_prime">Prime</label>
                        <input type="text" name="frcst_prime" id="frcst_prime" placeholder="0">
                    </div>
                    <div class="input-group">
                        <label for="frcst_jr_prime">Junior Prime</label>
                        <input type="text" name="frcst_jr_prime" id="frcst_jr_prime" placeholder="0">
                    </div>
                    <div class="input-group">
                        <label for="">DOP Booking</label>
                        <button style="width: 100%; margin-top: 10px; color: white; background-color: #EC8B18; border: none; padding: 10px; border-radius: 7px; cursor: pointer; font-size: 15px;">View / Entry</button>
                    </div>
                </div>
            
            </form>

            <form class="card c11" id="card11">
                <div class="card-label">
                    <span>9</span>
                    <p>Dispath Process Entry</p>
                </div>

                <div class="card-form">
                    <div class="input-group">
                        <label for="dispatch_prime_qty">Prime Qty <span></span></label>
                        <input type="number" name="dispatch_prime_qty" id="dispatch_prime_qty" placeholder="0">
                    </div>
                    <br>
                    <div class="input-group">
                        <label for="dispatch_jr_prime_qty">Jr Prime Qty <span></span></label>
                        <input type="number" name="dispatch_jr_prime_qty" id="dispatch_jr_prime_qty" placeholder="0">
                    </div>
                </div>

                <div class="form-action">
                    <button class="save-btn" type="submit">Save</button>
                    <button class="reset-btn" type="reset">Reset</button>
                </div>
            </form>

            <form class="card c12" id="card12">
                <h1 id="total_boxes">0</h1>
                <p>Forcasted Number of <br> Boxes</p>
            </form>

            <div class="card c13" id="card13">
                <div class="table-header">
                    <h4>Data List</h4>
        
                    <div class="table-action">
                        <div class="search-bar">
                            <input type="text" placeholder="Search...">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
        
                        <select class="sort-btn">
                            <option value=""> Sort By</option>
                        </select>
        
                        <div class="table-icons">
                            <i class="fa-solid fa-print"></i>
                            <i class="fa-solid fa-rotate-right"></i>
                        </div>
                        
                    </div>
        
                </div>
                <div class="table-body">
                    <table>
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>PS no.</th>
                                <th>Production Date (From)</th>
                                <th>Production Date (To)</th>
                                <th>Collected QTY</th>
                                <th>Non Settable Eggs QTY</th>
                                <th>Storage Settable Eggs</th>
                                <th>Storage Remaining Balance</th>
                                <th>Pullout Date</th>
                                <th>Pullout Settable Eggs QTY</th>
                                <th>Incubator</th>
                                <th>Day 10 Candling Date</th>
                                <th>Day 10 Candling Eggs QTY</th>
                                <th>Day 10 Breakout QTY</th>
                                <th>Day 10 Breakout %</th>
                                <th>Day 10 Incubated Eggs</th>
                                <th>Top 37.8 UP QTY</th>
                                <th>Top 37.8 UP%</th>
                                <th>Top 37.7 BELOW QTY</th>
                                <th>Top 37.7 BELOW %</th>
                                <th>Mid 37.8 UP QTY</th>
                                <th>Mid 37.8 %</th>
                                <th>Mid 37.7 BELOW QTY</th>
                                <th>Mid 37.7 BELOW %</th>
                                <th>Low 37.8 UP QTY</th>
                                <th>Low 37.8 UP %</th>
                                <th>Low 37.7 BELOW QTY</th>
                                <th>Low 37.7 BELOW %</th>
                                <th>Day 18.5 Candling Date</th>
                                <th>Day 18.5 Infertile QTY</th>
                                <th>Day 18.5 Embryonic QTY</th>
                                <th>Hatcher</th>
                                <th>Hatch Date</th>
                                <th>Rejected Hatch QTY</th>
                                <th>Good Hatch QTY</th>
                                <th>Cockerels QTY</th>
                                <th>DOP QTY</th>
                                <th>QC Date</th>
                                <th>Rejected DOP QTY</th>
                                <th>Good DOP QTY</th>
                                <th>Prime QTY</th>
                                <th>JR Prime QTY</th>
                                <th># of Boxes</th>
                                <th>Infertile %</th>
                                <th>Infertile EST QTY</th>
                                <th>Rejected Hatch %</th>
                                <th>Rejected Hatch EST QTY</th>
                                <th>Cockerels %</th>
                                <th>Cockerels EST QTY</th>
                                <th>Rejected DOP %</th>
                                <th>Rejected DOP EST QTY</th>
                                <th>Total Rejects QTY</th>
                                <th>Projected # of Boxes</th>
                                <th>Prime Set QTY</th>
                                <th>Prime Set %</th>
                                <th>JP Set QTY</th>
                                <th>JP Set %</th>
                                <th>Prime Forecast QTY</th>
                                <th>JP Forecast QTY</th>
                                <th>Customer 1</th>
                                <th>Customer 2</th>
                                <th>Customer 3</th>
                                <th>Customer 4</th>
                                <th>Customer 5</th>
                                <th>CUST 1 Prime QTY</th>
                                <th>CUST 2 Prime QTY</th>
                                <th>CUST 3 Prime QTY</th>
                                <th>CUST 4 Prime QTY</th>
                                <th>CUST 5 Prime QTY</th>
                                <th>CUST 1 JR Prime QTY</th>
                                <th>CUST 2 JR Prime QTY</th>
                                <th>CUST 3 JR Prime QTY</th>
                                <th>CUST 4 JR Prime QTY</th>
                                <th>CUST 5 JR Prime QTY</th>
                                <th>Projected # of Boxes %</th>
                                <th>Encoded/Modified By</th>
                                <th>Date Encoded/Modified</th>
                                <th>Action Done</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>#93</td>
                                <td>09/12/25</td>
                                <td>09/12/25</td>
                                <td>30000</td>
                                <td>0</td>
                                <td>30000</td>
                                <td>30000</td>
                                <td>09/15/25</td>
                                <td>29000</td>
                                <td>Incubator A</td>
                                <td>09/20/25</td>
                                <td>28500</td>
                                <td>500</td>
                                <td>1.75%</td>
                                <td>28000</td>
                                <td>15000</td>
                                <td>53.57%</td>
                                <td>13000</td>
                                <td>46.43%</td>
                                <td>14000</td>
                                <td>50.00%</td>
                                <td>14000</td>
                                <td>50.00%</td>
                                <td>12000</td>
                                <td>42.86%</td>
                                <td>16000</td>
                                <td>57.14%</td>
                                <td>09/28/25</td>
                                <td>500</td>
                                <td>400</td>
                                <td>Hatcher B</td>
                                <td>10/02/25</td>
                                <td>300</td>
                                <td>27000</td>
                                <td>12000</td>
                                <td>15000</td>
                                <td>10/04/25</td>
                                <td>200</td>
                                <td>14800</td>
                                <td>14000</td>
                                <td>800</td>
                                <td>600</td>
                                <td>10</td>
                                <td>1.79%</td>
                                <td>500</td>
                                <td>1.11%</td>
                                <td>300</td>
                                <td>42.86%</td>
                                <td>12000</td>
                                <td>1.35%</td>
                                <td>200</td>
                                <td>1000</td>
                                <td>8</td>
                                <td>26000</td>
                                <td>92.86%</td>
                                <td>1000</td>
                                <td>7.14%</td>
                                <td>25000</td>
                                <td>Customer A</td>
                                <td>Customer B</td>
                                <td>Customer C</td>
                                <td>Customer D</td>
                                <td>Customer E</td>
                                <td>5000</td>
                                <td>5000</td>
                                <td>5000</td>
                                <td>5000</td>
                                <td>5000</td>
                                <td>1000</td>
                                <td>1000</td>
                                <td>1000</td>
                                <td>1000</td>
                                <td>1000</td>
                                <td>85%</td>
                                <td>John Doe</td>
                                <td>10/05/25</td>
                                <td>Updated</td>
                                <td class="datalist-actions">
                                    <i class="fa-regular fa-pen-to-square" id="edit-action"></i>
                                    <i class="fa-regular fa-trash-can" id="delete-action"></i>
                                    <i class="fa-solid fa-print" id="print-action"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>#93</td>
                                <td>09/12/25</td>
                                <td>09/12/25</td>
                                <td>30000</td>
                                <td>0</td>
                                <td>30000</td>
                                <td>30000</td>
                                <td>09/15/25</td>
                                <td>29000</td>
                                <td>Incubator A</td>
                                <td>09/20/25</td>
                                <td>28500</td>
                                <td>500</td>
                                <td>1.75%</td>
                                <td>28000</td>
                                <td>15000</td>
                                <td>53.57%</td>
                                <td>13000</td>
                                <td>46.43%</td>
                                <td>14000</td>
                                <td>50.00%</td>
                                <td>14000</td>
                                <td>50.00%</td>
                                <td>12000</td>
                                <td>42.86%</td>
                                <td>16000</td>
                                <td>57.14%</td>
                                <td>09/28/25</td>
                                <td>500</td>
                                <td>400</td>
                                <td>Hatcher B</td>
                                <td>10/02/25</td>
                                <td>300</td>
                                <td>27000</td>
                                <td>12000</td>
                                <td>15000</td>
                                <td>10/04/25</td>
                                <td>200</td>
                                <td>14800</td>
                                <td>14000</td>
                                <td>800</td>
                                <td>600</td>
                                <td>10</td>
                                <td>1.79%</td>
                                <td>500</td>
                                <td>1.11%</td>
                                <td>300</td>
                                <td>42.86%</td>
                                <td>12000</td>
                                <td>1.35%</td>
                                <td>200</td>
                                <td>1000</td>
                                <td>8</td>
                                <td>26000</td>
                                <td>92.86%</td>
                                <td>1000</td>
                                <td>7.14%</td>
                                <td>25000</td>
                                <td>Customer A</td>
                                <td>Customer B</td>
                                <td>Customer C</td>
                                <td>Customer D</td>
                                <td>Customer E</td>
                                <td>5000</td>
                                <td>5000</td>
                                <td>5000</td>
                                <td>5000</td>
                                <td>5000</td>
                                <td>1000</td>
                                <td>1000</td>
                                <td>1000</td>
                                <td>1000</td>
                                <td>1000</td>
                                <td>85%</td>
                                <td>John Doe</td>
                                <td>10/05/25</td>
                                <td>Updated</td>
                                <td class="datalist-actions">
                                    <i class="fa-regular fa-pen-to-square" id="edit-action"></i>
                                    <i class="fa-regular fa-trash-can" id="delete-action"></i>
                                    <i class="fa-solid fa-print" id="print-action"></i>
                                </td>
                            </tr>
                        </tbody>
                        
                    </table>
                </div>
                <div class="table-footer">
                    <div class="pagination">
                        <a href="#" class="active">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#">4</a>
                        <a href="#">5</a>
                        <a href="#"><i class="fa-solid fa-caret-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // CSRF token
            const sidebarLinks = document.querySelectorAll(".sidebar a");
            const cardSections = document.querySelectorAll(".card");
            const cardLabels = document.querySelectorAll(".card-label");
            const datalist = document.getElementById("card13");
            let activeForm = null;

            let batchNumber = document.getElementById("batch_no").value;
            let currentStep = Number(document.getElementById("current_step").value);

            let currentStep = 1;

            /*** Event Listeners ***/
            datalist.addEventListener("pointerdown", function () {
                activateSection(this);
            });

                // Event Listener: Sidebar Clicks
            sidebarLinks.forEach(link => {
                link.addEventListener("click", function (event) {
                    const targetCard = document.querySelector(this.getAttribute("href"));
                    activateSection(targetCard);
                });
            });

                // Event Listener: Input Focus
            document.querySelectorAll(".card input, .card select, .card textarea").forEach(input => {
                input.addEventListener("focus", function () {
                    activateSection(this.closest(".card"));
                });
            });

                // Event Listener: Form Close Buttons
            document.addEventListener("click", function (event) {
                const modal = document.getElementById("modal");

                if (!modal.classList.contains("active")) return;

                if (event.target.id === "close-button" || event.target.classList.contains("cancel-button")) {
                    modal.classList.remove("active");
                }
            });

            /*** Initialize First Form ***/
            if (cardSections.length > 0) {
                activateSection(cardSections[0]);
            }

            /*** Section Activation ***/
            function activateSection(targetCard) {
                if (!targetCard) return;

                // Remove 'active' class from all sections
                sidebarLinks.forEach(link => link.classList.remove("active"));
                cardLabels.forEach(label => label.classList.remove("active"));
                cardSections.forEach(card => card.classList.remove("active"));

                // Activate the target section
                document.querySelector(`.sidebar a[href="#${targetCard.id}"]`)?.classList.add("active");
                targetCard.querySelector(".card-label")?.classList.add("active");
                targetCard.classList.add("active");

                activeForm = targetCard; // Update active form

                // Hide all form-action sections except inside the active form
                document.querySelectorAll(".form-action").forEach(action => {
                    action.style.display = targetCard.contains(action) ? "flex" : "none";
                });

                // Update event listeners for the new active form
                updateFormListener();
            }

            /*** Form Handling ***/
            function updateFormListener() {
                if (!activeForm) return;

                let formInputs = activeForm.querySelectorAll("input, select, textarea");
                let resetButtons = activeForm.querySelectorAll(".form-action .reset-btn");
                let formAction = activeForm.querySelector(".form-action");

                if (!formInputs.length || !formAction) return; // Avoid errors

                let formStep = parseInt(activeForm.id.replace("card", "")); // Extract step number

                // Function to check if form has values
                function checkFormValues() {
                    // Show action buttons **only if form is at currentStep**
                    if (formStep === currentStep || formStep === 6 || formStep === 10) {
                        formAction.style.display = [...formInputs].some(input => input.value.trim() !== "") ? "flex" : "none";
                    } else {
                        formAction.style.display = "none"; // Hide for completed steps
                    }
                }

                // Remove previous event listeners (prevents duplicates)
                formInputs.forEach(input => {
                    input.oninput = checkFormValues;
                    input.onchange = checkFormValues;
                });

                resetButtons.forEach(button => {
                    button.onclick = function () {
                        formInputs.forEach(input => {
                            input.value = ""; // Clear all inputs
                            input.style.border = ""; // Reset borders
                            let labelSpan = input.closest(".input-group")?.querySelector("label span");
                            if (labelSpan) labelSpan.textContent = "";
                        });
                        formAction.style.display = "none"; // Hide form actions
                    };
                });

                // Remove existing submit event before adding a new one
                activeForm.onsubmit = function (event) {
                    event.preventDefault();
                    if (validateForm()) {
                        showModal('save');
                        // simulateFormSave();
                    }
                };

                // Initial check (for pre-filled forms)
                checkFormValues();
            }

            /*** Form Validation ***/
            function validateForm() {
                if (!activeForm) return false; // Ensure activeForm exists

                let isValid = true;

                // Define required fields per form ID
                let requiredFields = {
                    "card1": ["ps_no", "collected_qty", "production_date_from", "production_date_to"],
                    "card2": ["non_settable_eggs"],
                    "card3": ["pullout_date", "settable_eggs_qty", "incubator_no", "prime_qty", "jp_qty"],
                    "card4": ["d10_candling_date", "d10_breakout_qty", "d10_candling_qty"],
                    "card5": ["d18_candling_date", "infertiles_qty"],
                    "card6": ["top_above_temp_qty", "top_below_temp_qty", "mid_above_temp_qty", "mid_below_temp_qty", "low_above_temp_qty", "low_below_temp_qty"],
                    "card7": ["hatcher_no", "hatcher_date", "rejected_hatch_qty"],
                    "card8": ["cock_qty"],
                    "card9": ["qc_date", "rejected_dop_qty"],
                    "card10": ["infertile_prcnt", "frcst_cock_prcnt", "frcst_rejected_hatch_prcnt", "frcst_rejected_dop_prcnt"],
                    "card11": ["dispatch_prime_qty"],
                };

                // Get fields for the currently active form
                let currentRequiredFields = requiredFields[activeForm.id] || [];

                currentRequiredFields.forEach(id => {
                    let field = activeForm.querySelector(`#${id}`); // Select field inside active form only
                    if (!field) return; // Skip if field is not found

                    let labelSpan = field.closest(".input-group")?.querySelector("label span");

                    if (!field.value.trim()) {
                        field.style.border = "2px solid #ea4435d7";

                        if (labelSpan) {
                            labelSpan.textContent = "This field is required";
                            labelSpan.style.color = "#ea4435d7";
                        }

                        isValid = false;
                    } else {
                        field.style.border = "";
                        if (labelSpan) labelSpan.textContent = "";
                    }
                });

                return isValid;
            }

            /*** Step Progression ***/
            const skippableCards = ["card6", "card10"];
            const alwaysEnabledCards = ["card10", "card13"];
            const allCards = document.querySelectorAll(".card");

            function proceedToNextStep() {
                currentStep++;
                autoSkipStep();
                disableFutureForms();

                //Lock Completed Steps
                lockCompletedSteps(currentStep);
            }

            function autoSkipStep() {
                while (skippableCards.includes(`card${currentStep}`)) {
                    currentStep++; 
                }
            }

            function disableFutureForms() {
                allCards.forEach(card => {
                    let stepNumber = parseInt(card.id.replace("card", ""));

                    if (alwaysEnabledCards.includes(card.id)) {
                        // Ensure alwaysEnabledCards remain active
                        card.classList.remove("disabled");
                        card.querySelectorAll("input, select, textarea").forEach(input => input.disabled = false);
                    } else if (stepNumber > currentStep) {
                        // Disable non-skippable future steps
                        card.classList.add("disabled");
                        card.querySelectorAll("input, select, textarea").forEach(input => input.disabled = true);
                    } else {
                        card.classList.remove("disabled");
                        card.querySelectorAll("input, select, textarea").forEach(input => input.disabled = false);
                    }
                });
            }

            function lockCompletedSteps(currentStep) {
                document.querySelectorAll(".card").forEach(card => {
                    let stepNumber = parseInt(card.id.replace("card", "")); // Extract step number

                    let exemptSteps = [6, 10]; // Skippable but needs its own condition

                    if (stepNumber < currentStep && !exemptSteps.includes(stepNumber)) {
                        // Disable all inputs inside the card
                        card.querySelectorAll("input, select, textarea").forEach(input => {
                            input.setAttribute("readonly", true);
                            input.setAttribute("disabled", true); // For select dropdowns
                        });

                        // Hide the save button inside the card
                        let saveButton = card.querySelector(".form-action");
                        if (saveButton) saveButton.style.display = "none";

                        // Change border color to gray to indicate completion
                        card.style.borderColor = "gray";
                    }
                    
                    // **Handle Card 6 & 10 based on existing data**
                    // if (exemptSteps.includes(stepNumber)) {
                    //     checkIfDataExists(stepNumber, card);
                    // }
                });
            }

            /*** Initial Setup ***/
            autoSkipStep();
            disableFutureForms();
            // lockCompletedSteps(currentStep);



            function simulateFormSave() {
                if (!activeForm) return;

                let stepNumber = parseInt(activeForm.id.replace("card", ""));
                
                // Simulate saving
                console.log(`Current Step ${currentStep} Done. Form ${activeForm.id} saved! Proceeding to Step ${currentStep + 1}`);

                document.getElementById("modal").classList.remove("active");

                // Proceed to the next step **only if its Card 6 or 10**
                if (stepNumber !== 6 && stepNumber !== 10) {
                    proceedToNextStep();
                } else {
                    // If it's not Card 6 or 10, disable it after saving
                    lockCompletedSteps(currentStep);
                }
            }



            // function checkIfDataExists(stepNumber, card) {
            //     // fetch(`/check-card-data/${stepNumber}`) // Adjust to your backend route
            //     //     .then(response => response.json())
            //     //     .then(data => {
            //     //         if (data.exists) {
            //     //             // Disable Card 6 or 10 if data is already saved
            //     //             card.querySelectorAll("input, select, textarea").forEach(input => {
            //     //                 input.setAttribute("readonly", true);
            //     //                 input.setAttribute("disabled", true);
            //     //             });

            //     //             // Hide the save button
            //     //             let saveButton = card.querySelector(".form-action");
            //     //             if (saveButton) saveButton.style.display = "none";

            //     //             // Change border color to gray
            //     //             card.style.borderColor = "gray";
            //     //         }
            //     //     })
            //     //     .catch(error => console.error("Error checking data:", error));

            //     // Disable Card 6 or 10 if data is already saved
            //     card.querySelectorAll("input, select, textarea").forEach(input => {
            //         input.setAttribute("readonly", true);
            //         input.setAttribute("disabled", true);
            //     });

            //     // Hide the save button
            //     let saveButton = card.querySelector(".form-action");
            //     if (saveButton) saveButton.style.display = "none";

            //     // Change border color to gray
            //     card.style.borderColor = "gray";
            // }

            function showModal(button, targetID = null) {
                if (button === "save") {
                    modal.classList.add("active");
                    modal.innerHTML = `
                        <div class="modal-content">
                            <i class="fa-solid fa-xmark" id="close-button"></i>
                            <div class="modal-header">
                                <i class="fa-solid fa-circle-check success"></i>
                                <h2>Save Record</h2>
                                <h4>Are you sure you want to save this data?</h4>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="confirm-button save-btn">
                                    Save
                                </button>
                                <button type="button" class="cancel-button">Cancel</button>
                            </div>
                        </div>
                    `;

                    document.querySelector('.save-btn').addEventListener('click', () => {
                        storeRecord();
                        // simulateFormSave();
                    });
                }
            }


            const saveFunctions = {
                "card1": saveCollectedEggs,
                "card2": saveClassificationForStorage
            }

            function storeRecord(){
                if (!activeForm) return;
                let stepNumber = parseInt(activeForm.id.replace("card", ""));

                if (saveFunctions[activeForm.id]) {
                    saveFunctions[activeForm.id]();
                }

                document.getElementById("modal").classList.remove("active");

                // Proceed to the next step **only if its Card 6 or 10**
                if (stepNumber !== 6 && stepNumber !== 10) {
                    proceedToNextStep();
                } else {
                    // If it's not Card 6 or 10, disable it after saving
                    lockCompletedSteps(currentStep);
                }
            }

            function saveData(url, data, successMessage) {
                fetch(url, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken
                    },
                    body: JSON.stringify({
                        // batch_no: batchNumber,
                        current_step: currentStep,
                        process_data: data,
                    })
                })
                .then(response => response.json())
                .then(responseData => {
                    if (responseData.success) {
                        createPushNotification("success", "Saved Successfully", successMessage);
                    } else {
                        createPushNotification("error", "Save Failed", "Error saving record.");
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    createPushNotification("error", "Save Failed", "An error occurred while saving.");
                });
            }

            function saveCollectedEggs() {
                let data = {
                    collected_eggs: {
                        ps_no: document.getElementById("ps_no").value,
                        collected_qty: document.getElementById("collected_qty").value,
                        production_date_from: document.getElementById("production_date_from").value,
                        production_date_to: document.getElementById("production_date_to").value,                        
                    }
                };
                saveData("/master-database/store", data, "Collected Eggs Entry Saved Successfully");
            }

            function saveClassificationForStorage() {
                // Code to save classification for storage data 
                console.log('Saving classification for storage data...');
            }
        });
    </script>

    <script src="{{asset('js/master_database.js')}}" defer></script>
    <script src="{{asset('js/loading-screen.js')}}" defer></script>
    <script src="{{asset('js/push-notification.js')}}" defer></script>
</body>
</html>