document.querySelector("form").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form submission initially
    let isValid = true;

    const requiredFields = ["ps_no", "set_eggs_qty", "incubator_no", "hatcher_no", "production_date_from", "production_date_to", "hatch_date", "qc_date"];
    
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
                        <button type="button" class="confirm-button csv-btn" onclick="window.location.href='/rejected-pullets/csv'">
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

function storeRecord(){

    let incubatornoValues = Array.from(document.getElementById('incubator_no').selectedOptions)
    .map(option => option.value);

    let hatchernoValues = Array.from(document.getElementById('hatcher_no').selectedOptions)
    .map(option => option.value);

    fetch("/rejected-pullets/store", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken
        },
        body: JSON.stringify({

            ps_no: document.getElementById("ps_no").value,
            set_eggs_qty: document.getElementById("set_eggs_qty").value,
            incubator_no: incubatornoValues,
            hatcher_no: hatchernoValues,

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

            production_date_from: document.getElementById("production_date_from").value,
            production_date_to: document.getElementById("production_date_to").value,
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
            document.querySelectorAll(".asterisk").forEach(item => item.classList.add("active"));

            updatePagination(); // Update pagination
            loadData(); // Reload data

            // Trigger push notification
            createPushNotification("success", "Saved Successfully", "Rejected Pullets Entry Saved Successfully");
        } else {
            alert("Error saving record");
        }
    }).catch(error => {
        console.error("Error:", error)
        createPushNotification("danger", "Save Unsuccessful", "Please try again or Contact Support if the issue persist.");
    });
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
            createPushNotification("success", "Deleted Successfully", "Rejected Pullets Entry Deleted Successfully");
        } else {
            // alert("Error deleting record");
            createPushNotification("danger", "Delete Unsuccessful", "Please try again or Contact Support if the issue persist.");
        }
    }).catch(error => {
        console.error("Error:", error)
        createPushNotification("danger", "Delete Unsuccessful", "Please try again or Contact Support if the issue persist.");
    });
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