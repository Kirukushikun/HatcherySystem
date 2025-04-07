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

let collectedEggs = {
    ps_no: document.getElementById('ps_no'),
    collected_qty: document.getElementById('collected_qty'),
    production_date_from: document.getElementById('production_date_from'),
    production_date_to: document.getElementById('production_date_to')
};

let classificationStorage = {
    non_settable_eggs: document.getElementById('non_settable_eggs'),
    settable_eggs: document.getElementById('settable_eggs'),
    remaining_balance: document.getElementById('remaining_balance')
};

let pulloutStorage = {
    pullout_date: document.getElementById('pullout_date'),
    settable_eggs_qty: document.getElementById('settable_eggs_qty'),
    incubator_no: document.getElementById('incubator_no'),
    prime_qty: document.getElementById('prime_qty'),
    prime_prcnt: document.getElementById('prime_prcnt'),
    jp_qty: document.getElementById('jp_qty'),
    jp_prcnt: document.getElementById('jp_prcnt')
};

let setterProcess = {
    d10_candling_date: document.getElementById('d10_candling_date'),
    d10_candling_qty: document.getElementById('d10_candling_qty'),
    d10_breakout_qty: document.getElementById('d10_breakout_qty'),
    d10_breakout_prcnt: document.getElementById('d10_breakout_prcnt'),
    d10_inc_qty: document.getElementById('d10_inc_qty'),
};

const hatcherProcess = {
    hatcher_no: document.getElementById('hatcher_no'),
    hatcher_date: document.getElementById('hatcher_date'),
    rejected_hatch_qty: document.getElementById('rejected_hatch_qty'),
    accepted_hatch_qty: document.getElementById('accepted_hatch_qty')
};


// Form 1
collectedEggs.collected_qty.addEventListener('input', () => {
    let collectedQty = Number(collectedEggs.collected_qty.value) || 0;

    classificationStorage.settable_eggs.value = collectedQty;
    classificationStorage.remaining_balance.value = collectedQty;
});

// Form 2
classificationStorage.non_settable_eggs.addEventListener('input', () => {
    classificationStorage.non_settable_eggs.value = Math.min(
        classificationStorage.non_settable_eggs.value, 
        collectedEggs.collected_qty.value
    );
    
    classificationStorage.settable_eggs.value = collectedEggs.collected_qty.value - classificationStorage.non_settable_eggs.value;
    classificationStorage.remaining_balance.value = classificationStorage.settable_eggs.value;
});

// Pullout Quantity function to update remaining balance
pulloutStorage.settable_eggs_qty.addEventListener('input', () => {
    let settableEggs = Number(classificationStorage.settable_eggs.value) || 0;
    
    // Ensure pulloutQty does not exceed settableEggs
    pulloutStorage.settable_eggs_qty.value = Math.min(
        Number(pulloutStorage.settable_eggs_qty.value) || 0, 
        settableEggs
    );

    let pulloutQty = Number(pulloutStorage.settable_eggs_qty.value) || 0;

    classificationStorage.remaining_balance.value = Math.max(0, settableEggs - pulloutQty);
    setterProcess.d10_inc_qty.value = pulloutQty;

    if (pulloutStorage.prime_qty.value && pulloutStorage.jp_qty.value) {
        pulloutStorage.prime_qty.value = "";
        pulloutStorage.jp_qty.value = "";
        pulloutStorage.prime_prcnt.value = "";
        pulloutStorage.jp_prcnt.value = "";
    }

    calculateBoxes(pulloutQty);
    calculateFrcstBoxes(pulloutQty);
});

pulloutStorage.prime_qty.addEventListener('input', () => updatePullout('prime'));
pulloutStorage.jp_qty.addEventListener('input', () => updatePullout('jp'));

function updatePullout(source) {
    let settableEggs = Number(pulloutStorage.settable_eggs_qty.value) || 0;
    let primeQty = Number(pulloutStorage.prime_qty.value) || 0;
    let jpQty = Number(pulloutStorage.jp_qty.value) || 0;

    if (source === 'prime') {
        // Make sure prime does not exceed settableEggs
        primeQty = Math.min(primeQty, settableEggs);
        pulloutStorage.prime_qty.value = primeQty;

        // Adjust JP accordingly
        jpQty = settableEggs - primeQty;
        pulloutStorage.jp_qty.value = jpQty;
    } else if (source === 'jp') {
        // Make sure JP does not exceed settableEggs
        jpQty = Math.min(jpQty, settableEggs);
        pulloutStorage.jp_qty.value = jpQty;

        // Adjust Prime accordingly
        primeQty = settableEggs - jpQty;
        pulloutStorage.prime_qty.value = primeQty;
    }

    // Update percentages
    updatePercentages(settableEggs, primeQty, jpQty);

    // Other calculations
    calculatePJPBoxes(settableEggs, primeQty, jpQty);
}

// ✅ Helper function for percentage updates
function updatePercentages(settableEggs, primeQty, jpQty) {
    pulloutStorage.prime_prcnt.value = settableEggs > 0 ? Math.round((primeQty / settableEggs) * 100) : 0;
    pulloutStorage.jp_prcnt.value = settableEggs > 0 ? Math.round((jpQty / settableEggs) * 100) : 0;
}

setterProcess.d10_breakout_qty.addEventListener('input', () => {
    setterProcess.d10_breakout_qty.value = Math.min(
        Number(setterProcess.d10_breakout_qty.value) || 0, 
        Number(pulloutStorage.settable_eggs_qty.value)
    );

    setterProcess.d10_candling_qty.value = '';
    setterProcess.d10_breakout_prcnt.value = '';
    setterProcess.d10_inc_qty.value = Number(pulloutStorage.settable_eggs_qty.value);
})


setterProcess.d10_candling_qty.addEventListener('input', updateSetterProcess); // Update d10_inc

function updateSetterProcess() {
    let settableEggs = Number(pulloutStorage.settable_eggs_qty.value) || 0;
    let breakoutQty = Number(setterProcess.d10_breakout_qty.value) || 0;
    let candlingQty = Number(setterProcess.d10_candling_qty.value) || 0;

    // 🔹 Make sure Candling Qty does not exceed Breakout Qty
    candlingQty = Math.min(candlingQty, breakoutQty);
    setterProcess.d10_candling_qty.value = candlingQty;

    // 🔹 Update percentage
    setterProcess.d10_breakout_prcnt.value = breakoutQty > 0 ? Math.round((candlingQty / breakoutQty) * 100) : 0;

    // 🔹 Ensure Incubation Qty does not go negative
    setterProcess.d10_inc_qty.value = Math.max(0, settableEggs - candlingQty);

    calculateBoxes(setterProcess.d10_inc_qty.value);
}


let candlingProcess = {
    d18_candling_date: document.getElementById('d18_candling_date'),
    infertiles_qty: document.getElementById('infertiles_qty'),
    embryonic_eggs_qty: document.getElementById('embryonic_eggs_qty')
}

pulloutStorage.pullout_date.addEventListener('input', () => {
    let pulloutDate = new Date(pulloutStorage.pullout_date.value); // Get pullout date
    
    // Calculate Day 10 Candling Date
    let pulloutDay10 = new Date(pulloutDate); // Clone date
    pulloutDay10.setDate(pulloutDay10.getDate() + 10); // Add 10 days

    // Calculate Day 18.5 Candling Date
    let pulloutDay18_5 = new Date(pulloutDate); // Clone date
    pulloutDay18_5.setDate(pulloutDay18_5.getDate() + 18); // Add 18 full days
    pulloutDay18_5.setHours(pulloutDay18_5.getHours() + 12); // Add 12 hours (0.5 day)

    // Calculate Day 21 Candling Date
    let pulloutDay21 = new Date(pulloutDate); // Clone date
    pulloutDay21.setDate(pulloutDay21.getDate() + 21); // Add 21 days
    

    // Format for input field (only date part)
    setterProcess.d10_candling_date.value = pulloutDay10.toISOString().split('T')[0]; // Format YYYY-MM-DD
    candlingProcess.d18_candling_date.value = pulloutDay18_5.toISOString().split('T')[0]; 
    hatcherProcess.hatcher_date.value = pulloutDay21.toISOString().split('T')[0]; // Format YYYY-MM-DD
});

candlingProcess.infertiles_qty.addEventListener('input', updateCandlingProcess);

function updateCandlingProcess() {
    let incubationQty = Number(setterProcess.d10_inc_qty.value) || 0;
    let infertilesQty = Number(candlingProcess.infertiles_qty.value) || 0;

    // 🔹 Ensure Infertiles Qty does not exceed Incubation Qty
    infertilesQty = Math.min(infertilesQty, incubationQty);
    candlingProcess.infertiles_qty.value = infertilesQty;

    // 🔹 Calculate Embryonic Eggs Qty (Non-negative)
    let embryonicEggsQty = Math.max(0, incubationQty - infertilesQty);
    candlingProcess.embryonic_eggs_qty.value = embryonicEggsQty;

    calculateBoxes(embryonicEggsQty);
}

hatcherProcess.rejected_hatch_qty.addEventListener('input', updateHatcherProcess);

function updateHatcherProcess() {
    let embryonicEggsQty = Number(candlingProcess.embryonic_eggs_qty.value) || 0;
    let rejectedHatchQty = Number(hatcherProcess.rejected_hatch_qty.value) || 0;

    // 🔹 Ensure Rejected Hatch Qty does not exceed Embryonic Eggs Qty
    rejectedHatchQty = Math.min(rejectedHatchQty, embryonicEggsQty);
    hatcherProcess.rejected_hatch_qty.value = rejectedHatchQty;

    // 🔹 Calculate Accepted Hatch Qty (Non-negative)
    let acceptedHatchQty = Math.max(0, embryonicEggsQty - rejectedHatchQty);
    hatcherProcess.accepted_hatch_qty.value = acceptedHatchQty;

    calculateBoxes(acceptedHatchQty);
}

const sexingProcess = {
    cock_qty: document.getElementById('cock_qty'),
    dop_qty: document.getElementById('dop_qty')
};

sexingProcess.cock_qty.addEventListener('input', updateSexingProcess);

function updateSexingProcess() {
    let acceptedHatchQty = Number(hatcherProcess.accepted_hatch_qty.value) || 0;
    let cockQty = Number(sexingProcess.cock_qty.value) || 0;

    // 🔹 Ensure Cock Qty does not exceed Accepted Hatch Qty
    cockQty = Math.min(cockQty, acceptedHatchQty);
    sexingProcess.cock_qty.value = cockQty;

    // 🔹 Calculate DOP Qty (Non-negative)
    let dopQty = Math.max(0, acceptedHatchQty - cockQty);
    sexingProcess.dop_qty.value = dopQty;

    calculateBoxes(dopQty);
}

const qualityControl = {
    qc_date: document.getElementById('qc_date'),
    rejected_dop_qty: document.getElementById('rejected_dop_qty'),
    accepted_dop_qty: document.getElementById('accepted_dop_qty')
};

qualityControl.rejected_dop_qty.addEventListener('input', updateQualityControl);

function updateQualityControl() {
    let dopQty = Number(sexingProcess.dop_qty.value) || 0;
    let rejectedDopQty = Number(qualityControl.rejected_dop_qty.value) || 0;

    // 🔹 Ensure Rejected DOP Qty does not exceed DOP Qty
    rejectedDopQty = Math.min(rejectedDopQty, dopQty);
    qualityControl.rejected_dop_qty.value = rejectedDopQty;

    // 🔹 Calculate Accepted DOP Qty (Non-negative)
    let acceptedDopQty = Math.max(0, dopQty - rejectedDopQty);
    qualityControl.accepted_dop_qty.value = acceptedDopQty;

    calculateBoxes(acceptedDopQty);
}


const dispatchProcess = {
    dispatch_prime_qty: document.getElementById('dispatch_prime_qty'),
    dispatch_jr_prime_qty: document.getElementById('dispatch_jr_prime_qty')
};

dispatchProcess.dispatch_prime_qty.addEventListener('input', updateDispatchProcess);
dispatchProcess.dispatch_jr_prime_qty.addEventListener('input', updateDispatchByJP); // 🟢 New event listener

function updateDispatchProcess() {
    let goodDOPQty = Number(qualityControl.accepted_dop_qty.value) || 0;
    let primeQty = Number(dispatchProcess.dispatch_prime_qty.value) || 0;

    // 🔹 Ensure Prime Qty does not exceed Good DOP Qty
    primeQty = Math.min(primeQty, goodDOPQty);
    dispatchProcess.dispatch_prime_qty.value = primeQty;

    // 🔹 Auto-adjust Jr. Prime Qty
    let jpQty = Math.max(0, goodDOPQty - primeQty);
    dispatchProcess.dispatch_jr_prime_qty.value = jpQty;
}

// 🟢 New function: Updates Prime Qty when JP Qty changes
function updateDispatchByJP() {
    let goodDOPQty = Number(qualityControl.accepted_dop_qty.value) || 0;
    let jpQty = Number(dispatchProcess.dispatch_jr_prime_qty.value) || 0;

    // 🔹 Ensure Jr. Prime Qty does not exceed Good DOP Qty
    jpQty = Math.min(jpQty, goodDOPQty);
    dispatchProcess.dispatch_jr_prime_qty.value = jpQty;

    // 🔹 Auto-adjust Prime Qty
    let primeQty = Math.max(0, goodDOPQty - jpQty);
    dispatchProcess.dispatch_prime_qty.value = primeQty;
}

let BaseForecast = {
    infertile_qty: document.getElementById('infertile_qty'),
    infertile_prcnt: document.getElementById('infertile_prcnt'),

    frcst_cock_qty: document.getElementById('frcst_cock_qty'),
    frcst_cock_prcnt: document.getElementById('frcst_cock_prcnt'),

    frcst_rejected_hatch_qty: document.getElementById('frcst_rejected_hatch_qty'),
    frcst_rejected_hatch_prcnt: document.getElementById('frcst_rejected_hatch_prcnt'),

    frcst_rejected_dop_qty: document.getElementById('frcst_rejected_dop_qty'),
    frcst_rejected_dop_prcnt: document.getElementById('frcst_rejected_dop_prcnt'),

    forecast_total_qty: document.getElementById('forecast_total_qty'),

    frcst_total_boxes: document.getElementById('frcst_total_boxes'),
    frcst_settable_eggs_prcnt: document.getElementById('frcst_settable_eggs_prcnt'),
    
    frcst_prime: document.getElementById('frcst_prime'),
    frcst_jr_prime: document.getElementById('frcst_jr_prime')
};

// 🟢 Automatically Attach Event Listeners to All `_prcnt` Fields
Object.keys(BaseForecast).forEach(key => {
    if (key.includes('_prcnt')) {
        BaseForecast[key].addEventListener('input', updateForecastQuantity);
    }
});

// 🟢 General Function to Calculate Quantity from Percentage
function updateForecastQuantity(event) {
    let pulloutQty = Number(pulloutStorage.settable_eggs_qty.value) || 0; // Base quantity
    let targetPercentField = event.target;
    let targetQtyField = BaseForecast[targetPercentField.id.replace('_prcnt', '_qty')]; // Map % field to qty field

    if (targetQtyField) {
        let percentage = Number(targetPercentField.value) || 0;
        targetQtyField.value = Math.round((percentage / 100) * pulloutQty) || 0;
    }

    updateForcastPercentage();
}

function updateForcastPercentage() {
    let infertileQty = Number(BaseForecast.infertile_qty.value) || 0;
    let frcstCockQty = Number(BaseForecast.frcst_cock_qty.value) || 0;
    let frcstRejectedHatchQty = Number(BaseForecast.frcst_rejected_hatch_qty.value) || 0;
    let frcstRejectedDopQty = Number(BaseForecast.frcst_rejected_dop_qty.value) || 0;

    let totalForecast = infertileQty + frcstCockQty + frcstRejectedHatchQty + frcstRejectedDopQty;
    BaseForecast.forecast_total_qty.value = totalForecast || 0;

    let totalSettable = (Number(pulloutStorage.settable_eggs_qty.value) || 0) - totalForecast;
    totalSettable = Math.max(totalSettable, 0); // Prevent negative values

    calculateFrcstBoxes(totalSettable);

    calculatePJPBoxes(
        Number(pulloutStorage.settable_eggs_qty.value) || 0,
        Number(pulloutStorage.prime_qty.value) || 0,
        Number(pulloutStorage.jp_qty.value) || 0,
        totalForecast
    );
}

function calculateBoxes(settableEggs, eggsPerBox = 104) {
    document.getElementById('total_boxes').innerText = Math.floor((Number(settableEggs) || 0) / eggsPerBox) || 0;
}

function calculateFrcstBoxes(totalSettable) {
    let eggsPerBox = 104;
    BaseForecast.frcst_total_boxes.value = Math.floor(totalSettable / eggsPerBox) || 0;

    let totalEggs = Number(pulloutStorage.settable_eggs_qty.value) || 0;
    BaseForecast.frcst_settable_eggs_prcnt.value = totalEggs > 0 ? Math.round((totalSettable / totalEggs) * 100) : 0;
}

function calculatePJPBoxes(settableEggs, primeQty, jpQty, additionalDeduction = 0) {
    settableEggs = Number(settableEggs) || 0;
    primeQty = Number(primeQty) || 0;
    jpQty = Number(jpQty) || 0;
    additionalDeduction = Number(additionalDeduction) || 0;

    if (settableEggs <= 0) {
        BaseForecast.frcst_prime.value = 0;
        BaseForecast.frcst_jr_prime.value = 0;
        return;
    }

    let eggsPerBox = 104;
    let usableEggs = Math.max(settableEggs - additionalDeduction, 0); // Prevent negative usable eggs
    let totalBoxes = Math.floor(usableEggs / eggsPerBox) || 0;

    let primePercentage = (settableEggs > 0) ? (primeQty / settableEggs) * 100 : 0;
    let primeBoxes = Math.floor(totalBoxes * (primePercentage / 100)) || 0;
    let jpBoxes = totalBoxes - primeBoxes; // Remaining goes to JP

    BaseForecast.frcst_prime.value = primeBoxes;
    BaseForecast.frcst_jr_prime.value = Math.max(jpBoxes, 0); // Ensure no negative values
}


let temperatureCheck = {
    //TOP ABOVE 37.8
    top_above_temp_qty: document.getElementById('top_above_temp_qty'),
    top_above_temp_prcnt: document.getElementById('top_above_temp_prcnt'),
    //TOP BELOW 37.7
    top_below_temp_qty: document.getElementById('top_below_temp_qty'),
    top_below_temp_prcnt: document.getElementById('top_below_temp_prcnt'),

    //MID ABOVE 37.8
    mid_above_temp_qty: document.getElementById('mid_above_temp_qty'),
    mid_above_temp_prcnt: document.getElementById('mid_above_temp_prcnt'),
    //MID BELOW 37.7
    mid_below_temp_qty: document.getElementById('mid_below_temp_qty'),
    mid_below_temp_prcnt: document.getElementById('mid_below_temp_prcnt'),

    //LOW ABOVE 37.8
    low_above_temp_qty: document.getElementById('low_above_temp_qty'),
    low_above_temp_prcnt: document.getElementById('low_above_temp_prcnt'),
    //LOW BELOW 37.7
    low_below_temp_qty: document.getElementById('low_below_temp_qty'),
    low_below_temp_prcnt: document.getElementById('low_below_temp_prcnt')
}

Object.keys(temperatureCheck).forEach(key => {
    if (key.includes('_qty')) {
        temperatureCheck[key].addEventListener('input', updateTemperatureCheck);
    }
});

function updateTemperatureCheck(event) {
    let incQty = Number(setterProcess.d10_inc_qty.value) || 0; // Base quantity
    let targetQtyField = event.target;
    let targetPercentField = temperatureCheck[targetQtyField.id.replace('_qty', '_prcnt')]; // Map qty field to % field

    if (targetPercentField) {
        targetPercentField.value = ((targetQtyField.value / incQty) * 100).toFixed(2);
    }
}   

// setTimeout(() => {
//     calculateBoxes(Number(pulloutStorage.settable_eggs_qty.value) || 0);
// }, 1000);
