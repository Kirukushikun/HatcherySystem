<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejected Hatch Entry</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="{{asset('images/BGC icon.ico')}}">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">

</head>
<body>
    <div class="header">
        <img class="logo" src="/Images/BDL.png" alt="">
        <h2>REJECTED HATCH ENTRY</h2>
        <div class="exit-icon" >
            <img src="/Images/Exit-Icon.png" alt="" onclick="window.location.href='/Html/main_module.html'">
        </div>
    </div>
    <form class="body">
        <div class="form-header">
            <h4>Entry Form</h4>
        </div>

        <div class="form-input col-5">
            <div class="input-container column">
                <label for="">PS no.</label>
                <select name="" id="" required>
                    <option value=""></option>
                </select>
            </div>
            <div class="input-container column">
                <label for="">Production Date</label>
                <input type="date">
            </div>
            <div class="input-container column">
                <label for="">Set Egg Qty</label>
                <input type="number" placeholder="0" required>
            </div>
            <div class="input-container column">
                <label for="">Incubator #</label>
                <select name="" id="" required>
                    <option value=""></option>
                </select>
            </div>
            <div class="input-container column">
                <label for="">Hatch #</label>
                <select name="" id="" required>
                    <option value=""></option>
                </select>
            </div>

            <div class="input-container row">

                <div class="input-group">
                    <label for="">Unhatched</label>
                    <input type="number" placeholder="0">
                </div>
                <div class="input-group prcnt">
                    <label for="">%</label>
                    <input type="number" placeholder="0" disabled>
                </div>

            </div>
            <div class="input-container row">

                <div class="input-group">
                    <label for="">Pips</label>
                    <input type="number" placeholder="0">
                </div>
                <div class="input-group prcnt">
                    <label for="">%</label>
                    <input type="number" placeholder="0" disabled>
                </div>

            </div>
            <div class="input-container row">

                <div class="input-group">
                    <label for="">Rejected Chicks</label>
                    <input type="number" placeholder="0">
                </div>
                <div class="input-group prcnt">
                    <label for="">%</label>
                    <input type="number" placeholder="0" disabled>
                </div>

            </div>
            <div class="input-container row">

                <div class="input-group">
                    <label for="">Dead Chicks</label>
                    <input type="number" placeholder="0">
                </div>
                <div class="input-group prcnt">
                    <label for="">%</label>
                    <input type="number" placeholder="0" disabled>
                </div>

            </div>
            <div class="input-container row">

                <div class="input-group">
                    <label for="">Rotten</label>
                    <input type="number" placeholder="0">
                </div>
                <div class="input-group prcnt">
                    <label for="">%</label>
                    <input type="number" placeholder="0" disabled>
                </div>

            </div>
            <div class="input-container column">
                <label for="">Pull-out Date</label>
                <input type="date" required>
            </div>
            <div class="input-container column">
                <label for="">Hatch Date</label>
                <input type="date" required>
            </div>
            <div class="input-container row">

                <div class="input-group">
                    <label for="">Rejected Total</label>
                    <input type="number" placeholder="0" disabled>
                </div>
                <div class="input-group prcnt">
                    <label for="">%</label>
                    <input type="number" placeholder="0" disabled>
                </div>

            </div>



        </div>

        <div class="form-action">
            <button class="save-btn">Save</button>
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