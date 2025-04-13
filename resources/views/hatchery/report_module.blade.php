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

                    <div class="form-container">
                        <table id="egg-collection-table">
                            <thead>
                            </thead>
                            <tbody>
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