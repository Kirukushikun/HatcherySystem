const form = document.querySelector(".body"); // Main form container
const inputs = form.querySelectorAll("input, select"); // All form fields

const formAction = form.querySelector(".form-action"); // Form action buttons
const resetButton = form.querySelector(".reset-btn"); // Reset button

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

            if (labelSpan) {
                labelSpan.textContent = ""; // Clear the label span
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

    const requiredFields = ["ps_no", "production_date", "set_eggs_qty", "incubator_no", "hatcher_no", "pullout_date", "hatch_date", "qc_date"];
    
    requiredFields.forEach(id => {
        let field = document.getElementById(id);
        let labelSpan = field.closest(".input-container").querySelector("label span");
        
        if (!field.value.trim()) {
            field.style.border = "2px solid #ea4435d7";
            // field.style.marginTop = "5px";
            labelSpan.textContent = "This field is required";
            labelSpan.style.color = "#ea4435d7";
            isValid = false;
        }else{
            field.style.border = "";
            labelSpan.textContent = "";
        }
    });
    if (isValid) {
        showModal('save'); // Show modal when all fields are filled
    }
    
});

document.addEventListener("DOMContentLoaded", function () {
    const setEggsQtyInput = document.getElementById("set_eggs_qty"); // Make sure the ID matches in your HTML
    const totalRejectedInput = document.getElementById("rejected_total");
    const fields = ["singkit_mata", "wala_mata", "maliit_mata", "malaki_mata", "unhealed_navel", "cross_beak", "small_chick", "weak_chick", "black_bottons", "string_navel", "bloated"];

    // Add event listeners for all fields
    fields.forEach(field => {
        document.getElementById(field).addEventListener("input", updatePercentages);
    });

    // Update percentages when set_eggs_qty changes
    setEggsQtyInput.addEventListener("input", updatePercentages);

    function updatePercentages() {
        let setEggsQty = parseFloat(setEggsQtyInput.value) || 1; // Avoid division by zero
        let totalRejected = 0;

        // Reset if setEggsQty is empty or invalid
        if (!setEggsQtyInput.value.trim() || totalRejectedInput.value > setEggsQty) {
            fields.forEach(field => {
                document.getElementById(field).value = 0;
                document.getElementById(`${field}_prcnt`).value = "0.0"; // Keep decimal
            });
            totalRejectedInput.value = 0;
            document.getElementById("rejected_total_prcnt").value = "0.0"; // Keep decimal
            return;
        }

        fields.forEach(field => {
            let fieldInput = document.getElementById(field);
            let value = parseInt(fieldInput.value) || 0;

            // Prevent input values from exceeding setEggsQty
            if (value > setEggsQty) {
                fieldInput.value = setEggsQty;
                value = setEggsQty;
            }

            let percentage = ((value / setEggsQty) * 100).toFixed(1); // Keep 1 decimal
            document.getElementById(`${field}_prcnt`).value = percentage; // Keep decimal
            totalRejected += value;
        });

        // Update Rejected Total and Percentage
        totalRejectedInput.value = totalRejected;
        let rejectedPercentage = ((totalRejected / setEggsQty) * 100).toFixed(1);
        document.getElementById("rejected_total_prcnt").value = rejectedPercentage; // Keep decimal
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
                        <button type="button" class="confirm-button report-btn" onclick="window.location.href='/rejected-pullets/report'">
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

document.addEventListener("click", function (event) {
    const modal = document.getElementById("modal");

    if (!modal.classList.contains("active")) return;

    if (event.target.id === "close-button" || event.target.classList.contains("cancel-button")) {
        modal.classList.remove("active");
    }
});

function storeRecord(){
    fetch("/rejected-pullets/store", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken
        },
        body: JSON.stringify({

            ps_no: document.getElementById("ps_no").value,
            production_date: document.getElementById("production_date").value,
            set_eggs_qty: document.getElementById("set_eggs_qty").value,
            incubator_no: document.getElementById("incubator_no").value,
            hatcher_no: document.getElementById("hatcher_no").value,

            singkit_mata: document.getElementById("singkit_mata").value,
            singkit_mata_prcnt: document.getElementById("singkit_mata_prcnt").value,

            wala_mata: document.getElementById("wala_mata").value,
            wala_mata_prcnt: document.getElementById("wala_mata_prcnt").value,

            maliit_mata: document.getElementById("maliit_mata").value,
            maliit_mata_prcnt: document.getElementById("maliit_mata_prcnt").value,
            
            malaki_mata: document.getElementById("malaki_mata").value,
            malaki_mata_prcnt: document.getElementById("malaki_mata_prcnt").value,
            
            unhealed_navel: document.getElementById("unhealed_navel").value,
            unhealed_navel_prcnt: document.getElementById("unhealed_navel_prcnt").value,

            cross_beak: document.getElementById("cross_beak").value,
            cross_beak_prcnt: document.getElementById("cross_beak_prcnt").value,

            small_chick: document.getElementById("small_chick").value,
            small_chick_prcnt: document.getElementById("small_chick_prcnt").value,

            weak_chick: document.getElementById("weak_chick").value,
            weak_chick_prcnt: document.getElementById("weak_chick_prcnt").value,

            black_bottons: document.getElementById("black_bottons").value,
            black_bottons_prcnt: document.getElementById("black_bottons_prcnt").value,

            string_navel: document.getElementById("string_navel").value,
            string_navel_prcnt: document.getElementById("string_navel_prcnt").value,

            bloated: document.getElementById("bloated").value,
            bloated_prcnt: document.getElementById("bloated_prcnt").value,

            pullout_date: document.getElementById("pullout_date").value,

            hatch_date: document.getElementById("hatch_date").value,

            qc_date: document.getElementById("qc_date").value,

            rejected_total: document.getElementById("rejected_total").value,
            rejected_total_prcnt: document.getElementById("rejected_total_prcnt").value

        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById("modal").classList.remove("active");

            form.reset();

            updatePagination(); // Update pagination
            loadData(); // Reload data

            // Trigger push notification
            createPushNotification("success", "Saved Successfully", "Rejected Pullets Entry Saved Successfully");
        } else {
            alert("Error saving record");
        }
    })
    .catch(error => console.error("Error:", error));
}

function deleteRecord(targetID) {
    fetch(`/rejected-pullets/delete/${targetID}`, {
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
            createPushNotification("danger", "Deleted Successfully", "Rejected Pullets Entry Deleted Successfully");
        } else {
            alert("Error deleting record");
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
            window.location.href = `/rejected-pullets/edit/${encodeURIComponent(data.encrypted_id)}`;
        } else {
            console.error('Error encrypting ID');
        }
    })
    .catch(error => console.error("Error:", error));

    console.log("editing", targetID);
}