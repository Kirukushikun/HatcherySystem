const form = document.querySelector(".body"); // Main form container
const inputs = form.querySelectorAll("input, select"); // All form fields

const formAction = form.querySelector(".form-action"); // Form action buttons
const resetButton = form.querySelector(".reset-btn"); // Reset button

const modal = document.getElementById("modal"); // Modal
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // CSRF token

//make every input type number prevent user from entering special characters just purely number
document.querySelectorAll('input[type="number"]').forEach(input => {
    input.addEventListener('input', function(e) {
        // Remove any non-numeric characters
        this.value = this.value.replace(/[^0-9]/g, '');

        // Prevent the input from starting with '00'
        if (this.value.startsWith('00')) {
            this.value = '0'; // Reset to a single '0'
        }
    });
});

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
        // Find the closest `.input-container` for the current input
        let inputContainer = input.closest(".input-container");

        if (inputContainer) {
            let labelSpan = inputContainer.querySelector("label span");
            let asterisk = inputContainer.querySelector(".asterisk");

            if (labelSpan && asterisk) {
                labelSpan.textContent = ""; // Clear the label span
                asterisk.classList.add("active");
            }
        }

        input.style.border = "";  // Reset border styling
    });

    // hide the form-action buttons
    formAction.style.display = "none";
});


document.querySelector("form").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form submission initially
    let isValid = true;

    const requiredFields = ["temp_check_date", "setting_date" , "hatch_date", "temp_check_qty", "ovrl_above_temp_qty", "left_ps_no", "right_ps_no"];
    
    requiredFields.forEach(id => {
        let field = document.getElementById(id);
        let labelSpan = field.closest(".input-container").querySelector("label span");
        let asterisk = field.closest(".input-container").querySelector(".asterisk");
        
        if (!field.value.trim()) {
            field.style.border = "2px solid #ea4435d7";
            // field.style.marginTop = "5px";
            labelSpan.textContent = "This field is required";
            labelSpan.style.color = "#ea4435d7";
            isValid = false;

            asterisk.classList.add("active");
        }else{
            field.style.border = "";
            labelSpan.textContent = "";
            asterisk.classList.remove("active");
        }
    });

    if (isValid) {
        showModal("save"); // Show modal when all fields are filled
    }
    
});

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
            // document.querySelector('form').submit();

            storeRecord();
        });

    } else if (button === "delete") {
        modal.classList.add("active");
        modal.innerHTML = `
            <div class="modal-content">
                <i class="fa-solid fa-xmark" id="close-button"></i>
                <div class="modal-header">
                    <i class="fa-solid fa-circle-xmark danger"></i>
                    <h2>Delete Record</h2>
                    <h4>Are you sure you want to delete this data?</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="confirm-button delete-btn" onclick="deleteRecord(${targetID})">
                        Delete
                    </button>
                    <button type="button" class="cancel-button">Cancel</button>
                </div>
            </div>
        `;
    } else if (button === "edit") { 
        editRecord(targetID);
    } else {
        modal.classList.add("active");
        modal.innerHTML = `
            <div class="modal-content export-options">
                <i class="fa-solid fa-xmark" id="close-button"></i>
                <div class="option">
                    <div class="modal-header">
                        <i class="fa-solid fa-file-csv csv"></i>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="confirm-button csv-btn" onclick="">
                            Generate CSV
                        </button>
                    </div>
                </div>

                <div id="separator"></div>
                
                <div class="option">
                    <div class="modal-header">
                        <i class="fa-solid fa-file-invoice report"></i>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="confirm-button report-btn" onclick="window.location.href='/egg-temperature/report'">
                            Generate Report
                        </button>
                    </div>                        
                </div>
            </div>
        `;

        document.querySelector('.csv-btn').addEventListener('click', () => {
            console.log("csv")
        });

        document.querySelector('.report-btn').addEventListener('click', () => {
            console.log("report")
        });
    }
}

function storeRecord(){
    fetch("/egg-temperature/store", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken
        },
        body: JSON.stringify({
            temp_check_date: document.getElementById("temp_check_date").value,
            setting_date: document.getElementById("setting_date").value,
            hatch_date: document.getElementById("hatch_date").value,

            temp_check_qty: document.getElementById("temp_check_qty").value,
            ovrl_above_temp_qty: document.getElementById("ovrl_above_temp_qty").value,
            ovrl_above_temp_prcnt: document.getElementById("ovrl_above_temp_prcnt").value,
            ovrl_below_temp_qty: document.getElementById("ovrl_below_temp_qty").value,
            ovrl_below_temp_prcnt: document.getElementById("ovrl_below_temp_prcnt").value,

            left_ps_no: document.getElementById("left_ps_no").value,
            left_above_temp_qty: document.getElementById("left_above_temp_qty").value,
            left_above_temp_prcnt: document.getElementById("left_above_temp_prcnt").value,
            left_below_temp_qty: document.getElementById("left_below_temp_qty").value,
            left_below_temp_prcnt: document.getElementById("left_below_temp_prcnt").value,

            total_left_qty: document.getElementById("total_left_qty").value,

            right_ps_no: document.getElementById("right_ps_no").value,
            right_above_temp_qty: document.getElementById("right_above_temp_qty").value,
            right_above_temp_prcnt: document.getElementById("right_above_temp_prcnt").value,
            right_below_temp_qty: document.getElementById("right_below_temp_qty").value,
            right_below_temp_prcnt: document.getElementById("right_below_temp_prcnt").value,

            total_right_qty: document.getElementById("total_right_qty").value,
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById("modal").classList.remove("active");

            const inputIds = [
                "temp_check_qty", "ovrl_above_temp_qty", "ovrl_above_temp_prcnt",
                "ovrl_below_temp_qty", "ovrl_below_temp_prcnt",
                "left_ps_no", "left_above_temp_qty", "left_above_temp_prcnt",
                "left_below_temp_qty", "left_below_temp_prcnt", "total_left_qty",
                "right_ps_no", "right_above_temp_qty", "right_above_temp_prcnt",
                "right_below_temp_qty", "right_below_temp_prcnt", "total_right_qty"
            ];
              
            inputIds.forEach(id => {
                const input = document.getElementById(id);
                if (input) input.value = "";
            });
            
            document.querySelectorAll(".asterisk").forEach(item => item.classList.add("active"));

            updatePagination(); // Update pagination
            loadData(); // Reload data

            // Trigger push notification
            createPushNotification("success", "Saved Successfully", "Egg Temperature Entry Saved Successfully");
        } else {
            alert("Error saving record");
        }
    }).catch(error => {
        console.error("Error:", error)
        createPushNotification("danger", "Save Unsuccessful", "Please try again or Contact Support if the issue persist.");
    });
}

function deleteRecord(targetID) {
    fetch(`/egg-temperature/delete/${targetID}`, {
        method: "PATCH",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById("modal").classList.remove("active");
            document.getElementById(`row-${targetID}`)?.remove(); // Remove row if exists

            updatePagination(); // Update pagination
            loadData(); // Reload data

            // Trigger push notification
            createPushNotification("success", "Deleted Successfully", "Egg Temperature Entry Deleted Successfully");
        } else {
            // alert("Error deleting record");
            createPushNotification("danger", "Delete Unsuccessful", "Please try again or Contact Support if the issue persist.");
        }
    })
    .catch(error => console.error("Error:", error));
}

function editRecord(targetID) {
    fetch(`/api/encrypt-id`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken
        },
        body: JSON.stringify({
            targetID: targetID
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.encrypted_id) {
            window.location.href = `/egg-temperature/edit/${encodeURIComponent(data.encrypted_id)}`;
        } else {
            console.error('Error encrypting ID');
        }
    })
    .catch(error => console.error("Error:", error));

    console.log("editing", targetID);
}

document.addEventListener("click", function (event) {

    if (!modal.classList.contains("active")) return;

    if (event.target.id === "close-button" || event.target.classList.contains("cancel-button")) {
        modal.classList.remove("active");
    }
});



let temp_check_qty = document.getElementById("temp_check_qty");

let ovrl_above_temp_qty = document.getElementById("ovrl_above_temp_qty");
let ovrl_above_temp_prcnt = document.getElementById("ovrl_above_temp_prcnt");

let ovrl_below_temp_qty = document.getElementById("ovrl_below_temp_qty");
let ovrl_below_temp_prcnt = document.getElementById("ovrl_below_temp_prcnt");

let left_above_temp_qty = document.getElementById("left_above_temp_qty");
let left_above_temp_prcnt = document.getElementById("left_above_temp_prcnt");

let left_below_temp_qty = document.getElementById("left_below_temp_qty");
let left_below_temp_prcnt = document.getElementById("left_below_temp_prcnt");

let right_above_temp_qty = document.getElementById("right_above_temp_qty");
let right_above_temp_prcnt = document.getElementById("right_above_temp_prcnt");

let right_below_temp_qty = document.getElementById("right_below_temp_qty");
let right_below_temp_prcnt = document.getElementById("right_below_temp_prcnt");

let total_left_qty = document.getElementById("total_left_qty");
let total_right_qty = document.getElementById("total_right_qty");

function calculateOverallTemps() {
    let total = parseInt(temp_check_qty.value) || 0;
    let aboveQty = parseInt(ovrl_above_temp_qty.value) || 0;

    if (aboveQty > total) {
        aboveQty = total;
        ovrl_above_temp_qty.value = total;
    } else if (aboveQty < 0) {
        aboveQty = 0;
        ovrl_above_temp_qty.value = 0;
    }

    let abovePrcnt = Math.round((aboveQty / total) * 100);
    let belowQty = total - aboveQty;
    let belowPrcnt = 100 - abovePrcnt;

    ovrl_above_temp_prcnt.value = abovePrcnt;
    ovrl_below_temp_qty.value = belowQty;
    ovrl_below_temp_prcnt.value = belowPrcnt;

    calculateLeftRightTemps(aboveQty, belowQty);
}

function calculateLeftRightTemps(aboveQty, belowQty) {
    let leftAbove = parseInt(left_above_temp_qty.value) || 0;
    let leftBelow = parseInt(left_below_temp_qty.value) || 0;

    // Clamp left inputs
    if (leftAbove > aboveQty) {
        leftAbove = aboveQty;
        left_above_temp_qty.value = aboveQty;
    }
    if (leftBelow > belowQty) {
        leftBelow = belowQty;
        left_below_temp_qty.value = belowQty;
    }

    let leftTotal = leftAbove + leftBelow;
    let rightAbove = aboveQty - leftAbove;
    let rightBelow = belowQty - leftBelow;
    let rightTotal = rightAbove + rightBelow;

    // Percentages
    let leftAbovePercent = leftTotal > 0 ? Math.round((leftAbove / leftTotal) * 100) : 0;
    let leftBelowPercent = leftTotal > 0 ? 100 - leftAbovePercent : 0;

    let rightAbovePercent = rightTotal > 0 ? Math.round((rightAbove / rightTotal) * 100) : 0;
    let rightBelowPercent = rightTotal > 0 ? 100 - rightAbovePercent : 0;

    // Set values
    left_above_temp_prcnt.value = leftAbovePercent;
    left_below_temp_prcnt.value = leftBelowPercent;

    right_above_temp_qty.value = rightAbove;
    right_above_temp_prcnt.value = rightAbovePercent;

    right_below_temp_qty.value = rightBelow;
    right_below_temp_prcnt.value = rightBelowPercent;

    total_left_qty.value = leftTotal;
    total_right_qty.value = rightTotal;
}

ovrl_above_temp_qty.addEventListener("input", calculateOverallTemps);
left_above_temp_qty.addEventListener("input", () => {
    let aboveQty = parseInt(ovrl_above_temp_qty.value) || 0;
    let belowQty = parseInt(ovrl_below_temp_qty.value) || 0;
    calculateLeftRightTemps(aboveQty, belowQty);
});

left_below_temp_qty.addEventListener("input", () => {
    let aboveQty = parseInt(ovrl_above_temp_qty.value) || 0;
    let belowQty = parseInt(ovrl_below_temp_qty.value) || 0;
    calculateLeftRightTemps(aboveQty, belowQty);
});