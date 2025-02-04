<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Egg Collection Entry</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="/Images/BGC icon.ico">
    <link rel="stylesheet" href="/Css/styles.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            color: #1C1C1C;
            font-family: "Poppins", serif;
        }
        .modal{
            display: none;
        }
        .modal.active {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: fixed;
            z-index:100;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            background-color: rgba(0, 0, 0, 0.4);
        }
        .modal.active body{
            overflow: hidden;
        }
        .modal-content{
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            border-radius: 10px;
            background-color: white;
            padding: 40px 40px;
            gap: 20px;
            /* width: 80%;
            max-width: 600px; */
        }
        .modal-footer{
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 100%;
        }
        .modal-footer button{
            padding: 8px 20px;
            border-radius: 7px;
            cursor: pointer;
            font-weight: 600;
            font-size: 16px;
        }
        #close-button{  
            position: absolute;
            right: 30px;
            top: 30px;
            cursor: pointer;
            font-size: 23px;
        }
        .modal-header{
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }
        .modal-header i{
            font-size: 30px;
            padding: 15px;
            border-radius: 10px;
        }.modal-header h2{
            font-size: 30px;
            letter-spacing: 1px;
        }.modal-header h4{
            font-size: 17px;
            font-weight: 500;
            color: #868686;
        }
        .danger{
            color: #EA4335;
            background-color: rgb(255, 230, 230);
        }
        .success{
            color: #34A853;
            background-color: #e6ffe6;
        }
        .cancel-button{
            background-color: rgb(238, 233, 225);
            border: 2px solid #c5c5c5;
        }
        .delete-btn{
            color: white;
            border: solid 2px #EA4335;
            background-color: #EA4335;
        }
        .save-btn{
            color: white;
            border: solid 2px #34A853;
            background-color: #34A853;
        }
        .push-notification {
            display: flex;
            align-items: flex-start;
            position: fixed;
            top: -170px; /* Start off-screen */
            right: 20px;
            border: solid 2px #43ac5fb0;
            padding: 25px;
            color: #fff;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 9999;
            color: var(--text-color);
            opacity: 0; /* Start hidden */
            transition: top 0.5s ease, opacity 0.5s ease; /* Animate both top and opacity */
            gap: 20px;
        }
        .push-notification.active {
            top: 20px; /* Slide to visible position */
            opacity: 1; /* Make it visible */
        }
        .push-notification.success{
            background-color: #e8ffee;
            border: solid 2px #43ac5fb0;
        }.push-notification.danger{
            background-color: #ffe8e8;
            border: solid 2px #df6060;
        }
        .notification-message{
            font-size: 17px;
            user-select: none;
        }
        .push-notification p{
            margin-top: 5px;
            font-size: 16px;
            width: 280px;
        }
        .push-notification .fa-bell.success{
            background-color: #34A853;
            padding: 11px 12px;
            border-radius: 8px;
            color: white;
        }.push-notification .fa-bell.danger{
            background-color: #EB4335;
            padding: 11px 12px;
            border-radius: 8px;
            color: white;
        }
        .push-notification #close-notification{
            font-size: 25px;
            cursor: pointer;;
            margin-top: 2px;
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
        <h2>EGG COLLECTION ENTRY</h2>
        <div class="exit-icon" >
            <img src="/Images/Exit-Icon.png" alt="" onclick="window.location.href='/home'">
        </div>
    </div>

    <form class="body" action="{{route('egg.collection.store')}}" method="POST">
        @csrf
        <div class="form-header">
            <h4>Entry Form</h4>
        </div>
        <div class="form-input col-4">  
            <div class="input-container column">
                <label for="">PS no. <span></span></label>
                <select name="ps_no" id="ps_no">
                    <option value=""></option>
                    <option value="93">93</option>
                    <option value="95">95</option>
                    <option value="98">98</option>
                </select>
            </div>
            <div class="input-container column">
                <label for="">House no. <span></span></label>
                <select name="house_no" id="house_no">
                    <option value=""></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>
            <div class="input-container column">
                <label for="">Production Date <span></span></label>
                <input type="date" name="production_date" id="production_date">
            </div>
            <div class="input-container column">
                <label for="">Collection Time (hh:mm) <span></span></label>
                <input type="time" name="collection_time" id="collection_time">
            </div>
            <div class="input-container column">
                <label for="">Collection Eggs Quantity <span></span></label>
                <input type="number" name="collection_eggs_quantity" id="collection_eggs_quantity" placeholder="0">
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
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>PS no.</th>
                        <th>House No.</th>
                        <th>Production Date</th>
                        <th>Collection Time</th>
                        <th>Collected QTY</th>
                        <th>Encoded/Modified By</th>
                        <th>Date Encoded/Modified</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>#93</td>
                        <td>4</td>
                        <td>09/12/25</td>
                        <td>16:00</td>
                        <td>1200</td>
                        <td>IT Head</td>
                        <td>09/12/25</td>
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
            document.querySelector("form").addEventListener("submit", function (event) {
                event.preventDefault(); // Prevent form submission initially
                let isValid = true;
                const requiredFields = ["ps_no", "house_no", "production_date", "collection_time", "collection_eggs_quantity",];
                
                requiredFields.forEach(id => {
                    let field = document.getElementById(id);
                    let labelSpan = field.closest(".input-container").querySelector("label span");
                    
                    if (!field.value.trim()) {
                        field.style.border = "2px solid #ea4435d7";
                        // field.style.marginTop = "5px";
                        labelSpan.textContent = "(This field is required)";
                        labelSpan.style.color = "#ea4435d7";
                        isValid = false;
                    }else{
                        field.style.border = "";
                        labelSpan.textContent = "";
                    }
                });
                if (isValid) {
                    showModal(); // Show modal when all fields are filled
                }
                
            });
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