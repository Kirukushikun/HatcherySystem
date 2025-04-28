let driver_name = document.getElementById("driver_name");

document.querySelector("form").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form submission initially
    let isValid = true;

    let requiredFields;

    if (driver_name.value){
        requiredFields = ["ps_no", "production_date", "collection_time", "collection_eggs_quantity", "house_no", "driver_name"];
    } else{
        requiredFields = ["ps_no", "production_date", "collection_time", "collection_eggs_quantity", "house_no"];
    }

    requiredFields.forEach(id => {
        const field = document.getElementById(id);
        const container = field.closest(".input-container");
        const labelSpan = container.querySelector("label span");
        const asterisk = container.querySelector(".asterisk");

        let isEmpty = false;

        // Special handling for multi-selects
        if (field.multiple) {
            const selected = Array.from(field.selectedOptions);
            isEmpty = selected.length === 0;

            // Optional: Add red border to the custom dropdown
            const customDropdown = field.nextElementSibling; // Assuming the multiselect div is next
            if (isEmpty) {
                customDropdown.style.border = "2px solid #ea4435d7";
            } else {
                customDropdown.style.border = "";
            }
        } else {
            isEmpty = !field.value.trim();
        }

        if (isEmpty) {
            field.style.border = "2px solid #ea4435d7";
            labelSpan.textContent = "This field is required";
            labelSpan.style.color = "#ea4435d7";
            asterisk.classList.add("active");
            isValid = false;
        } else {
            field.style.border = "";
            labelSpan.textContent = "";
            asterisk.classList.remove("active");
        }
    });

    if (isValid) {
        showModal('save'); // Proceed when valid
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
                        <button type="button" class="confirm-button csv-btn" onclick="window.location.href='/egg-collection/csv'">
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
                        <button type="button" class="confirm-button report-btn" onclick="window.location.href='/egg-collection/report'">
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

    let housenoValues = Array.from(document.getElementById('house_no').selectedOptions)
    .map(option => option.value);
    
    fetch("/egg-collection/store", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken
        },
        body: JSON.stringify({
            ps_no: document.getElementById("ps_no").value,
            house_no: housenoValues,
            production_date: document.getElementById("production_date").value,
            collection_time: document.getElementById("collection_time").value,
            collection_eggs_quantity: document.getElementById("collection_eggs_quantity").value,
            driver_name: driver_name.value || null
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById("modal").classList.remove("active");
            document.getElementById("ps_no").value = "";
            document.getElementById("house_no").value = "";
            document.getElementById("collection_eggs_quantity").value = "";

            // Clear multiselect
            clearMultiSelect();

            document.querySelectorAll(".asterisk").forEach(item => item.classList.add("active"));

            if(!driver_name.value){
                updatePagination(); // Update pagination
                loadData(); // Reload datafunction clearMultiSelect() {                
            }

            // Trigger push notification
            createPushNotification("success", "Saved Successfully", "Egg Collection Entry Saved Successfully");

            // Hide form action buttons
            form.querySelector(".form-action").style.display = "none"; // Hide form action buttons
        } else {
            alert("Error saving record");
        }
    }).catch(error => {
        console.error("Error:", error)
        createPushNotification("danger", "Save Unsuccessful", "Please try again or Contact Support if the issue persist.");
    });
    

}

function deleteRecord(targetID) {
    fetch(`/egg-collection/delete/${targetID}`, {
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

            if(!driver_name.value){
                updatePagination(); // Update pagination
                loadData(); // Reload datafunction clearMultiSelect() {                
            }

            // Trigger push notification
            createPushNotification("success", "Deleted Successfully", "Egg Collection Entry Deleted Successfully");
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
            window.location.href = `/egg-collection/edit/${encodeURIComponent(data.encrypted_id)}`;
        } else {
            console.error('Error encrypting ID');
        }
    }).catch(error => {
        console.error("Error:", error)
        createPushNotification("danger", "Edit Unsuccessful", "Please try again or Contact Support if the issue persist.");
    });
}

