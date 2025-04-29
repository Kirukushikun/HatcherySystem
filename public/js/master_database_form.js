const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // CSRF token
const sidebarLinks = document.querySelectorAll(".sidebar a");
const cardSections = document.querySelectorAll(".card");
const cardLabels = document.querySelectorAll(".card-label");
const datalist = document.getElementById("card11");
let activeForm = null;


//Method 1
let batchNumberInput = document.getElementById("batch_no");
let currentStepInput = document.getElementById("current_step");

let batchNumber = Number(batchNumberInput.value) || 1;
let currentStep = Number(currentStepInput.value) || 1;

//Method 2
// let batchNumber = 1;
// let currentStep = 3;

console.log("Batch No: ", batchNumber, "Current Step: ", currentStep);
console.log("Active Form: ", activeForm);

/*** Event Listeners ***/
datalist.addEventListener("pointerdown", function () {
    activateSection(this);
});

    // Event Listener: Sidebar Clicks
sidebarLinks.forEach(link => {
    link.addEventListener("click", function (event) {
        const targetCard = document.querySelector(this.getAttribute("href"));
        activateSection(targetCard);
    });
});

    // Event Listener: Input Focus
document.querySelectorAll(".card input, .card select, .card textarea").forEach(input => {
    input.addEventListener("focus", function () {
        activateSection(this.closest(".card"));
    });
});

    // Event Listener: Form Close Buttons
document.addEventListener("click", function (event) {
    const modal = document.getElementById("modal");

    if (!modal.classList.contains("active")) return;

    if (event.target.id === "close-button" || event.target.classList.contains("cancel-button")) {
        modal.classList.remove("active");
    }
});

/*** Initialize First Form ***/
if (cardSections.length > 0) {
    activateSection(cardSections[0]);
}

/*** Section Activation ***/
function activateSection(targetCard) {
    if (!targetCard) return;

    // Remove 'active' class from all sections
    sidebarLinks.forEach(link => link.classList.remove("active"));
    cardLabels.forEach(label => label.classList.remove("active"));
    cardSections.forEach(card => card.classList.remove("active"));

    // Activate the target section
    document.querySelector(`.sidebar a[href="#${targetCard.id}"]`)?.classList.add("active");
    targetCard.querySelector(".card-label")?.classList.add("active");
    targetCard.classList.add("active");

    activeForm = targetCard; // Update active form

    const formStep = parseInt(targetCard.id.replace("card", ""));
    const formAction = targetCard.querySelector(".form-action");

    // Check if step is 4 or 5 and restrict if not due
    // if (formStep === 4 || formStep === 5) {
    //     let currentDate = new Date();
    //     let targetDate = formStep === 4 
    //         ? new Date(document.getElementById("d10_candling_date").value)
    //         : new Date(document.getElementById("d18_candling_date").value);

    //     if (currentDate < targetDate) {
    //         // Calculate days remaining safely
    //         let timeDiff = targetDate - currentDate;
    //         let daysRemaining = Math.max(0, Math.ceil(timeDiff / (1000 * 60 * 60 * 24)));
        
    //         // Notification title assignment
    //         let notificationTitle = formStep === 4 
    //             ? 'Setter Process Unavailable' 
    //             : 'Candling Process Unavailable';
        
    //         console.log(`Step ${formStep} is not due. Hiding form actions. ${daysRemaining} day(s) remaining.`);
    //         formAction.style.display = "none";
        
    //         // Trigger notification
    //         createPushNotification('danger', notificationTitle, `Step ${formStep} will be available in ${daysRemaining} day(s).`);
        
    //         return; // Exit early
    //     }
            
    // }

    // Show/hide form-action for active form
    document.querySelectorAll(".form-action").forEach(action => {
        action.style.display = targetCard.contains(action) ? "flex" : "none";
    });

    // Update event listeners
    updateFormListener();
}

/*** Form Handling ***/
function updateFormListener() {
    if (!activeForm) return;

    let formInputs = activeForm.querySelectorAll("input, select, textarea");
    let resetButtons = activeForm.querySelectorAll(".form-action .reset-btn");
    let formAction = activeForm.querySelector(".form-action");

    if (!formInputs.length || !formAction) return;

    let formStep = parseInt(activeForm.id.replace("card", ""));

    // Function to check if form has values
    function checkFormValues() {
        // // Check if step 4 or 5 is due
        // if (formStep === 4 || formStep === 5) {
        //     let currentDate = new Date();
        //     let targetDate = formStep === 4 
        //         ? new Date(document.getElementById("d10_candling_date").value)
        //         : new Date(document.getElementById("d18_candling_date").value);

        //     if (currentDate < targetDate) {
        //         console.log(`Form Step ${formStep} is not yet due. Hiding form actions.`);
        //         formAction.style.display = "none";
        //         return;
        //     }
        // }

        // Show form-action if inputs have values
        const hasValues = [...formInputs].some(input => {
            if (input.type === "checkbox" || input.type === "radio") {
                return input.checked;
            } else {
                return input.value.trim() !== "";
            }
        });

        // Show only if it's the current step or exceptions
        if (formStep === currentStep || formStep === 9) {
            formAction.style.display = hasValues ? "flex" : "none";
        } else {
            formAction.style.display = "none";
        }
    }

    // Update input and reset listeners
    formInputs.forEach(input => {
        input.oninput = checkFormValues;
        input.onchange = checkFormValues;
    });

    resetButtons.forEach(button => {
        button.onclick = function () {
            formInputs.forEach(input => {
                if (input.type === "checkbox" || input.type === "radio") {
                    input.checked = false;
                } else {
                    input.value = "";
                }
                input.style.border = "";
                let labelSpan = input.closest(".input-group")?.querySelector("label span");
                if (labelSpan) labelSpan.textContent = "";
            });
            formAction.style.display = "none";
        };
    });

    activeForm.onsubmit = function (event) {
        event.preventDefault();
        if (validateForm()) {
            showModal('save');
        }
    };

    checkFormValues(); // Initial check
}

/*** Form Validation ***/
function validateForm() {
    if (!activeForm) return false; // Ensure activeForm exists

    let isValid = true;

    // Define required fields per form ID
    let requiredFields = {
        "card1": ["ps_no", "collected_qty", "production_date_from", "production_date_to"],
        "card2": ["pullout_date", "settable_eggs_qty", "incubator_no", "prime_qty", "jp_qty"],
        "card3": ["d10_candling_date", "d10_breakout_qty", "d10_candling_qty"],
        "card4": ["d18_candling_date", "infertiles_qty"],
        "card5": ["hatcher_no", "hatcher_date", "rejected_hatch_qty"],
        "card6": ["cock_qty"],
        "card7": ["qc_date", "rejected_dop_qty"],
        "card8": ["dispatch_prime_qty"],
        "card10": ["infertile_prcnt", "frcst_cock_prcnt", "frcst_rejected_hatch_prcnt", "frcst_rejected_dop_prcnt"],
    };

    // Get fields for the currently active form
    let currentRequiredFields = requiredFields[activeForm.id] || [];

    currentRequiredFields.forEach(id => {
        let field = activeForm.querySelector(`#${id}`); // Select field inside active form only
        if (!field) return; // Skip if field is not found

        let labelSpan = field.closest(".input-group")?.querySelector("label span");

        if (!field.value.trim()) {
            field.style.border = "2px solid #ea4435d7";

            if (labelSpan) {
                labelSpan.textContent = "This field is required";
                labelSpan.style.color = "#ea4435d7";
            }

            isValid = false;
        } else {
            field.style.border = "";
            if (labelSpan) labelSpan.textContent = "";
        }
    });

    return isValid;
}

/*** Step Progression ***/
const skippableCards = ["card9"];
const alwaysEnabledCards = ["card9" , "card11"];
const allCards = document.querySelectorAll(".card");

function proceedToNextStep(savedCardNumber) {
    if (alwaysEnabledCards.includes(`card${savedCardNumber}`)) {
        console.log(`Saved always enabled card${savedCardNumber}, no step progression.`);
        return;
    }

    if (savedCardNumber !== currentStep) {
        console.log(`Warning: Saved card${savedCardNumber} but current step is ${currentStep}.`);
        return;
    }

    currentStep++;
    console.log("Current Step: ", currentStep);
    autoSkipStep();
    disableFutureForms();
    lockCompletedSteps(currentStep);
}

function autoSkipStep() {
    while (skippableCards.includes(`card${currentStep}`)) {
        currentStep++; 
    }
}

function disableFutureForms() {
    allCards.forEach(card => {
        let stepNumber = parseInt(card.id.replace("card", ""));

        if (alwaysEnabledCards.includes(card.id)) {
            enableCard(card);
        } else if (stepNumber > currentStep) {
            disableCard(card);
        } 
        // else if (stepNumber == 4) {
        //     let currentDate = new Date(); // Today's date
        //     let candlingDay10 = new Date(document.getElementById("d10_candling_date").value); // Clone date

        //     console.log("Current Date: ", currentDate); 
        //     console.log("Pullout Day 10: ", candlingDay10);

        //     if(currentDate >= candlingDay10){
        //         console.log("Current Date is greater than or equal to Candling Day 10");
        //         enableCard(card);
        //     } else {
        //         console.log("Current Date is less than Candling Day 10");
        //         disableCard(card);
        //     }
        // } else if (stepNumber == 5) {
        //     let currentDate = new Date(); // Today's date
        //     let candlingDay18 = new Date(document.getElementById("d18_candling_date").value); // Clone date
        
        //     console.log("Current Date: ", currentDate); 
        //     console.log("Candling Day 10: ", candlingDay18);

        //     if(currentDate >= candlingDay18){
        //         console.log("Current Date is greater than or equal to Candling Day 18");
        //         enableCard(card);
        //     } else {
        //         console.log("Current Date is less than Candling Day 18");
        //         disableCard(card);
        //     }
        // } 
        else{
            enableCard(card);
        }
    });
}

// ✅ Helper functions
function enableCard(card) {
    card.classList.remove("disabled");
    card.querySelectorAll("input, select, textarea").forEach(input => input.disabled = false);
}

function disableCard(card) {
    card.classList.add("disabled");
    card.querySelectorAll("input, select, textarea").forEach(input => input.disabled = true);
}


function lockCompletedSteps(currentStep) {
    document.querySelectorAll(".card").forEach(card => {
        let stepNumber = parseInt(card.id.replace("card", "")); // Extract step number

        let exemptSteps = [9]; // Skippable but needs its own condition

        if (stepNumber < currentStep && !exemptSteps.includes(stepNumber)) {
            // Disable all inputs inside the card
            card.querySelectorAll("input, select, textarea").forEach(input => {
                input.setAttribute("readonly", true);
                input.setAttribute("disabled", true); // For select dropdowns
            });

            // Hide the save button inside the card
            let saveButton = card.querySelector(".form-action");
            if (saveButton) saveButton.style.display = "none";

            // Change border color to gray to indicate completion
            card.style.borderColor = "gray";
        }
        
        // **Handle 10 based on existing data**
        // if (exemptSteps.includes(stepNumber)) {
        //     checkIfDataExists(batchNumber, stepNumber, card);
        // }
    });
}

/*** Initial Setup ***/
// autoSkipStep();
disableFutureForms();
lockCompletedSteps(currentStep);

function simulateFormSave() {
    if (!activeForm) return;

    let stepNumber = parseInt(activeForm.id.replace("card", ""));
    
    // Simulate saving
    console.log(`Current Step ${currentStep} Done. Form ${activeForm.id} saved! Proceeding to Step ${currentStep + 1}`);

    document.getElementById("modal").classList.remove("active");

    // Proceed to the next step **only if its Card 6 or 10**
    if (stepNumber !== 9) {
        proceedToNextStep();
    } else {
        // If it's not Card 9, disable it after saving
        lockCompletedSteps(currentStep);
    }
}


// function checkIfDataExists(batchNumber, stepNumber, card) {
//     let adjustedStep = stepNumber + 1;
//     fetch(`/master-database/data-check/${batchNumber}/${adjustedStep}`) // Adjust to your backend route
//         .then(response => response.json())
//         .then(data => {
//             if(card.id == "card6"){ //Only for card 6
//                 if (data.exists) {
//                     // Disable Card 6 or 10 if data is already saved
//                     card.querySelectorAll("input, select, textarea").forEach(input => {
//                         input.setAttribute("readonly", true);
//                         input.setAttribute("disabled", true);
//                     });

//                     // Hide the save button
//                     let saveButton = card.querySelector(".form-action");
//                     if (saveButton) saveButton.style.display = "none";

//                     // Change border color to gray
//                     card.style.borderColor = "gray";
//                 }                
//             }
//         })
//         .catch(error => console.error("Error checking data:", error));
// }

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
            // simulateFormSave();
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
                    <button type="button" class="confirm-button delete-btn">
                        Delete
                    </button>
                    <button type="button" class="cancel-button">Cancel</button>
                </div>
            </div>
        `;

        document.querySelector('.delete-btn').addEventListener('click', () => {
            deleteRecord(targetID);
        });

    } else if (button === "view") {
        viewRecord(targetID); //Target Batch 
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
                        <button type="button" class="confirm-button csv-btn" onclick="window.location.href='/master-database/csv'">
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
                        <button type="button" class="confirm-button report-btn" onclick="window.location.href='/master-database/report'">
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

const saveFunctions = {
    "card1": saveCollectedEggs,
    "card2": saveStoragePullout,
    "card3": saveSetterProcess,
    "card4": saveCandlingProcess,
    "card5": saveHatcherPullout,
    "card6": saveSexing,
    "card7": saveQCProcess,
    "card9": saveForecast,
    "card8": saveDispathProcess,
    "card10": saveForecastedBoxes,
}

function storeRecord(){
    if (!activeForm) return;
    let stepNumber = parseInt(activeForm.id.replace("card", ""));

    if (saveFunctions[activeForm.id]) {
        saveFunctions[activeForm.id]();
    }

    document.getElementById("modal").classList.remove("active");

    // Proceed to the next step **only if its Card 6 or 10**
    if ( stepNumber !== 9) {
        proceedToNextStep(currentStep);
    } else {
        // If it's not Card 6 or 10, disable it after saving
        lockCompletedSteps(currentStep);
    }
}

function viewRecord(targetBatch) {
    // First, encrypt the targetBatch just like in editRecord
    fetch(`/api/encrypt-id`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken
        },
        body: JSON.stringify({
            targetID: targetBatch
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.encrypted_id) {
            // Now that we have the encrypted ID, fetch the data
            loadingDisplayData(targetBatch); // (optional) you may want to move this to after encryption if needed
            
            fetch(`/master-database/view/${encodeURIComponent(data.encrypted_id)}`, {
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                displayRecord(data);
                console.log(data);
            })
            .catch(error => console.error("Error fetching record:", error));

        } else {
            console.error('Error encrypting ID for viewRecord');
        }
    })
    .catch(error => {
        console.error("Error encrypting ID:", error);
    });
}

function displayRecord(data){
    const dataDisplay = document.querySelector(".data-container");
    if(!dataDisplay) return;
    dataDisplay.innerHTML = ""; // Clear previous content
    dataDisplay.innerHTML =
    `<div class="card">
        <div class="card-label">
            <span>1</span>
            <p>Collected Eggs</p>
        </div>

        <div class="card-form col-4">
            <div class="input-group">
                <label for="ps_no">PS no.</label>
                <input type="text" name="ps_no" id="ps_no" value="${data[0].collected_eggs.ps_no}" readonly>
            </div>
            <div class="input-group">
                <label for="collected_qty">Collected Quantity</label>
                <input type="number" name="collected_qty" id="collected_qty" placeholder="0" value="${data[0].collected_eggs.collected_qty}" readonly>
            </div>
            <div class="input-group">
                <label for="production_date_from">Production Date (From)</label>
                <input type="date" name="production_date_from" id="production_date_from" value="${data[0].collected_eggs.production_date_from}" readonly>
            </div>
            <div class="input-group">
                <label for="production_date_to">Production Date (To)</label>
                <input type="date" name="production_date_to" id="production_date_to" value="${data[0].collected_eggs.production_date_to}" readonly>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-label">
            <span>2</span>
            <p>Storage Pullout Process</p>
        </div>

        <div class="card-form">

            <div class="input-group">
                <label for="incubator_no">Incubator No. </label>
                <input type="text" name="incubator_no" id="incubator_no" placeholder="0" value="${data[1] ? data[1].storage_pullout.incubator_no || '' : ''}" readonly>
            </div>

            <div class="input-group">
                <label for="settable_eggs_qty">Set. Egg Quantity </label>
                <input type="text" name="settable_eggs_qty" id="settable_eggs_qty" placeholder="0" value="${data[1] ? data[1].storage_pullout.settable_eggs_qty || '' : ''}" readonly>
            </div>

            <div class="input-group">
                <label for="pullout_date">Pullout Date </label>
                <input type="date" name="pullout_date" id="pullout_date" value="${data[1] ? data[1].storage_pullout.pullout_date || '' : ''}" readonly>
            </div>
            
            <br> 

            <div class="input-container">
                <div class="input-group">
                    <label for="prime_qty">Prime Quantity </label>
                    <input type="number" name="prime_qty" id="prime_qty" placeholder="0" value="${data[1] ? data[1].storage_pullout.prime_qty || '' : ''}" readonly>
                </div>   
                <div class="input-group prcnt">
                    <label for="prime_prcnt">%</label>
                    <input type="text" name="prime_prcnt" id="prime_prcnt" placeholder="0" value="${data[1] ? data[1].storage_pullout.prime_prcnt || '' : ''}" readonly>
                </div>                     
            </div>

            <div class="input-container">
                <div class="input-group">
                    <label for="jp_qty">JP Quantity </label>
                    <input type="number" name="jp_qty" id="jp_qty" placeholder="0" value="${data[1] ? data[1].storage_pullout.jp_qty || '' : ''}" readonly>
                </div>   
                <div class="input-group prcnt">
                    <label for="jp_prcnt">% </label>
                    <input type="text" name="jp_prcnt" id="jp_prcnt" placeholder="0" value="${data[1] ? data[1].storage_pullout.jp_prcnt || '' : ''}" readonly>
                </div>                     
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-label">
            <span>3</span>
            <p>10th Day Candling Process</p>
        </div>

        <div class="card-form">
            <div class="input-group">
                <label for="d10_breakout_qty">Day 10 Breakout Quantity </label>
                <input type="number" name="d10_breakout_qty" id="d10_breakout_qty" placeholder="0" value="${data[2] && data[2].setter_process ? data[2].setter_process.d10_breakout_qty || '' : ''}" readonly>
            </div>                 
            <div class="input-group">
                <label for="d10_candling_date">Day 10 Candling Date </label>
                <input type="date" name="d10_candling_date" id="d10_candling_date" value="${data[2] && data[2].setter_process ? data[2].setter_process.d10_candling_date || '' : ''}" readonly>
            </div>

            <p></p>
            <br>

            <div class="input-container">
                <div class="input-group">
                    <label for="d10_candling_qty">Day 10 Candling Quantity </label>
                    <input type="number" name="d10_candling_qty" id="d10_candling_qty" placeholder="0" value="${data[2] && data[2].setter_process ? data[2].setter_process.d10_candling_qty || '' : ''}" readonly>
                </div>   
                <div class="input-group prcnt">
                    <label for="d10_breakout_prcnt">%</label>
                    <input type="text" name="d10_breakout_prcnt" id="d10_breakout_prcnt" placeholder="0" value="${data[2] && data[2].setter_process ? data[2].setter_process.d10_breakout_prcnt || '' : ''}" readonly>
                </div>                     
            </div>
            <div class="input-group">
                <label for="d10_inc_qty">Day 10  Inc Quantity</label>
                <input type="text" name="d10_inc_qty" id="d10_inc_qty" placeholder="0" value="${data[2] && data[2].setter_process ? data[2].setter_process.d10_inc_qty || '' : ''}" readonly>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-label">
            <span>4</span>
            <p>18th Day Candling Process</p>
        </div>

        <div class="card-form">
            <div class="input-group">
                <label for="infertiles_qty">Infertiles Quantity</label>
                <input type="number" name="infertiles_qty" id="infertiles_qty" placeholder="0" value="${data[3] && data[3].candling_process ? data[3].candling_process.infertiles_qty || '' : ''}" readonly>
            </div> 
            <div class="input-group">
                <label for="embryonic_eggs_qty">Embryonic Eggs Quantity</label>
                <input type="text" name="embryonic_eggs_qty" id="embryonic_eggs_qty" placeholder="0" value="${data[3] && data[3].candling_process ? data[3].candling_process.embryonic_eggs_qty || '' : ''}" readonly>
            </div>                    
            <div class="input-group">
                <label for="d18_candling_date">Day 18.5 Candling Date</label>
                <input type="date" name="d18_candling_date" id="d18_candling_date" value="${data[3] && data[3].candling_process ? data[3].candling_process.d18_candling_date || '' : ''}" readonly>
            </div>

        </div>
    </div>

    <div class="card">
        <div class="card-label">
            <span>5</span>
            <p>Hatcher Pullout Process</p>
        </div>

        <div class="card-form">
            <div class="input-group">
                <label for="hatcher_no">Hatcher No</label>
                <input type="text" id="hatcher_no" name="hatcher_no" placeholder="0" value="${data[4] && data[4].hatcher_pullout ? data[4].hatcher_pullout.hatcher_no || '' : ''}" readonly>
            </div>
            <div class="input-group">
                <label for="rejected_hatch_qty">Rejected Hatch Qty</label>
                <input type="number" name="rejected_hatch_qty" id="rejected_hatch_qty" placeholder="0" value="${data[4] && data[4].hatcher_pullout ? data[4].hatcher_pullout.rejected_hatch_qty || '' : ''}" readonly>
            </div>
            <div class="input-group">
                <label for="accepted_hatch_qty">Good Hatch Qty</label>
                <input type="text" name="accepted_hatch_qty" id="accepted_hatch_qty" placeholder="0" value="${data[4] && data[4].hatcher_pullout ? data[4].hatcher_pullout.accepted_hatch_qty || '' : ''}" readonly>
            </div>
            <div class="input-group">
                <label for="hatcher_date">Hatcher Date</label>
                <input type="date" name="hatcher_date" id="hatcher_date" value="${data[4] && data[4].hatcher_pullout ? data[4].hatcher_pullout.hatcher_date || '' : ''}" readonly>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-label">
            <span>6</span>
            <p>Sexing</p>
        </div>

        <div class="card-form">
            <div class="input-group">
                <label for="cock_qty">Cockerels Quantity</label>
                <input type="number" name="cock_qty" id="cock_qty" placeholder="0" value="${data[5] && data[5].sexing ? data[5].sexing.cock_qty || '' : ''}" readonly>
            </div>
            <div class="input-group">
                <label for="dop_qty">DOP Quantity</label>
                <input type="text" name="dop_qty" id="dop_qty" placeholder="0" value="${data[5] && data[5].sexing ? data[5].sexing.dop_qty || '' : ''}" readonly>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-label">
            <span>7</span>
            <p>QC/QA Process Entry</p>
        </div>

        <div class="card-form">
            <div class="input-group">
                <label for="rejected_dop_qty">Rejected DOP Qty</label>
                <input type="number" name="rejected_dop_qty" id="rejected_dop_qty" placeholder="0" value="${data[6] && data[6].qc_qa_process ? data[6].qc_qa_process.rejected_dop_qty || '' : ''}" readonly>
            </div>
            
            <div class="input-group">
                <label for="accepted_dop_qty">Good DOP Qty</label>
                <input type="text" name="accepted_dop_qty" id="accepted_dop_qty" placeholder="0" value="${data[6] && data[6].qc_qa_process ? data[6].qc_qa_process.accepted_dop_qty || '' : ''}" readonly>
            </div>
            <div class="input-group">
                <label for="qc_date">QC Date</label>
                <input type="date" name="qc_date" id="qc_date" value="${data[6] && data[6].qc_qa_process ? data[6].qc_qa_process.qc_date || '' : ''}" readonly>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-label">
            <span>8</span>
            <p>Dispath Process Entry</p>
        </div>

        <div class="card-form">
            <div class="input-group">
                <label for="dispatch_prime_qty">Prime Qty</label>
                <input type="number" name="dispatch_prime_qty" id="dispatch_prime_qty" placeholder="0" value="${data[8] && data[8].dispath_process ? data[8].dispath_process.dispatch_prime_qty || '' : ''}" readonly>
            </div>
            <div class="input-group">
                <label for="dispatch_jr_prime_qty">Jr Prime Qty</label>
                <input type="number" name="dispatch_jr_prime_qty" id="dispatch_jr_prime_qty" placeholder="0" value="${data[8] && data[8].dispath_process ? data[8].dispath_process.dispatch_jr_prime_qty || '' : ''}" readonly>
            </div>
            <div class="input-group">
                <label for="total_boxes">Total Boxes</label>
                <input type="number" name="total_boxes" id="total_boxes" placeholder="0" value="${data.length > 0 && data[data.length - 1].frcst_box ? data[data.length - 1].frcst_box.total_boxes || '' : ''}" readonly>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-label">
            <span><i class="fa-solid fa-clipboard-list"></i></span>
            <p>Forcasted Base on Last Hatch</p>
        </div>

        <div class="card-form">
            <div class="input-container">
                <div class="input-group">
                    <label for="infertile_qty">Infertile Qty</label>
                    <input type="number" name="infertile_qty" id="infertile_qty" placeholder="0" value="${data[7] && data[7].forecast ? data[7].forecast.infertile_qty || '' : ''}" readonly>
                </div>
                
                <div class="input-group prcnt">
                    <label for="infertile_prcnt">% <span></span></label>
                    <input type="number" name="infertile_prcnt" id="infertile_prcnt" placeholder="0" value="${data[7] && data[7].forecast ? data[7].forecast.infertile_prcnt || '' : ''}" readonly>
                </div>
            </div>
            <div class="input-container">
                <div class="input-group">
                    <label for="frcst_cock_qty">Cock Qty</label>
                    <input type="number" name="frcst_cock_qty" id="frcst_cock_qty" placeholder="0" value="${data[7] && data[7].forecast ? data[7].forecast.frcst_cock_qty || '' : ''}" readonly>
                </div>
                
                <div class="input-group prcnt">
                    <label for="frcst_cock_prcnt">% <span></span></label>
                    <input type="number" name="frcst_cock_prcnt" id="frcst_cock_prcnt" placeholder="0" value="${data[7] && data[7].forecast ? data[7].forecast.frcst_cock_prcnt || '' : ''}" readonly>
                </div>
            </div>
            <div class="input-container">
                <div class="input-group">
                    <label for="frcst_rejected_hatch_qty">Rejected Hatch Qty</label>
                    <input type="number" name="frcst_rejected_hatch_qty" id="frcst_rejected_hatch_qty" placeholder="0" value="${data[7] && data[7].forecast ? data[7].forecast.frcst_rejected_hatch_qty || '' : ''}" readonly>
                </div>
                
                <div class="input-group prcnt">
                    <label for="frcst_rejected_hatch_prcnt">% <span></span></label>
                    <input type="number" name="frcst_rejected_hatch_prcnt" id="frcst_rejected_hatch_prcnt" placeholder="0" value="${data[7] && data[7].forecast ? data[7].forecast.frcst_rejected_hatch_prcnt || '' : ''}" readonly>
                </div>
            </div>
            <div class="input-container">
                <div class="input-group">
                    <label for="frcst_rejected_dop_qty">Rejected DOP Qty</label>
                    <input type="number" name="frcst_rejected_dop_qty" id="frcst_rejected_dop_qty" placeholder="0" value="${data[7] && data[7].forecast ? data[7].forecast.frcst_rejected_dop_qty || '' : ''}" readonly>
                </div>
                
                <div class="input-group prcnt">
                    <label for="frcst_rejected_dop_prcnt">% <span></span></label>
                    <input type="number" name="frcst_rejected_dop_prcnt" id="frcst_rejected_dop_prcnt" placeholder="0" value="${data[7] && data[7].forecast ? data[7].forecast.frcst_rejected_dop_prcnt || '' : ''}" readonly>
                </div>
            </div>

            <div class="input-group">
                <label for="forecast_total_qty">Total Qty</label>
                <input type="number" name="forecast_total_qty" id="forecast_total_qty" placeholder="0" value="${data[7] && data[7].forecast ? data[7].forecast.forecast_total_qty || '' : ''}" readonly>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-label">
            <span><i class="fa-solid fa-box"></i></span>
            <p>Forcasted number of boxes</p>
        </div>

        <div class="card-form">
            <div class="input-group">
                <label for="frcst_total_boxes">Total</label>
                <input type="text" name="frcst_total_boxes" id="frcst_total_boxes" placeholder="0" value="${data[7] && data[7].forecast ? data[7].forecast.frcst_total_boxes || '' : ''}" readonly>
            </div>
            <div class="input-group">
                <label for="frcst_settable_eggs_prcnt">%</label>
                <input type="text" name="frcst_settable_eggs_prcnt" id="frcst_settable_eggs_prcnt" placeholder="0" value="${data[7] && data[7].forecast ? data[7].forecast.frcst_settable_eggs_prcnt || '' : ''}" readonly>
            </div>
            <div class="input-group">
                <label for="frcst_prime">Prime</label>
                <input type="text" name="frcst_prime" id="frcst_prime" placeholder="0" value="${data[7] && data[7].forecast ? data[7].forecast.frcst_prime || '' : ''}" readonly>
            </div>
            <div class="input-group">
                <label for="frcst_jr_prime">Junior Prime</label>
                <input type="text" name="frcst_jr_prime" id="frcst_jr_prime" placeholder="0" value="${data[7] && data[7].forecast ? data[7].forecast.frcst_jr_prime || '' : ''}" readonly>
            </div>
        </div>
    </div>`;
}

function deleteRecord(targetBatch) {
    fetch(`/master-database/delete/${targetBatch}`, {
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
            loadData();

            // Trigger push notification
            createPushNotification("success", "Deleted Successfully", "Master Database Record Deleted Successfully");
        } else {
            createPushNotification("danger", "Delete Unsuccessful", "Record not found");
        }
    })
    .catch(error =>{
        createPushNotification("danger", "Delete Unsuccessful", "Please try again or contact support if the issue persists");
        console.error("Error:", error)
    });
}

function saveData(url, data, successMessage = null) {
    let adjustedStep = currentStep;

    // 🔹 If forecast exists, force step to 10
    if (data.hasOwnProperty("forecast")) {
        adjustedStep = 10;
    } 
    else if (data.hasOwnProperty("frcst_box")) {
        adjustedStep = 11;
    }

    // 🔹 Fix specific step jumps
    // else if (activeForm.id === "card6") {
    //     adjustedStep = 7;
    // } 

    else if (activeForm.id === "card9") {
        adjustedStep = 10;
    } 
    // 🔹 First-time save always starts at Step 2
    else if (currentStep === 1) {
        adjustedStep = 2;
    } 
    // 🔹 Normal case: Move to next step
    else {
        adjustedStep = currentStep + 1;
    }

    return fetch(url, {  // ✅ Return the fetch Promise here
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken
        },
        body: JSON.stringify({
            batch_no: batchNumber,
            current_step: adjustedStep,
            process_data: data,
        })
    })
    .then(response => response.json())
    .then(responseData => {
        if (responseData.success) {
            if(successMessage){
                createPushNotification("success", "Saved Successfully", successMessage);
            }
            //Refresh Table
            loadData();
        } else {
            createPushNotification("error", "Save Failed", "Error saving record.");
        }
    })
    .catch(error => {
        console.error("Error:", error);
        createPushNotification("error", "Save Failed", "An error occurred while saving.");
    });
}

function saveCollectedEggs() {
    let data = {
        collected_eggs: {
            ps_no: document.getElementById("ps_no").value,
            collected_qty: document.getElementById("collected_qty").value,
            production_date_from: document.getElementById("production_date_from").value,
            production_date_to: document.getElementById("production_date_to").value,                        
        }
    };
    saveData("/master-database/store", data, "Collected Eggs Entry Saved Successfully");
}

function saveStoragePullout() {
    
    let incubatornoValues = Array.from(document.getElementById('incubator_no').selectedOptions)
    .map(option => option.value);

    let data = {
        storage_pullout: {
            pullout_date: document.getElementById("pullout_date").value, // Original pullout date from input
            pullout_date_d10: document.getElementById("d10_candling_date").value, // +10 Days
            pullout_date_d18: document.getElementById("d18_candling_date").value, // +8.5 Days
            pullout_date_d21: document.getElementById("hatcher_date").value, // +3 Days

            settable_eggs_qty: document.getElementById("settable_eggs_qty").value,
            incubator_no: incubatornoValues,
            prime_qty: document.getElementById("prime_qty").value,
            prime_prcnt: document.getElementById("prime_prcnt").value,
            jp_qty: document.getElementById("jp_qty").value,
            jp_prcnt: document.getElementById("jp_prcnt").value
        }
    };

    saveData("/master-database/store", data, "Storage Pullout Process Entry Saved Successfully")
        .then(() => {
            // If saving Step 3, save Forecast and Forecasted boxes
            updateExistingFRCST();
        });
}

function saveSetterProcess() {
    let data = { 
        setter_process: {
            d10_candling_date: document.getElementById("d10_candling_date").value,                        
            d10_candling_qty: document.getElementById("d10_candling_qty").value,
            d10_breakout_qty: document.getElementById("d10_breakout_qty").value,
            d10_breakout_prcnt: document.getElementById("d10_breakout_prcnt").value,
            d10_inc_qty: document.getElementById("d10_inc_qty").value,
        }
    }
    saveData("/master-database/store", data, "Setter Process Entry Saved Successfully")
        .then(() => {
            saveForecastedBoxes();
        });
}

function saveCandlingProcess() {
    let data = {
        candling_process: {
            d18_candling_date: document.getElementById("d18_candling_date").value,
            infertiles_qty: document.getElementById("infertiles_qty").value,
            embryonic_eggs_qty: document.getElementById("embryonic_eggs_qty").value,
        }
    }
    saveData("/master-database/store", data, "Candling Process Entry Saved Successfully")
        .then(() => {
            saveForecastedBoxes();
        });
}

function saveHatcherPullout(){
    let hatchernoValues = Array.from(document.getElementById('hatcher_no').selectedOptions)
    .map(option => option.value);

    let data = {
        hatcher_pullout: {
            hatcher_no: hatchernoValues,
            hatcher_date: document.getElementById("hatcher_date").value,
            rejected_hatch_qty: document.getElementById("rejected_hatch_qty").value,
            accepted_hatch_qty: document.getElementById("accepted_hatch_qty").value,
        }
    }
    saveData("/master-database/store", data, "Hatcher Pullout Entry Saved Successfully")
        .then(() => {
            saveForecastedBoxes();
        });
}

function saveSexing(){
    let data = {
        sexing: {
            cock_qty: document.getElementById("cock_qty").value,
            dop_qty: document.getElementById("dop_qty").value,
        }
    }
    saveData("/master-database/store", data, "Sexing Entry Saved Successfully")
        .then(() => {
            saveForecastedBoxes();
        });
}

function saveQCProcess(){
    let data = {
        qc_qa_process: {
            qc_date: document.getElementById("qc_date").value,
            rejected_dop_qty: document.getElementById("rejected_dop_qty").value,
            accepted_dop_qty: document.getElementById("accepted_dop_qty").value,
        }
    }
    saveData("/master-database/store", data, "QC/QA Process Entry Saved Successfully")
        .then(() => {
            saveForecastedBoxes();
        });
}

function saveForecast(){
    let data = {
        forecast: {
            infertile_qty: document.getElementById("infertile_qty").value,
            infertile_prcnt: document.getElementById("infertile_prcnt").value,

            frcst_cock_qty: document.getElementById("frcst_cock_qty").value,
            frcst_cock_prcnt: document.getElementById("frcst_cock_prcnt").value,

            frcst_rejected_hatch_qty: document.getElementById("frcst_rejected_hatch_qty").value,
            frcst_rejected_hatch_prcnt: document.getElementById("frcst_rejected_hatch_prcnt").value,

            frcst_rejected_dop_qty: document.getElementById("frcst_rejected_dop_qty").value,
            frcst_rejected_dop_prcnt: document.getElementById("frcst_rejected_dop_prcnt").value,

            forecast_total_qty: document.getElementById("forecast_total_qty").value,

            //
            frcst_total_boxes: document.getElementById("frcst_total_boxes").value,
            frcst_settable_eggs_prcnt: document.getElementById("frcst_settable_eggs_prcnt").value,

            frcst_prime: document.getElementById("frcst_prime").value,
            frcst_jr_prime: document.getElementById("frcst_jr_prime").value,
        }
    }
    saveData("/master-database/store", data, "Forecast Entry Saved Successfully");
}

function saveDispathProcess(){
    let data = {
        dispath_process: {
            dispatch_prime_qty: document.getElementById("dispatch_prime_qty").value,
            dispatch_jr_prime_qty: document.getElementById("dispatch_jr_prime_qty").value,
        }
    }
    saveData("/master-database/store", data, "Dispath Process Entry Saved Successfully");
}

function saveForecastedBoxes(){
    let totalBoxesElement = document.getElementById("total_boxes");
    let totalBoxes = Number(totalBoxesElement.innerText.replace(/\D/g, ''));

    if (isNaN(totalBoxes)) {
        alert("Error: Total boxes is not a valid number.");
        return;
    }

    let data = {
        frcst_box: { total_boxes: totalBoxes }
    };
    
    saveData("/master-database/store", data);
}

function updateExistingFRCST(){
    let data = {
        forecast: {
            infertile_qty: document.getElementById("infertile_qty").value,
            infertile_prcnt: document.getElementById("infertile_prcnt").value,

            frcst_cock_qty: document.getElementById("frcst_cock_qty").value,
            frcst_cock_prcnt: document.getElementById("frcst_cock_prcnt").value,

            frcst_rejected_hatch_qty: document.getElementById("frcst_rejected_hatch_qty").value,
            frcst_rejected_hatch_prcnt: document.getElementById("frcst_rejected_hatch_prcnt").value,

            frcst_rejected_dop_qty: document.getElementById("frcst_rejected_dop_qty").value,
            frcst_rejected_dop_prcnt: document.getElementById("frcst_rejected_dop_prcnt").value,

            forecast_total_qty: document.getElementById("forecast_total_qty").value,

            //
            frcst_total_boxes: document.getElementById("frcst_total_boxes").value,
            frcst_settable_eggs_prcnt: document.getElementById("frcst_settable_eggs_prcnt").value,

            frcst_prime: document.getElementById("frcst_prime").value,
            frcst_jr_prime: document.getElementById("frcst_jr_prime").value,
        }
    }
    saveData("/master-database/store", data)
    .then(() => {
        saveForecastedBoxes();
    });;
}