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


document.querySelector("form").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form submission initially
    let isValid = true;

    const requiredFields = ["ps_no", "setting_date", "incubator", "location", "temp_check_date", "temperature", "quantity"];
    
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