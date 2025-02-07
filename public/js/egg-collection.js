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
        let inputContainer = input.closest(".input-container");

        if (inputContainer) {
            let labelSpan = inputContainer.querySelector("label span");
                if (labelSpan) {
                    labelSpan.textContent = "";
                }
        }
        input.style.border = "";
        input.value = "";
    });

    checkFormValues(); // Recheck values to hide form-action
});

// Initial check to hide the form-action if empty
// checkFormValues();
document.querySelector("form").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form submission initially
    let isValid = true;

    const requiredFields = ["ps_no", "house_no", "production_date", "collection_time", "collection_eggs_quantity"];
    
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
    const modal = document.getElementById("modal");
    modal.classList.add("active");
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    modal.innerHTML = `
        <form class="modal-content" action="/egg-collection/${button}/${targetID}" method="POST">
            <input type="hidden" name="_token" value="${csrfToken}">
            <input type="hidden" name="_method" value="PATCH">

            <i class="fa-solid fa-xmark" id="close-button"></i>
            <div class="modal-header">
                ${
                    button === "save"
                        ? '<i class="fa-solid fa-circle-check success"></i><h2>Save Record</h2><h4>Are you sure you want to save this data?</h4>'
                        : button === "delete"
                        ? '<i class="fa-solid fa-circle-xmark danger"></i><h2>Delete Record</h2><h4>Are you sure you want to delete this data?</h4>'
                        : '<i class="fa-solid fa-circle-info edit"></i><h2>Edit Record</h2><h4>Are you sure you want to edit this data?</h4>'
                }
            </div>
            <div class="modal-footer">
                <button type="submit" class="confirm-button ${
                    button === "save" ? "save-btn" : button === "delete" ? "delete-btn" : "edit-btn"
                }" data-id="${targetID}">
                    ${button.charAt(0).toUpperCase() + button.slice(1)}
                </button>
                <button type="button" class="cancel-button">Cancel</button>
            </div>
        </form>
    `;
}
document.addEventListener("click", function (event) {
    const modal = document.getElementById("modal");

    if (!modal.classList.contains("active")) return;

    if (event.target.id === "close-button" || event.target.classList.contains("cancel-button")) {
        modal.classList.remove("active");
    }
});


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
