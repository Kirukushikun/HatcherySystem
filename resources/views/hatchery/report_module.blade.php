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

    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }

        /* Firefox */
        input[type=number] {
        -moz-appearance: textfield;
        }

        *{
            font-family: "Lexend";
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            color: #1C1C1C;

            transition: 0.3s ease;
        }

        body{
            min-height: 100vh;
            padding-top: 20px;
            height: auto;
            
            display: flex;
            align-items: center;
            justify-content: center;

            background-color: #F6F4F1;
        }

        .report-container{
            min-width: 1300px;

            display: flex;
            flex-direction: column;
            justify-content: center;

            position: relative;
        }

        .report-content{
            background-color: white;
        }

        .report-header{
            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 40px;
        }
        .report-header img{
            width: 160px;
        }
        .report-header #BGC{
            width: 180px;
        }

        .report-title{
            font-size: 25px;
            font-weight: 5  00;
            text-align: center;

            padding: 10px 0;

            background-color: #EC8B18;
            color: white;
        }

        .report-form{
            display: flex;
            flex-direction: column;
            /* justify-content: space-between; */
            gap:60px;

            padding: 50px;
        }

        .report-form .col-2{
            display:grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;            
        }

        .report-form .col-3{
            display:grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 30px;            
        }

        .report-form .col-5{
            display:grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 25px;            
        }



        .report-form .form-group{
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .form-group input{
            border: none;
            font-size: 16px;
            padding: 12px 15px;
            background-color: #F3F3F3;
            outline: none;
        }
        .form-group select{
            border: none;
            font-size: 16px;
            padding: 12px 15px;
            background-color: #F3F3F3;
            outline: none;

            border-right: 16px solid transparent
        }

        .report-footer{
            display: flex;
            flex-direction: column;
            margin: 0 50px 30px;
            padding: 20px 0;
            border-top: solid 2px #F0F0F0;
            text-align: center;
            font-weight: 500;
            color: #D8D8D8;
        }

        /* .report-actions{
            position: absolute;
            right: -170px;
            bottom: -20px;

            display:flex;
            flex-direction: column;
            justify-content: end;
            gap: 20px;
            margin: 20px 0;
        } */

        .report-actions{
            display:flex;
            justify-content: end;
            gap: 20px;
            margin: 20px 0;
        }

        .report-actions button{
            padding: 8px 20px;
            cursor: pointer;
            border: none;

            font-size: 16px;
            font-weight: 400;
        }

        .back{
            color: #4C4C4C;
            background-color: #D9D9D9;
        }
        .back i{
            color: #4C4C4C;
            margin-left: 5px;
        }

        .print{
            color: white;
            background-color: #EC8B18;
        }
        .print i{
            color: white;
            margin-left: 5px;
        }

        .form-container table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }


        th {
            background-color: #EC8B18; /* Orange header */
            color: white;
            
            padding: 10px;
            font-size: 16px;
            font-weight: 500;

            border: 2px solid #ffffff;
        }

        td {
            padding: 10px;
            border: 2px solid #E9E9E9;
        }

        /* tr:nth-child(even) {
            background-color: #f9f9f9; 
        } */

        tr:hover {
            background-color: #f1f1f1; /* Hover effect */
        }

        .signature {
            display: block; 
            width: 110px;   
            height: 80px;   
            object-fit: contain; 
            margin-bottom: 5px; 
        }

        #prepared-by, #date-prepared{
            background-color: transparent;
            padding: 0 ;
        }

        /* .signature {
            display: block; 
            width: 110px;   
            height: 80px;   
            object-fit: contain; 
            margin-bottom: 5px; 
            z-index: 2px;
        }

        .form-group{
            position: relative;
        }

        #prepared-by{
            bottom: 10px;
            position: absolute;
            z-index: 1;

            background-color: transparent;
        } */

        #result-table th{  
            background-color: #ECB316;
        }

        #result-table th:first-child, #result-table td:first-child {
            width: 70%; /* First column takes 70% of the table width */
        }

        #result-table th:last-child, #result-table td:last-child {
            width: 30%; /* Second column takes 30% of the table width */
        }

        .data-table th{
            white-space: nowrap;
        }

        .data-table th:first-child, .data-table td:first-child {
            min-width: 70%; /* First column takes 70% of the table width */
        }

        .data-table th:last-child, .data-table td:last-child {
            width: 30%; /* Second column takes 30% of the table width */
        }

    </style>
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
                        <div class="form-group">
                            <label for="house_no">House No:</label>
                            <!-- <x-dropdown :data-category="'house_no'" /> -->
                            <select name="house_no" id="house_no" multiple multiselect-select-all="true" multiselect-search="true" >
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="production_date_from">Production Date (From):</label>
                            <input type="date" id="production_date_from">
                        </div>
                        <div class="form-group">
                            <label for="production_date_to">Production Date (To):</label>
                            <input type="date" id="production_date_to">
                        </div>
                        <div class="form-group">
                            <label for="collection_time">Collection Time:</label>
                            <input type="time" id="collection_time">
                        </div>
                        <div class="form-group">
                            <label for="collected_qty">Collection Quantity:</label>
                            <input type="number" id="collected_qty" readonly>
                        </div>         
                    </div>

                    <!-- <div class="form-container">
                        <table>
                            <thead>
                                <th>PS No.</th>
                                <th>House No. 1</th>
                                <th>House No. 2</th>
                                <th>House No. 3</th>
                                <th>House No. 4</th>
                                <th>House No. 5</th>
                                <th>Total:</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>93</td>
                                    <td>200</td>
                                    <td>200</td>
                                    <td>200</td>
                                    <td>200</td>
                                    <td>200</td>
                                    <td>1000</td>
                                </tr>
                                <tr>
                                    <td>95</td>
                                    <td>200</td>
                                    <td>200</td>
                                    <td>200</td>
                                    <td>200</td>
                                    <td>200</td>
                                    <td>1000</td>
                                </tr>
                                <tr>
                                    <td>98</td>
                                    <td>200</td>
                                    <td>200</td>
                                    <td>200</td>
                                    <td>200</td>
                                    <td>200</td>
                                    <td>1000</td>
                                </tr>
                                <tr>
                                    <td colspan="6">Grand Total:</td>
                                    <td>10000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div> -->

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
                                <th>LOCATION</th>
                                <th>37.8 ABOVE</th>
                                <th>37.7 BELOW</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Top</td>
                                    <td>200</td>
                                    <td>200</td>
                                </tr>
                                <tr>
                                    <td>Middle</td>
                                    <td>200</td>
                                    <td>200</td>
                                </tr>
                                <tr>
                                    <td>Bottom</td>
                                    <td>200</td>
                                    <td>200</td>
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
        @endif
        <div class="report-actions">
            <button type="button" class="back" onclick="window.history.back()">GO BACK <i class="fa-solid fa-door-open"></i></button>
            <button type="submit" class="print" onclick="getSelectedValues()">PRINT <i class="fa-solid fa-print"></i></button>
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
                selectedValues = selectedOptions.map(option => option.value);

                // Check if all required fields are filled
                if (ps_no && production_date_from && production_date_to && selectedValues.length > 0) {
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
                            selectedValues: selectedValues
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Assuming the result is returned as 'egg_quantity_result'
                            console.log(data.egg_quantity_result);
                            
                            // Optionally you can also update the UI with the result
                            document.getElementById("collected_qty").value = data.egg_quantity_result;
                            document.getElementById("collection_time").value = data.collection_time;
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
        }


        
    </script>

    <script src="{{asset('js/multiselect-dropdown.js')}}" defer></script>
    
</body>
</html>