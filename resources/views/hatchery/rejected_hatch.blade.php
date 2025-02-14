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
                        <th>Production Date</th>
                        <th>Incubator #</th>
                        <th>Hatcher #</th>
                        <th>Pullout Date</th>
                        <th>Hatch Date</th>
                        <th>Set Egg QTY</th>
                        <th>Unhatched</th>
                        <th>Unhatched %</th>
                        <th>Pips</th>
                        <th>Pips %</th>
                        <th>Rejected Chicks</th>
                        <th>Rejected Chicks %</th>
                        <th>Dead Chicks</th>
                        <th>Dead Chicks %</th>
                        <th>Rotten</th>
                        <th>Rotten %</th>
                        <th>Total</th>
                        <th>Total Rejects %</th>
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
                        <td>1</td>
                        <td>1</td>
                        <td>09/12/25</td>
                        <td>09/12/25</td>
                        <td>30240</td>
                        <td>4005</td>
                        <td>13.2</td>
                        <td>948</td>
                        <td>3.1</td>
                        <td>79</td>
                        <td>0.3</td>
                        <td>10</td>
                        <td>0.0</td>
                        <td>35</td>
                        <td>0.1</td>
                        <td>5077</td>
                        <td>16.8</td>
                        <td>IT Head</td>
                        <td>09/12/25</td>
                        <td>New Input</td>
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

    <script src="{{asset('js/rejected-hatch.js')}}" defer></script>
    <script>
        // document.addEventListener("DOMContentLoaded", function () {
        //     const form = document.querySelector(".body"); // Main form container
        //     const inputs = form.querySelectorAll("input, select"); // All form fields
        //     const formAction = form.querySelector(".form-action"); // Form action buttons
        //     const resetButton = form.querySelector(".reset-btn"); // Reset button

        //     // Function to check if any input has a value
        //     function checkFormValues() {
        //         let hasValue = false;

        //         inputs.forEach(input => {
        //             if (input.value.trim() !== "") {
        //                 hasValue = true;
        //             }
        //         });

        //         // Show or hide the form-action buttons
        //         formAction.style.display = hasValue ? "flex" : "none";
        //     }

        //     // Event listeners for inputs and selects
        //     inputs.forEach(input => {
        //         input.addEventListener("input", checkFormValues);
        //         input.addEventListener("change", checkFormValues); // For select and date/time inputs
        //     });

        //     // Reset button functionality
        //     resetButton.addEventListener("click", function () {
        //         inputs.forEach(input => {
        //             input.value = ""; // Clear input fields
        //         });

        //         checkFormValues(); // Recheck values to hide form-action
        //     });

        // });
    </script>
</body>
</html>