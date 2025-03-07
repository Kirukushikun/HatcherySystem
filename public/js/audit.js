function showModalAudit(button, targetID = null) {

    if (button === "delete") {
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
                    <button type="button" class="confirm-button delete-btn" onclick="deleteRecordAudit(${targetID})">
                        Delete
                    </button>
                    <button type="button" class="cancel-button">Cancel</button>
                </div>
            </div>
        `;
    }else if (button === "view") { 
        fetchAuditData(targetID);
    }
}

function fetchAuditData(targetID) {
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
            fetch(`/fetch-audit-data/${encodeURIComponent(data.encrypted_id)}`)
            .then(response => response.json())
            .then(data => {

                displayAuditData(data);
            })
        } else {
            console.error('Error encrypting ID');
        }
    })
    .catch(error => console.error("Error:", error));

    console.log("fetch audit", targetID);
}

function displayAuditData(data) {
    let modal = document.getElementById("audit-modal");

    if (!modal) {
        console.error("Modal element not found!");
        return; // Stop execution if modal doesn't exist
    }

    let oldData = {}, newData = {};

    try {
        oldData = JSON.parse(data.old_value) || {};
        newData = JSON.parse(data.new_value) || {};
    } catch (error) {
        console.error("Error parsing Data:", error);
    }

    let tableRows = "";
    const allKeys = new Set([...Object.keys(oldData), ...Object.keys(newData)]);
    const fields = {
        id: "ID",
        is_deleted: "Deleted",

        ps_no: "PS No.",
        hatcher_no: "Hatcher No.",
        house_no: "House No.",
        incubator_no: "Incubator No.",
        
        location: "Location",
        temperature: "Temperature",
        collection_time: "Collection Time",

        collected_qty: "Collected Quantity",
        quantity: "Quantity",
        set_eggs_qty: "Set Eggs Quantity",
        rejected_total: "Rejected Total",
        rejected_total_percentage: "Rejected Total %",

        rejected_hatch_data: "Rejected Hatch Data",
        rejected_pullets_data: "Rejected Pullets Data",

        setting_date: "Setting Date",
        production_date: "Production Date",
        temperature_check_date: "Temperature Check Date",
        qc_date: "QC Date",
        hatch_date: "Hatch Date",
        pullout_date: "Pull-out Date",

        encoded_by: "Encoded By",
        modified_by: "Modified By",
        created_at: "Created At",
        updated_at: "Updated At"
    }

    allKeys.forEach(key => {
        let displayFields = fields[key] || key;
        let oldValue = oldData[key] || "—";
        let newValue = newData[key] || "—";
    
        // Check if the field is a date field and format it
        const dateFields = [
            "setting_date", "production_date", "temperature_check_date", 
            "qc_date", "hatch_date", "pullout_date", "created_at", "updated_at"
        ];
    
        if (dateFields.includes(key)) {
            oldValue = oldValue !== "—" ? new Date(oldValue).toLocaleDateString("en-US") : "—";
            newValue = newValue !== "—" ? new Date(newValue).toLocaleDateString("en-US") : "—";
        }
    
        tableRows += `
            <tr>
                <td data-label="Field">${displayFields}</td>
                <td data-label="Old Value">${oldValue}</td>
                <td data-label="New Value">${newValue}</td>
            </tr>
        `;
    });

    modal.innerHTML = `
    <div class="modal-content">
        <i class="fa-solid fa-xmark" id="close-button"></i>
        <h2>Audit Data</h2>
        <div class="audit-table-container"> <!-- Add this wrapper -->
            <table class="audit-table">
                <thead class="audit-table-header">
                    <tr>
                        <th>Field</th>
                        <th>Old Value</th>
                        <th>New Value</th>
                    </tr>
                </thead>
                <tbody>${tableRows}</tbody>
            </table>
        </div>
    </div>
    `;


    modal.classList.add("active");
}

function deleteRecordAudit(targetID) {
    if (!targetID) {
        console.error("No target ID provided for deletion.");
        return;
    }

    fetch(`/audit/delete/${targetID}`, {
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
            createPushNotification("danger", "Deleted Successfully", "Audit Trail deleted successfully");

            updatePaginationAudit(); // Update pagination
            loadDataAudit(); // Reload data

        } else {
            alert("Error deleting record: " + (data.message || "Unknown error"));
        }
    })
    .catch(error => console.error("Fetch Error:", error));
}

document.addEventListener("click", function (event) {
    const modal = document.getElementById("audit-modal");

    if (!modal.classList.contains("active")) return;

    if (event.target.id === "close-button" || event.target.classList.contains("cancel-button")) {
        modal.classList.remove("active");
    }
});
