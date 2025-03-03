const form = document.querySelector(".body"); // Main form container
const inputs = form.querySelectorAll("input, select"); // All form fields

const formAction = form.querySelector(".form-action"); // Form action buttons
const resetButton = form.querySelector(".reset-btn"); // Reset button

const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // CSRF token

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

    const requiredFields = ["data_category", "data_value"];
    
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
    }else if (button === "delete") {
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
    }else if (button === "edit") { 
        editRecord(targetID);
    }
}

function storeRecord(){
    fetch("/maintenance/store", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json", // Important! Forces Laravel to return JSON
            "X-CSRF-TOKEN": csrfToken
        },
        body: JSON.stringify({
            data_category: document.getElementById("data_category").value,
            data_value: document.getElementById("data_value").value,
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            document.getElementById("modal").classList.remove("active");
            document.getElementById("data_category").value = "";
            document.getElementById("data_value").value = "";
            formAction.style.display = "none";
    
            createPushNotification("success", "Saved Successfully", "Maintenance Value Saved Successfully");

            updatePagination(); // Update pagination
            loadData(); // Reload data

        } else {
            alert("Error saving record: " + (data.message || "Unknown error"));
        }
    })
    .catch(error => console.error("Fetch Error:", error));
}

function deleteRecord(targetID) {
    if (!targetID) {
        console.error("No target ID provided for deletion.");
        return;
    }

    fetch(`/maintenance/delete/${targetID}`, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-CSRF-TOKEN": csrfToken
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            document.getElementById("modal").classList.remove("active");
            createPushNotification("danger", "Deleted Successfully", "Maintenance Value deleted successfully");

            updatePagination(); // Update pagination
            loadData(); // Reload data

        } else {
            alert("Error deleting record: " + (data.message || "Unknown error"));
        }
    })
    .catch(error => console.error("Fetch Error:", error));
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
            window.location.href = `/maintenance-value/edit/${encodeURIComponent(data.encrypted_id)}`;
        } else {
            console.error('Error encrypting ID');
        }
    })
    .catch(error => console.error("Error:", error));

    console.log("editing", targetID);
}

document.addEventListener("click", function (event) {
    const modal = document.getElementById("modal");

    if (!modal.classList.contains("active")) return;

    if (event.target.id === "close-button" || event.target.classList.contains("cancel-button")) {
        modal.classList.remove("active");
    }
});