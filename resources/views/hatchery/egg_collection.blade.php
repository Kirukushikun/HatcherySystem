<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Egg Collection Entry</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="/Images/BGC icon.ico">
    <link rel="stylesheet" href="/Css/styles.css">
</head>
<body>
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
                <label for="">PS no.</label>
                <select name="ps_no" id="ps_no">
                    <option value=""></option>
                    <option value="93">93</option>
                    <option value="95">95</option>
                    <option value="98">98</option>
                </select>
            </div>
            <div class="input-container column">
                <label for="">House no.</label>
                <select name="house_no" id="house_no">
                    <option value=""></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>
            <div class="input-container column">
                <label for="">Production Date</label>
                <input type="date" name="production_date" id="production_date">
            </div>
            <div class="input-container column">
                <label for="">Collection Time (hh:mm)</label>
                <input type="time" name="collection_time" id="collection_time">
            </div>
            <div class="input-container column">
                <label for="">Collection Eggs Quantity</label>
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
        });
    </script>
</body>
</html>