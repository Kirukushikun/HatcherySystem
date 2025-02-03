<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Egg Temperature Check Entry</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="/Images/BGC icon.ico">
    <link rel="stylesheet" href="/Css/styles.css">
</head>
<body>
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
                <label for="ps_no">PS no.</label>
                <select name="ps_no" id="ps_no" required>
                    <option value=""></option>
                    <option value="#93">#93</option>
                </select>
            </div>
            <div class="input-container column">
                <label for="setting_date">Setting Date</label>
                <input type="date" name="setting_date" id="setting_date" required>
            </div>
            <div class="input-container column">
                <label for="incubator_no">Incubator #</label>
                <select name="incubator_no" id="incubator_no" required>
                    <option value=""></option>
                    <option value="5">5</option>
                </select>
            </div>
            <div class="input-container column">
                <label for="location">Location</label>
                <select name="location" id="location" required>
                    <option value=""></option>
                    <option value="Top">Top</option>
                    <option value="Mid">Mid</option>
                    <option value="Low">Low</option>
                </select>
            </div>
            <div class="input-container column">
                <label for="temp_check_date">Temperature Check Date</label>
                <input name="temp_check_date" id="temp_check_date" type="date" required>
            </div>
            <div class="input-container column">
                <label for="temperature">Temperature</label>
                <select name="temperature" id="temperature" required>
                    <option value=""></option>
                    <option value="37.8 Above">37.8 Above</option>
                    <option value="37.7 Below">37.7 Below</option>
                </select>
            </div>
            <div class="input-container column">
                <label for="quantity">Quantity</label>
                <input name="quantity" id="quantity" type="number" required>
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
            checkFormValues();
        });
    </script>
    
</body>
</html>