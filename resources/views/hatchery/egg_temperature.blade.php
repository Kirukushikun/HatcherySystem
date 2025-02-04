<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Egg Temperature Check Entry</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="/Images/BGC icon.ico">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/modal-notification-styles.css">

    <style>
        .loading-screen{
            display: none;
            width: 100%;
            height: 50vh;
            background-color: white;
            z-index: 9999;
        }
        
        .loading-screen.active{
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .loading{
            display: none;
            width: 100%;
            height: 100%;
            padding: 200px 0;
        }.loading.active{
            display: flex;
            align-items: center;
            justify-content: center;
        }


        .loader {
            width: 44px;
            height: 44px;
            border: 5px solid rgb(255, 222, 184); /* #7b5cad color with 0.5 opacity */
            border-top: 5px solid #EC8B18; /* Transparent part of the loader */
            border-radius: 50%;
            animation: spin 0.8s linear infinite; /* 1s for animation duration, loops infinitely */
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>

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

    <form class="body" action="{{ route('egg.temperature.store') }}" method="POST">
        @csrf

        <div class="form-header">
            <h4>Entry Form</h4>
        </div>

        <div class="form-input col-4">

            <div class="input-container column">
                <label for="ps_no">PS no. <span></span></label>
                <select name="ps_no" id="ps_no">
                    <option value="{{ session('form_data.ps_no', '') }}" selected>
                        {{ session('form_data.ps_no', '') }}
                    </option>
                    <option value="#93">#93</option>
                    <option value="#94">#94</option>
                </select>
            </div>
            <div class="input-container column">
                <label for="setting_date">Setting Date <span></span></label>
                <input type="date" name="setting_date" id="setting_date" value="{{ session('form_data.setting_date', '') }}">
            </div>
            <div class="input-container column">
                <label for="incubator_no">Incubator # <span></span></label>
                <select name="incubator_no" id="incubator_no">
                    <option value=""></option>
                    <option value="5" {{ session('form_data.incubator_no', '') == '5' ? 'selected' : ''}}>5</option>
                </select>
            </div>
            <div class="input-container column">
                <label for="location">Location <span></span></label>
                <select name="location" id="location">
                    <option value="{{ session('form_data.location', '') }}" selected hidden>
                        {{ session('form_data.location', '-- Select Location --') }}
                    </option>
                    <option value="Top">Top</option>
                    <option value="Mid">Mid</option>
                    <option value="Low">Low</option>
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
                <input name="quantity" id="quantity" type="text" value="{{ session('form_data.quantity', '') }}">
            </div>
        </div>

        <div class="form-action">
            <button class="save-btn" type="submit">Save</button>
            <button class="reset-btn" type="button">Reset</button>
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

            <div class="loading-screen">
                <div class="loader"></div>
            </div> 

            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>PS no.</th>
                        <th>Setting Date</th>
                        <th>Incubator #</th>
                        <th>Location</th>
                        <th>Temp Check Date</th>
                        <th>Quantity</th>
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
                        <td>TOP</td>
                        <td>37.7 Below</td>
                        <td>128</td>
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
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.querySelector(".body"); // Main form container
            const inputs = form.querySelectorAll("input, select"); // All form fields

            const formAction = form.querySelector(".form-action"); // Form action buttons
            const resetButton = form.querySelector(".reset-btn"); // Reset button

            // Function to check if any input has a value
            function checkFormValues() {
                let hasValue = false;

                inputs.forEach(input => {
                    if (input.value.trim() !== "") {
                        hasValue = true;
                    }
                });

                // Show or hide the form-action buttons
                formAction.style.display = hasValue ? "flex" : "none";
            }

            // Event listeners for inputs and selects
            inputs.forEach(input => {
                input.addEventListener("input", checkFormValues);
                input.addEventListener("change", checkFormValues); // For select and date/time inputs
            });

            // Reset button functionality
            resetButton.addEventListener("click", function () {
                inputs.forEach(input => {
                    input.value = ""; // Clear input fields
                });

                checkFormValues(); // Recheck values to hide form-action
            });

            // Initial check to hide the form-action if empty
            // checkFormValues();


            // document.querySelector("form").addEventListener("submit", function (event) {
            //     event.preventDefault(); // Prevent form submission initially
            //     let isValid = true;

            //     const requiredFields = ["ps_no", "setting_date", "incubator_no", "location", "temp_check_date", "temperature", "quantity"];
                
            //     requiredFields.forEach(id => {
            //         let field = document.getElementById(id);
            //         let labelSpan = field.closest(".input-container").querySelector("label span");
                    
            //         if (!field.value.trim()) {
            //             field.style.border = "2px solid #ea4435d7";
            //             // field.style.marginTop = "5px";
            //             labelSpan.textContent = "(This field is required)";
            //             labelSpan.style.color = "#ea4435d7";
            //             isValid = false;
            //         }else{
            //             field.style.border = "";
            //             labelSpan.textContent = "";
            //         }
            //     });

            //     if (isValid) {
            //         showModal(); // Show modal when all fields are filled
            //     }
                
            // });

            function showModal() {
                const modal = document.getElementById("modal");
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
                            <button class="confirm-button save-btn">Save</button>
                            <button class="cancel-button">Cancel</button>
                        </div>
                    </div>
                `;

                const closeButton = document.getElementById("close-button");
                const confirmButton = document.querySelector(".confirm-button");
                const cancelButton = document.querySelector(".cancel-button");

                closeButton.addEventListener("click", function () {
                    modal.classList.remove("active");
                });

                confirmButton.addEventListener("click", function () {
                    modal.classList.remove("active");
                    form.submit(); // Submit the form when "Delete" is clicked
                });

                cancelButton.addEventListener("click", function () {
                    modal.classList.remove("active");
                });
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Get the close icon element
            const closeNotification = document.getElementById('close-notification');
            // Get the push notification element (assuming it has a class 'push-notification')
            const pushNotification = document.querySelector('.push-notification');

            if (closeNotification) {
                // Add a click event listener to the close icon
                closeNotification.addEventListener('click', function() {
                    // Remove the 'active' class to hide the notification
                    if (pushNotification) {
                        pushNotification.classList.remove('active');
                    }
                });
            }

            if (pushNotification) {
                // Show the push notification by adding the 'active' class
                setTimeout(() => {
                    pushNotification.classList.add('active');
                }, 500);

                // Automatically hide the notification after 5 seconds
                setTimeout(() => {
                    pushNotification.classList.remove('active');
                }, 5500);
            }
        });
    </script>
    
</body>
</html>