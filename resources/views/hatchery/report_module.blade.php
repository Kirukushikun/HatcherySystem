<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Crucial Part on every forms -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Crucial Part on every forms/ -->
    <title>Document</title>
    <link rel="icon" href="/Images/BGC icon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/css/modal-notification-loader.css">
    <link rel="stylesheet" href="/css/report-styles.css">
</head>
<body>

    <input type="text" class="targetForm" value="{{$targetForm}}" id="targetForm" hidden>

    <div class="report-container">
        @if($targetForm == "egg-collection" && $targetForm != null)
            <form class="report-content">
                <div class="report-header">
                    <img src="/Images/BDL.png" id="BDL" alt="Brookdale Farms">
                    <img src="/Images/BGC.png" id="BGC" alt="Brookside Group of Companies">
                    <img src="/Images/PFC.png" id="PFC" alt="Poultrypure Farms">
                </div>

                <div class="report-title">EGG COLLECTION REPORT</div>

                <div class="report-form">

                    <div class="form-container col-2">
                        <div class="form-group">
                            <label for="ps_no">PS No:</label>
                            <x-dropdown :data-category="'ps_no'" />
                        </div>
                        <!-- <div class="form-group">
                            <label for="house_no">House No:</label>
                            <select name="house_no" id="house_no" multiple multiselect-select-all="true" multiselect-search="true" >
                            </select>
                        </div> -->
                        <div class="form-group">
                            <label for="production_date_from">Production Date:</label>
                            <input type="date" id="production_date_from">
                        </div>
                        <!-- <div class="form-group">
                            <label for="production_date_to">Production Date (To):</label>
                            <input type="date" id="production_date_to">
                        </div>
                        <div class="form-group">
                            <label for="collection_time">Collection Time:</label>
                            <input type="time" id="collection_time">
                        </div>    
                        <div class="form-group">
                            <label for="collected_qty">Collection QTY:</label>
                            <input type="number" id="collected_qty" readonly>
                        </div>          -->
                    </div>

                    <div class="form-container">
                        <!-- <table id="egg-collection-table">
                            <thead>
                            </thead>
                            <tbody>
                            </tbody>
                        </table> -->
                        <table id="egg-collection-table">
                            <thead><tr><th>PS No.</th><th>HS No. 1</th><th>HS No. 2</th><th>HS No. 3</th><th>Total:</th></tr></thead>
                            <tbody>
                                <tr><td>90</td><td>3000</td><td>4000</td><td>4000</td><td>11000</td></tr><tr><td colspan="4">Grand Total:</td><td>11000</td></tr>
                                <tr><td>91</td><td>3000</td><td>4000</td><td>4000</td><td>11000</td></tr><tr><td colspan="4">Grand Total:</td><td>11000</td></tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="form-container col-2">
                        <div class="form-group">
                            <label for="prepared-by">Prepared By:</label>

                            <!-- Signature Image (Fixed Size) -->
                            <img class="signature" src="/Images/DummySignature.png" alt="Signature">

                            <!-- Prepared By Input Field -->
                            <input type="text" id="prepared-by" value="Chris P. Bacon" readonly>
                        </div>

                        <div class="form-group">
                            <label for="date-prepared">Date Prepared:</label>
                            <input type="text" id="date-prepared" value="{{ date('d/m/Y') }} {{ date('H:i A') }}" readonly>
                        </div>
                    </div>
                </div>

                <div class="report-footer">
                    Brookside Group of Companies | Brookdale Farms | Poultrypure Farms
                </div>
            </form>
        @elseif ($targetForm == "egg-temperature" && $targetForm != null)
            <form class="report-content">
                <div class="report-header">
                    <img src="/Images/BDL.png" id="BDL" alt="Brookdale Farms">
                    <img src="/Images/BGC.png" id="BGC" alt="Brookside Group of Companies">
                    <img src="/Images/PFC.png" id="PFC" alt="Poultrypure Farms">
                </div>

                <div class="report-title">EGG SHELL TEMPERATURE CHECK REPORT</div>

                <div class="report-form">

                    <div class="form-container col-2">
                        <div class="form-group">
                            <label for="ps_no">PS No: <span></span></label>
                            <x-dropdown :data-category="'ps_no'" />
                        </div>
                        <div class="form-group">
                            <label for="incubator">Incubator No: <span></span></label>
                            <x-dropdown :data-category="'incubator_no'" />
                        </div>
                        <div class="form-group">
                            <label for="setting_date">Setting Date: <span></span></label>
                            <input type="date" name="setting_date" id="setting_date" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="form-group">
                            <label for="hatch_date">Hatch Date: <span></span></label>
                            <input type="date" name="hatch_date" id="hatch_date" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="form-group">
                            <label for="temp_check_date_from">Temperature Check Date (From): <span></span></label>
                            <input type="date" name="temp_check_date_from" id="temp_check_date_from" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="form-group">
                            <label for="temp_check_date_to">Temperature Check Date (To): <span></span></label>
                            <input type="date" name="temp_check_date_to" id="temp_check_date_to" value="{{ date('Y-m-d') }}">
                        </div>      
                    </div>

                    <div class="form-container">
                        <table>
                            <thead>
                                <th>Location</th>
                                <th><i class="fa-solid fa-arrow-up arrowup"></i> Temperature 100.5 °F</th>
                                <th><i class="fa-solid fa-arrow-down arrowdown"></i> Temperature 100.4 °F QTY</th>
                                <th>Total</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>LEFT</td>
                                    <td>1000 (56%)</td>
                                    <td>800 (44%)</td>
                                    <td>1800 (100%)</td>
                                </tr>
                                <tr>
                                    <td>RIGHT</td>
                                    <td>1000 (31%)</td>
                                    <td>2200 (69%)</td>
                                    <td>3200 (100%)</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>2000 (40%)</td>
                                    <td>3000 (60%)</td>
                                    <td>5000 (100%)</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="form-container col-2">
                        <div class="form-group">
                            <label for="prepared-by">Prepared By:</label>

                            <!-- Signature Image (Fixed Size) -->
                            <img class="signature" src="/Images/DummySignature.png" alt="Signature">

                            <!-- Prepared By Input Field -->
                            <input type="text" id="prepared-by" value="Chris P. Bacon" readonly>
                        </div>

                        <div class="form-group">
                            <label for="date-prepared">Date Prepared:</label>
                            <input type="text" id="date-prepared" value="{{ date('d/m/Y') }} {{ date('H:i A') }}" readonly>
                        </div>
                    </div>
                </div>

                <div class="report-footer">
                    Brookside Group of Companies | Brookdale Farms | Poultrypure Farms
                </div>
            </form>
        @elseif ($targetForm == "rejected-hatch" && $targetForm != null)
            <form class="report-content">
                <div class="report-header">
                    <img src="/Images/BDL.png" id="BDL" alt="Brookdale Farms">
                    <img src="/Images/BGC.png" id="BGC" alt="Brookside Group of Companies">
                    <img src="/Images/PFC.png" id="PFC" alt="Poultrypure Farms">
                </div>

                <div class="report-title">REJECTED HATCH REPORT</div>

                <div class="report-form">

                    <div class="form-container col-3">
                        <div class="form-group">
                            <label for="ps_no">PS No: <span></span></label>
                            <x-dropdown :data-category="'ps_no'" />
                        </div>
                        <div class="form-group">
                            <label for="incubator_no">Incubator No: <span></span></label>
                            <x-dropdown :data-category="'incubator_no'" />
                        </div>
                        <div class="form-group">
                            <label for="hatcher_no">Hatcher No: <span></span></label>
                            <x-dropdown :data-category="'hatcher_no'" />
                        </div>
                        <div class="form-group">
                            <label for="production_date">Production Date: <span></span></label>
                            <input type="date" name="production_date" id="production_date" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="form-group">
                            <label for="pullout_date">Pull-out Date: <span></span></label>
                            <input type="date" name="pullout_date" id="pullout_date" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="form-group">
                            <label for="hatch_date">Hatch Date: <span></span></label>
                            <input type="date" name="hatch_date" id="hatch_date" value="{{ date('Y-m-d') }}">
                        </div> 
                        <div class="form-group">
                            <label for="set_eggs_qty">Collection Quantity:</label>
                            <input type="number" id="set_eggs_qty" name="set_eggs_qty" readonly>
                        </div>     
                    </div>

                    <div class="form-container col-5" id="rejected_hatch_table">
                        @foreach(['UNHATCHED', 'PIPS', 'REJECTED HATCH', 'DEAD CHICKS', 'ROTTEN'] as $item)
                            <div class="data-table">
                                <table>
                                    <thead>
                                        <th>{{$item}}</th>
                                        <th>(%)</th>
                                    </thead>
                                    <tbody>
                                        <td>200</td>
                                        <td>15.0</td>
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    </div>

                    <div class="form-container">
                        <table id="result-table">
                            <thead>
                                <th>TOTAL HATCH</th>
                                <th>PERCENTAGE</th>
                            </thead>
                            <tbody>
                                <td>5000</td>
                                <td>18.0</td>
                            </tbody>
                        </table>
                    </div>

                    <div class="form-container col-2">
                        <div class="form-group">
                            <label for="prepared-by">Prepared By:</label>

                            <!-- Signature Image (Fixed Size) -->
                            <img class="signature" src="/Images/DummySignature.png" alt="Signature">

                            <!-- Prepared By Input Field -->
                            <input type="text" id="prepared-by" value="Chris P. Bacon" readonly>
                        </div>

                        <div class="form-group">
                            <label for="date-prepared">Date Prepared:</label>
                            <input type="text" id="date-prepared" value="{{ date('d/m/Y') }} {{ date('H:i A') }}" readonly>
                        </div>
                    </div>

                </div>

                <div class="report-footer">
                    Brookside Group of Companies | Brookdale Farms | Poultrypure Farms
                </div>
            </form>
        @elseif ($targetForm == "rejected-pullets" && $targetForm != null)
            <form class="report-content">
                <div class="report-header">
                    <img src="/Images/BDL.png" id="BDL" alt="Brookdale Farms">
                    <img src="/Images/BGC.png" id="BGC" alt="Brookside Group of Companies">
                    <img src="/Images/PFC.png" id="PFC" alt="Poultrypure Farms">
                </div>

                <div class="report-title">REJECTED PULLETS REPORT</div>

                <div class="report-form">

                    <div class="form-container col-3">
                        <div class="form-group">
                            <label for="ps_no">PS No: <span></span></label>
                            <x-dropdown :data-category="'ps_no'" />
                        </div>
                        <div class="form-group">
                            <label for="incubator_no">Incubator No: <span></span></label>
                            <x-dropdown :data-category="'incubator_no'" />
                        </div>
                        <div class="form-group">
                            <label for="hatcher_no">Hatcher No: <span></span></label>
                            <x-dropdown :data-category="'hatcher_no'" />
                        </div>
                        <div class="form-group">
                            <label for="production_date">Production Date: <span></span></label>
                            <input type="date" name="production_date" id="production_date" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="form-group">
                            <label for="pullout_date">Pull-out Date: <span></span></label>
                            <input type="date" name="pullout_date" id="pullout_date" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="form-group">
                            <label for="hatch_date">Hatch Date: <span></span></label>
                            <input type="date" name="hatch_date" id="hatch_date" value="{{ date('Y-m-d') }}">
                        </div> 
                        <div class="form-group">
                            <label for="qc_date">QC Date: <span></span></label>
                            <input type="date" name="qc_date" id="qc_date" value="{{ date('Y-m-d') }}">
                        </div> 
                        <div class="form-group">
                            <label for="set_eggs_qty">Settable Eggs Quantity:</label>
                            <input type="number" id="set_eggs_qty" name="set_eggs_qty" readonly>
                        </div>     
                    </div>

                    <div class="form-container col-5" id="rejected_hatch_table">
                        @foreach(['ONE EYE CLOSED', 'NO EYES', 'SMALL EYES', 'LARGE EYES', 'UNHEALED NAVEL', 'CROSSED BEAK', 'SMALL CHICK', 'WEAK CHICK', 'BLACK BUTTONS', 'STRING NAVEL', 'BLOATED'] as $item)
                            <div class="data-table">
                                <table>
                                    <thead>
                                        <th>{{$item}}</th>
                                        <th>(%)</th>
                                    </thead>
                                    <tbody>
                                        <td>200</td>
                                        <td>15.0</td>
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    </div>

                    <div class="form-container">
                        <table id="result-table">
                            <thead>
                                <th>TOTAL REJECTED DOP</th>
                                <th>PERCENTAGE</th>
                            </thead>
                            <tbody>
                                <td>5000</td>
                                <td>18.0</td>
                            </tbody>
                        </table>
                    </div>

                    <div class="form-container col-2">
                        <div class="form-group">
                            <label for="prepared-by">Prepared By:</label>

                            <!-- Signature Image (Fixed Size) -->
                            <img class="signature" src="/Images/DummySignature.png" alt="Signature">

                            <!-- Prepared By Input Field -->
                            <input type="text" id="prepared-by" value="Chris P. Bacon" readonly>
                        </div>

                        <div class="form-group">
                            <label for="date-prepared">Date Prepared:</label>
                            <input type="text" id="date-prepared" value="{{ date('d/m/Y') }} {{ date('H:i A') }}" readonly>
                        </div>
                    </div>

                </div>

                <div class="report-footer">
                    Brookside Group of Companies | Brookdale Farms | Poultrypure Farms
                </div>
            </form>
        @elseif ($targetForm == "master-database" && $targetForm == !null)
            <form class="report-content">
                <div class="report-header">
                    <img src="/Images/BDL.png" id="BDL" alt="Brookdale Farms">
                    <img src="/Images/BGC.png" id="BGC" alt="Brookside Group of Companies">
                    <img src="/Images/PFC.png" id="PFC" alt="Poultrypure Farms">
                </div>

                <div class="report-title">MASTER DATABASE REPORT</div>

                <div class="report-form master-database">
                    <div class="form-label">
                        <span>1</span>
                        <p>Collected Eggs</p>
                    </div>
                    <div class="form-container col-4">
                        <div class="form-group">
                            <label for="ps_no">PS no.</label>
                            <input type="text" name="ps_no" id="ps_no" readonly>
                        </div>
                        <div class="form-group">
                            <label for="collected_qty">Collected QTY</label>
                            <input type="number" name="collected_qty" id="collected_qty" placeholder="0" readonly>
                        </div>
                        <div class="form-group">
                            <label for="production_date_from">Production Date (From)</label>
                            <input type="date" name="production_date_from" id="production_date_from" readonly>
                        </div>
                        <div class="form-group">
                            <label for="production_date_to">Production Date (To)</label>
                            <input type="date" name="production_date_to" id="production_date_to" readonly>
                        </div>
                    </div>

                    <div class="form-label">
                        <span>2</span>
                        <p>Storage Pullout Process</p>
                    </div>

                    <div class="form-container col-4">
                        <div class="form-group">
                            <label for="incubator_no">Incubator No. </label>
                            <input type="text" name="incubator_no" id="incubator_no" placeholder="0" readonly>
                        </div>

                        <div class="form-group">
                            <label for="settable_eggs_qty">Set. Egg QTY </label>
                            <input type="text" name="settable_eggs_qty" id="settable_eggs_qty" placeholder="0" readonly>
                        </div>

                        <div class="form-group">
                            <label for="pullout_date">Pullout Date </label>
                            <input type="date" name="pullout_date" id="pullout_date" readonly>
                        </div>
                    </div>
                    <div class="form-container col-4">
                        <div class="input-container">
                            <div class="form-group">
                                <label for="prime_qty">Prime QTY </label>
                                <input type="number" name="prime_qty" id="prime_qty" placeholder="0" readonly>
                            </div>   
                            <div class="form-group prcnt">
                                <label for="prime_prcnt">%</label>
                                <input type="text" name="prime_prcnt" id="prime_prcnt" placeholder="0" readonly>
                            </div>                     
                        </div>

                        <div class="input-container">
                            <div class="form-group">
                                <label for="jp_qty">JP QTY </label>
                                <input type="number" name="jp_qty" id="jp_qty" placeholder="0" readonly>
                            </div>   
                            <div class="form-group prcnt">
                                <label for="jp_prcnt">% </label>
                                <input type="text" name="jp_prcnt" id="jp_prcnt" placeholder="0" readonly>
                            </div>                     
                        </div>
                    </div>

                    <div class="form-label">
                        <span>3</span>
                        <p>10th Day Candling Process</p>
                    </div>

                    <div class="form-container col-4">
                        <div class="form-group">
                            <label for="d10_breakout_qty">Day 10 Breakout QTY </label>
                            <input type="number" name="d10_breakout_qty" id="d10_breakout_qty" placeholder="0" readonly>
                        </div>                 
                        <div class="form-group">
                            <label for="d10_candling_date">Day 10 Candling Date </label>
                            <input type="date" name="d10_candling_date" id="d10_candling_date" readonly>
                        </div>

                        <!-- <p></p>
                        <br> -->

                        <div class="input-container">
                            <div class="form-group">
                                <label for="d10_candling_qty">Day 10 Candling QTY </label>
                                <input type="number" name="d10_candling_qty" id="d10_candling_qty" placeholder="0" readonly>
                            </div>   
                            <div class="form-group prcnt">
                                <label for="d10_breakout_prcnt">%</label>
                                <input type="text" name="d10_breakout_prcnt" id="d10_breakout_prcnt" placeholder="0" readonly>
                            </div>                     
                        </div>

                        <div class="form-group">
                            <label for="d10_inc_qty">Day 10  Inc QTY</label>
                            <input type="text" name="d10_inc_qty" id="d10_inc_qty" placeholder="0" readonly>
                        </div>
                    </div>

                    <div class="form-label">
                        <span>4</span>
                        <p>18th Day Candling Process</p>
                    </div>

                    <div class="form-container col-4">
                        <div class="form-group">
                            <label for="infertiles_qty">Infertiles Quantity</label>
                            <input type="number" name="infertiles_qty" id="infertiles_qty" placeholder="0" readonly>
                        </div> 
                        <div class="form-group">
                            <label for="embryonic_eggs_qty">Embryonic Eggs Quantity</label>
                            <input type="text" name="embryonic_eggs_qty" id="embryonic_eggs_qty" placeholder="0" readonly>
                        </div>                    
                        <div class="form-group">
                            <label for="d18_candling_date">Day 18.5 Candling Date</label>
                            <input type="date" name="d18_candling_date" id="d18_candling_date" readonly>
                        </div>
                    </div>

                    <div class="form-label">
                        <span>5</span>
                        <p>Hatcher Pullout Process</p>
                    </div>

                    <div class="form-container col-4">
                        <div class="form-group">
                            <label for="hatcher_no">Hatcher No</label>
                            <input type="text" id="hatcher_no" name="hatcher_no" placeholder="0" readonly>
                        </div>
                        <div class="form-group">
                            <label for="rejected_hatch_qty">Rejected Hatch Qty</label>
                            <input type="number" name="rejected_hatch_qty" id="rejected_hatch_qty" placeholder="0" readonly>
                        </div>
                        <div class="form-group">
                            <label for="accepted_hatch_qty">Good Hatch Qty</label>
                            <input type="text" name="accepted_hatch_qty" id="accepted_hatch_qty" placeholder="0" readonly>
                        </div>
                        <div class="form-group">
                            <label for="hatcher_date">Hatcher Date</label>
                            <input type="date" name="hatcher_date" id="hatcher_date" readonly>
                        </div>
                    </div>

                    <div class="form-label">
                        <span>6</span>
                        <p>Sexing</p>
                    </div>

                    <div class="form-container col-4">
                        <div class="form-group">
                            <label for="cock_qty">Cockerels Quantity</label>
                            <input type="number" name="cock_qty" id="cock_qty" placeholder="0" readonly>
                        </div>
                        <div class="form-group">
                            <label for="dop_qty">DOP Quantity</label>
                            <input type="text" name="dop_qty" id="dop_qty" placeholder="0" readonly>
                        </div>
                    </div>

                    <div class="form-label">
                        <span>7</span>
                        <p>QC/QA Process Entry</p>
                    </div>

                    <div class="form-container col-4">
                        <div class="form-group">
                            <label for="rejected_dop_qty">Rejected DOP Qty</label>
                            <input type="number" name="rejected_dop_qty" id="rejected_dop_qty" placeholder="0" readonly>
                        </div>
                        
                        <div class="form-group">
                            <label for="accepted_dop_qty">Good DOP Qty</label>
                            <input type="text" name="accepted_dop_qty" id="accepted_dop_qty" placeholder="0" readonly>
                        </div>
                        <div class="form-group">
                            <label for="qc_date">QC Date</label>
                            <input type="date" name="qc_date" id="qc_date" readonly>
                        </div>
                    </div>

                    <div class="form-label">
                        <span>8</span>
                        <p>Dispath Process Entry</p>
                    </div>

                    <div class="form-container col-4">
                        <div class="form-group">
                            <label for="dispatch_prime_qty">Prime Qty</label>
                            <input type="number" name="dispatch_prime_qty" id="dispatch_prime_qty" placeholder="0" readonly>
                        </div>
                        <div class="form-group">
                            <label for="dispatch_jr_prime_qty">Jr Prime Qty</label>
                            <input type="number" name="dispatch_jr_prime_qty" id="dispatch_jr_prime_qty" placeholder="0" readonly>
                        </div>
                        <div class="form-group">
                            <label for="total_boxes">Total Boxes</label>
                            <input type="number" name="total_boxes" id="total_boxes" placeholder="0" readonly>
                        </div>
                    </div>

                    <div class="form-label">
                        <span><i class="fa-solid fa-clipboard-list"></i></span>
                        <p>Forcasted Base on Last Hatch</p>
                    </div>

                    <div class="form-container col-4">
                        <div class="input-container">
                            <div class="form-group">
                                <label for="infertile_qty">Infertile Qty</label>
                                <input type="number" name="infertile_qty" id="infertile_qty" placeholder="0" readonly>
                            </div>
                            
                            <div class="form-group prcnt">
                                <label for="infertile_prcnt">% <span></span></label>
                                <input type="number" name="infertile_prcnt" id="infertile_prcnt" placeholder="0" readonly>
                            </div>
                        </div>
                        <div class="input-container">
                            <div class="form-group">
                                <label for="frcst_cock_qty">Cock Qty</label>
                                <input type="number" name="frcst_cock_qty" id="frcst_cock_qty" placeholder="0" readonly>
                            </div>
                            
                            <div class="form-group prcnt">
                                <label for="frcst_cock_prcnt">% <span></span></label>
                                <input type="number" name="frcst_cock_prcnt" id="frcst_cock_prcnt" placeholder="0" readonly>
                            </div>
                        </div>
                        <div class="input-container">
                            <div class="form-group">
                                <label for="frcst_rejected_hatch_qty">Rejected Hatch Qty</label>
                                <input type="number" name="frcst_rejected_hatch_qty" id="frcst_rejected_hatch_qty" placeholder="0" readonly>
                            </div>
                            
                            <div class="form-group prcnt">
                                <label for="frcst_rejected_hatch_prcnt">% <span></span></label>
                                <input type="number" name="frcst_rejected_hatch_prcnt" id="frcst_rejected_hatch_prcnt" placeholder="0" readonly>
                            </div>
                        </div>
                        <div class="input-container">
                            <div class="form-group">
                                <label for="frcst_rejected_dop_qty">Rejected DOP Qty</label>
                                <input type="number" name="frcst_rejected_dop_qty" id="frcst_rejected_dop_qty" placeholder="0" readonly>
                            </div>
                            
                            <div class="form-group prcnt">
                                <label for="frcst_rejected_dop_prcnt">% <span></span></label>
                                <input type="number" name="frcst_rejected_dop_prcnt" id="frcst_rejected_dop_prcnt" placeholder="0" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="forecast_total_qty">Total Qty</label>
                            <input type="number" name="forecast_total_qty" id="forecast_total_qty" placeholder="0" readonly>
                        </div>
                    </div>

                    <div class="form-label">
                        <span><i class="fa-solid fa-box"></i></span>
                        <p>Forcasted number of boxes</p>
                    </div>

                    <div class="form-container col-4">
                        <div class="form-group">
                            <label for="frcst_total_boxes">Total</label>
                            <input type="text" name="frcst_total_boxes" id="frcst_total_boxes" placeholder="0" readonly>
                        </div>
                        <div class="form-group">
                            <label for="frcst_settable_eggs_prcnt">%</label>
                            <input type="text" name="frcst_settable_eggs_prcnt" id="frcst_settable_eggs_prcnt" placeholder="0" readonly>
                        </div>
                        <div class="form-group">
                            <label for="frcst_prime">Prime</label>
                            <input type="text" name="frcst_prime" id="frcst_prime" placeholder="0" readonly>
                        </div>
                        <div class="form-group">
                            <label for="frcst_jr_prime">Junior Prime</label>
                            <input type="text" name="frcst_jr_prime" id="frcst_jr_prime" placeholder="0" readonly>
                        </div>
                    </div>


                    <div class="form-container col-2" style="margin-top: 50px;">
                        <div class="form-group">
                            <label for="prepared-by">Prepared By:</label>

                            <!-- Signature Image (Fixed Size) -->
                            <img class="signature" src="/Images/DummySignature.png" alt="Signature">

                            <!-- Prepared By Input Field -->
                            <input type="text" id="prepared-by" value="Chris P. Bacon" readonly>
                        </div>

                        <div class="form-group">
                            <label for="date-prepared">Date Prepared:</label>
                            <input type="text" id="date-prepared" value="{{ date('d/m/Y') }} {{ date('H:i A') }}" readonly>
                        </div>
                    </div>
                    
                </div>

                <div class="report-footer">
                    Brookside Group of Companies | Brookdale Farms | Poultrypure Farms
                </div>
            </form>
        @endif
        <div class="report-actions">
            <button type="button" class="back" onclick="window.history.back()">GO BACK <i class="fa-solid fa-door-open"></i></button>
            <button type="submit" class="print" onclick="window.print()">PRINT <i class="fa-solid fa-print"></i></button>
        </div>
    </div>
    
    <script>

        let targetform = document.getElementById('targetForm').value;

        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        if(targetform == 'egg-collection'){
            // Function to fetch egg collection result
            function getEggCollectionResult() {
                const ps_no = document.getElementById("ps_no").value;
                const production_date_from = document.getElementById("production_date_from").value;
                const production_date_to = document.getElementById("production_date_to").value;
                let selectedValues = [];

                // Get the select element for 'house_no'
                var select = document.getElementById('house_no');
                
                // Get all selected options
                var selectedOptions = Array.from(select.selectedOptions);
                
                // Extract the values from the selected options
                house_no = selectedOptions.map(option => option.value);

                // Check if all required fields are filled
                if (ps_no && production_date_from && production_date_to && house_no.length > 0) {
                    // Proceed with the fetch request only if all required fields are provided
                    fetch("/egg-collection/report/result", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": csrfToken  // Ensure you send the CSRF token if needed
                        },
                        body: JSON.stringify({
                            ps_no: ps_no,
                            production_date_from: production_date_from,
                            production_date_to: production_date_to,
                            house_no: house_no
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Assuming the result is returned as 'egg_quantity_result'
                            console.log(data.egg_quantity_result);
                            console.log(data.egg_quantity_breakdown);
                            
                            // Optionally you can also update the UI with the result
                            document.getElementById("collected_qty").value = data.egg_quantity_result;
                            document.getElementById("collection_time").value = data.collection_time;

                            const ps_no = document.getElementById("ps_no").value;
                            populateEggCollectionTable(
                                ps_no,
                                data.egg_quantity_result,
                                data.egg_quantity_breakdown,
                                data.grand_total // Optional: pass if available
                            );
                        } else {
                            alert("Error fetching egg collection result");
                        }
                    })
                    .catch(error => console.error("Error:", error));
                } else {
                    // Optionally, show a message if the required fields are not filled
                    console.log("Please fill in all required fields");
                }
            }

            // Attach event listeners to the fields
            let requiredFields = document.querySelectorAll("#ps_no, #production_date_from, #production_date_to, #house_no");

            requiredFields.forEach(field => {
                // Trigger getEggCollectionResult only when all fields are filled
                field.addEventListener("input", () => {
                    const ps_no = document.getElementById("ps_no").value;
                    const production_date_from = document.getElementById("production_date_from").value;
                    const production_date_to = document.getElementById("production_date_to").value;
                    const house_no = document.getElementById("house_no").value;  // Check if house_no has values

                    // Check if all required fields are filled before calling getEggCollectionResult
                    if (ps_no && production_date_from && production_date_to && house_no) {
                        getEggCollectionResult(); // Call the function only when all fields are filled
                    }
                });
            });

            // Additional handling for 'ps_no' to dynamically populate 'house_no' (if needed)
            document.getElementById("ps_no").addEventListener("change", () => {
                const ps_no = document.getElementById("ps_no").value;
                
                // Fetch available houses based on selected ps_no (if needed)
                // This could involve a fetch request to get houses corresponding to the selected ps_no.
                
                // Example of fetching house data:
                    fetch("/egg-collection/report/result", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": csrfToken  
                        },
                        body: JSON.stringify({
                            ps_no: ps_no
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        
                        console.log(data);

                        const houseSelect = document.getElementById("house_no");

                        // Clear existing options
                        houseSelect.innerHTML = "";

                        // Populate new options
                        data.house_no.forEach(house => {
                            let option = document.createElement("option");
                            option.value = house;
                            option.textContent = `House ${house}`;
                            houseSelect.appendChild(option);
                        });

                        // Refresh multiselect
                        houseSelect.loadOptions();

                    })
                    .catch(error => console.error("Error fetching house data:", error));
            });

            function populateEggCollectionTable(ps_no, egg_quantity_result, egg_quantity_breakdown, grand_total) {
                const table = document.getElementById("egg-collection-table");
                const thead = table.querySelector("thead");
                const tbody = table.querySelector("tbody");

                // Clear old rows
                thead.innerHTML = '';
                tbody.innerHTML = '';

                // Dynamically create table headers
                const headRow = document.createElement("tr");
                
                const psHeader = document.createElement("th");
                psHeader.textContent = "PS No.";
                headRow.appendChild(psHeader);

                const houseNumbers = Object.keys(egg_quantity_breakdown);
                houseNumbers.forEach(house => {
                    const th = document.createElement("th");
                    th.textContent = `HS No. ${house}`;
                    headRow.appendChild(th);
                });

                const totalHeader = document.createElement("th");
                totalHeader.textContent = "Total:";
                headRow.appendChild(totalHeader);

                thead.appendChild(headRow);

                // Create row for egg quantities
                const dataRow = document.createElement("tr");

                const psCell = document.createElement("td");
                psCell.textContent = ps_no;
                dataRow.appendChild(psCell);

                houseNumbers.forEach(house => {
                    const td = document.createElement("td");
                    td.textContent = egg_quantity_breakdown[house];
                    dataRow.appendChild(td);
                });

                const totalCell = document.createElement("td");
                totalCell.textContent = egg_quantity_result;
                dataRow.appendChild(totalCell);

                tbody.appendChild(dataRow);

                // Create row for Grand Total
                const grandTotalRow = document.createElement("tr");

                const colspanCell = document.createElement("td");
                colspanCell.setAttribute("colspan", houseNumbers.length + 1);
                colspanCell.textContent = "Grand Total:";
                grandTotalRow.appendChild(colspanCell);

                const grandTotalValue = document.createElement("td");
                grandTotalValue.textContent = grand_total ?? egg_quantity_result; // fallback to current total
                grandTotalRow.appendChild(grandTotalValue);

                tbody.appendChild(grandTotalRow);
            }

        }


        
    </script>

    <script src="{{asset('js/multiselect-dropdown.js')}}" defer></script>
    
</body>
</html>