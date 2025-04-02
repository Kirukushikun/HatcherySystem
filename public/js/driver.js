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

    const requiredFields = ["ps_no", "house_no", "production_date", "collection_time", "collection_eggs_quantity", "driver"];
    
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
    }
}
function storeRecord() {
    if (!csrfToken) {
        console.error("CSRF token is missing.");
        createPushNotification("danger", "Error", "CSRF token is missing. Refresh and try again.");
        return;
    }
    fetch("/driver-collection-store/store", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken
        },
        body: JSON.stringify({
            ps_no: document.getElementById("ps_no").value,
            house_no: document.getElementById("house_no").value,
            production_date: document.getElementById("production_date").value,
            collection_time: document.getElementById("collection_time").value,
            collection_eggs_quantity: document.getElementById("collection_eggs_quantity").value,
            driver: document.getElementById("driver").value
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`Server Error: ${response.status} ${response.statusText}`);
        }
        return response.json();
    })
    .then(data => {
        if (!data.success) {
            throw new Error("Save unsuccessful. Please try again.");
        }

        document.getElementById("modal").classList.remove("active");
        document.getElementById("ps_no").value = "";
        document.getElementById("house_no").value = "";
        document.getElementById("collection_time").value = "";
        document.getElementById("collection_eggs_quantity").value = "";
        document.getElementById("driver").value = "";
        // Trigger push notification
        createPushNotification("success", "Saved Successfully", "Egg Collection Entry Saved Successfully");
    })
    .catch(error => {
        console.error("Error:", error);
        createPushNotification("danger", "Save Failed", "Please try again or contact support if the issue persists.");

        // setTimeout(() => {
        //     location.reload(); // Refresh after 3s
        // }, 3000);
    });
}
document.addEventListener("click", function (event) {
    const modal = document.getElementById("modal");

    if (!modal.classList.contains("active")) return;

    if (event.target.id === "close-button" || event.target.classList.contains("cancel-button")) {
        modal.classList.remove("active");
    }
});
