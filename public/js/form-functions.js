const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // CSRF token
const modal = document.getElementById("modal"); // Modal

const form = document.querySelector(".body"); // Main form container
const inputs = form.querySelectorAll("input, select"); // All form fields
const formAction = form.querySelector(".form-action"); // Form action buttons
const resetButton = form.querySelector(".reset-btn"); // Reset button
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

        // Reset normal input/select border
        input.style.border = "";

        // Special handling if it's a multiselect
        if (input.dataset.multiselect === "true") {
            const multiselectContainer = input.nextElementSibling; // the DIV that wraps the visible multiselect
            if (multiselectContainer) {
                multiselectContainer.style.border = ""; // Reset multiselect visible box border
            }
        }
    });

    clearMultiSelect(); // Clear multiselect if applicable

    // hide the form-action buttons
    formAction.style.display = "none";
});

function clearMultiSelect() {
    const multiselects = form.querySelectorAll('select[multiple]');

    multiselects.forEach(select => {
        Array.from(select.options).forEach(option => option.selected = false);
        select.dispatchEvent(new Event('change'));

        if (typeof select.loadOptions === 'function') {
            select.loadOptions(); // refresh if multiselect plugin provides it
        }
    });
}

// Function to close modal
document.addEventListener("click", function (event) {

    if (!modal.classList.contains("active")) return;

    if (event.target.id === "close-button" || event.target.classList.contains("cancel-button")) {
        modal.classList.remove("active");
    }
});