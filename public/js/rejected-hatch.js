const form = document.querySelector(".body"); // Main form container
const inputs = form.querySelectorAll("input, select"); // All form fields

const formAction = form.querySelector(".form-action"); // Form action buttons
const resetButton = form.querySelector(".reset-btn"); // Reset button

const modal = document.getElementById("modal"); // Modal
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // CSRF token

//make every input type number prevent user from entering special characters just purely number
document.querySelectorAll('input[type="number"]').forEach(input => {
    input.addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    })  
})

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

document.addEventListener("click", function (event) {

    if (!modal.classList.contains("active")) return;

    if (event.target.id === "close-button" || event.target.classList.contains("cancel-button")) {
        modal.classList.remove("active");
    }
});

document.querySelector("form").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form submission initially
    let isValid = true;

    const requiredFields = ["ps_no", "production_date", "set_eggs_qty", "incubator_no", "hatcher_no", "pullout_date", "hatch_date"];
    
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
        showModal("save"); // Show modal when all fields are filled
    }
    
});

document.addEventListener("DOMContentLoaded", function () {
    const setEggsQtyInput = document.getElementById("set_eggs_qty"); // Make sure the ID matches in your HTML
    const totalRejectedInput = document.getElementById("rejected_total");
    const fields = ["unhatched", "pips", "rejected_chicks", "dead_chicks", "rotten"];

    // Add event listeners for all fields
    fields.forEach(field => {
        document.getElementById(field).addEventListener("input", updatePercentages);
    });

    // Update percentages when set_eggs_qty changes
    setEggsQtyInput.addEventListener("input", updatePercentages);

    function updatePercentages() {
        let setEggsQty = parseFloat(setEggsQtyInput.value) || 1; // Avoid division by zero
        let totalRejected = 0;

        // If setEggsQty is empty or less than total rejected, reset everything
        if (!setEggsQtyInput.value.trim() || totalRejectedInput.value > setEggsQty) {
            fields.forEach(field => {
                document.getElementById(field).value = 0;
                document.getElementById(`${field}_prcnt`).value = 0;
            });
            totalRejectedInput.value = 0;
            document.getElementById("rejected_total_prcnt").value = 0;
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

            let percentage = ((value / setEggsQty) * 100).toFixed(1); // Store as 10.0 format
            document.getElementById(`${field}_prcnt`).value = Math.round(percentage); // Display whole number
            totalRejected += value;
        });

        // Update Rejected Total and Percentage
        totalRejectedInput.value = totalRejected;
        let rejectedPercentage = ((totalRejected / setEggsQty) * 100).toFixed(1);
        document.getElementById("rejected_total_prcnt").value = Math.round(rejectedPercentage); // Display as whole number
    }
});

function showModal(button){
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
            document.querySelector('form').submit();

            // storeRecord();
        });

    }
}