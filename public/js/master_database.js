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

//Collected Quantity function to generate settable eggs and balance
collectedEggs.collected_qty.addEventListener('change', () => {
    let collectedQty = Number(collectedEggs.collected_qty.value) || 0;

    classificationStorage.settable_eggs.value = collectedQty;
    classificationStorage.remaining_balance.value = collectedQty;
});

// Pullout Quantity function to update remaining balance
pulloutStorage.settable_eggs_qty.addEventListener('change', () => {
    let settableEggs = Number(classificationStorage.settable_eggs.value) || 0;
    let pulloutQty = Number(pulloutStorage.settable_eggs_qty.value) || 0;

    classificationStorage.remaining_balance.value = Math.max(0, settableEggs - pulloutQty);
    setterProcess.d10_inc_qty.value = pulloutQty;

    if(pulloutStorage.prime_qty.value && pulloutStorage.jp_qty.value) {
        pulloutStorage.prime_qty.value = "";
        pulloutStorage.jp_qty.value = "";
        pulloutStorage.prime_prcnt.value = "";
        pulloutStorage.jp_prcnt.value = "";
    }
});

// 🟢 Ensure calculations update in real-time
pulloutStorage.prime_qty.addEventListener('change', updatePullout);
pulloutStorage.jp_qty.addEventListener('change', updatePullout);

// 🟢 Auto-calculate Prime & JP Percentages
function updatePullout() {
    let settableEggs = Number(pulloutStorage.settable_eggs_qty.value) || 0;
    let primeQty = Number(pulloutStorage.prime_qty.value) || 0;

    let jpQty = Math.max(0, settableEggs - primeQty);
    pulloutStorage.jp_qty.value = jpQty;

    pulloutStorage.prime_prcnt.value = settableEggs > 0 ? Math.round((primeQty / settableEggs) * 100) : 0;
    pulloutStorage.jp_prcnt.value = settableEggs > 0 ? Math.round((jpQty / settableEggs) * 100) : 0;
}

setterProcess.d10_candling_qty.addEventListener('change', updateSetterProcess); // Update d10_inc

function updateSetterProcess(){
    let settableEggs = Number(pulloutStorage.settable_eggs_qty.value) || 0;
    let breakoutQty = Number(setterProcess.d10_breakout_qty.value) || 0;

    setterProcess.d10_breakout_prcnt.value = breakoutQty > 0 ? Math.round((setterProcess.d10_candling_qty.value / breakoutQty) * 100) : 0;
    setterProcess.d10_inc_qty.value = Math.max(0, settableEggs - setterProcess.d10_candling_qty.value);
}

let candlingProcess = {
    candling_date: document.getElementById('d18_candling_date'),
    infertiles_qty: document.getElementById('infertiles_qty'),
    embyonic_eggs_qty: document.getElementById('embyonic_eggs_qty')
}

candlingProcess.infertiles_qty.addEventListener('change', updateCandlingProcess);

function updateCandlingProcess(){
    candlingProcess.embyonic_eggs_qty.value = setterProcess.d10_inc_qty.value - candlingProcess.infertiles_qty.value;
}


const hatcherProcess = {
    hatcher_no: document.getElementById('hatcher_no'),
    hatcher_date: document.getElementById('hatcher_date'),
    rejected_hatch_qty: document.getElementById('rejected_hatch_qty'),
    accepted_hatch_qty: document.getElementById('accepted_hatch_qty')
};

hatcherProcess.rejected_hatch_qty.addEventListener('change', updateHatcherProcess);

function updateHatcherProcess(){
    hatcherProcess.accepted_hatch_qty.value = candlingProcess.embyonic_eggs_qty.value - hatcherProcess.rejected_hatch_qty.value;
}

const sexingProcess = {
    cock_qty: document.getElementById('cock_qty'),
    dop_qty: document.getElementById('dop_qty')
};

sexingProcess.cock_qty.addEventListener('change', updateSexingProcess);

function updateSexingProcess(){
    sexingProcess.dop_qty.value = hatcherProcess.accepted_hatch_qty.value - sexingProcess.cock_qty.value;
}

const qualityControl = {
    qc_date: document.getElementById('qc_date'),
    rejected_dop_qty: document.getElementById('rejected_dop_qty'),
    accepted_dop_qty: document.getElementById('accepted_dop_qty')
};

qualityControl.rejected_dop_qty.addEventListener('change', updateQualityControl);

function updateQualityControl(){
    qualityControl.accepted_dop_qty.value = sexingProcess.dop_qty.value - qualityControl.rejected_dop_qty.value;
}

const dispatchProcess = {
    dispatch_prime_qty: document.getElementById('dispatch_prime_qty'),
    dispatch_jr_prime_qty: document.getElementById('dispatch_jr_prime_qty')
};

dispatchProcess.dispatch_prime_qty.addEventListener('change', updateDispatchProcess);
dispatchProcess.dispatch_jr_prime_qty.addEventListener('change', updateDispatchProcess);

function updateDispatchProcess(){
    let goodDOPQty = Number(qualityControl.accepted_dop_qty.value) || 0;
    let primeQty = Number(dispatchProcess.dispatch_prime_qty.value) || 0;

    let jpQty = Math.max(0, goodDOPQty - primeQty);
    dispatchProcess.dispatch_jr_prime_qty.value = jpQty;
}

// // Card 2 Variables
// let non_settable_eggs = document.getElementById('non_settable_eggs');
// let settable_eggs = document.getElementById('settable_eggs');
// let remaining_balance = document.getElementById('remaining_balance');

// // Card 3 Variables
// let pullout_date = document.getElementById('pullout_date');
// let settable_eggs_qty = document.getElementById('settable_eggs_qty');
// let incubator_no = document.getElementById('incubator_no');
// let prime_prcnt = document.getElementById('prime_prcnt');
// let jp_qty = document.getElementById('jp_qty');
// let jp_prcnt = document.getElementById('jp_prcnt');

// // Card 4 Variables (same IDs as in previous example - assuming intentional or adjust IDs if needed)
// let d10_candling_date = document.getElementById('d10_candling_date');
// let d10_candling_qty = document.getElementById('d10_candling_qty');
// let d10_breakout_qty = document.getElementById('d10_breakout_qty');
// let d10_breakout_prcnt = document.getElementById('d10_breakout_prcnt');
// let d10_inc_qty = document.getElementById('d10_inc_qty');

// // Card 5 Variables
// let d18_candling_date = document.getElementById('d18_candling_date');
// let infertiles_qty = document.getElementById('infertiles_qty');
// let embyonic_eggs_qty = document.getElementById('embyonic_eggs_qty');

// // Card 5.1 Variables
// let top_above_temp_qty = document.getElementById('top_above_temp_qty');
// let top_above_temp_prcnt = document.getElementById('top_above_temp_prcnt');
// let top_below_temp_qty = document.getElementById('top_below_temp_qty');
// let top_below_temp_prcnt = document.getElementById('top_below_temp_prcnt');
// let mid_above_temp_qty = document.getElementById('mid_above_temp_qty');
// let mid_below_temp_qty = document.getElementById('mid_below_temp_qty');
// let mid_below_temp_prcnt = document.getElementById('mid_below_temp_prcnt');
// let low_above_temp_qty = document.getElementById('low_above_temp_qty');
// let low_above_temp_prcnt = document.getElementById('low_above_temp_prcnt');
// let low_below_temp_qty = document.getElementById('low_below_temp_qty');
// let low_below_temp_prcnt = document.getElementById('low_below_temp_prcnt');

// // Card 6 Variables
// let hatcher_no = document.getElementById('hatcher_no');
// let hatcher_date = document.getElementById('hatcher_date');
// let rejected_hatch_qty = document.getElementById('rejected_hatch_qty');
// let accepted_hatch_qty = document.getElementById('accepted_hatch_qty');

// // Card 7 Variables
// let cock_qty = document.getElementById('cock_qty');
// let dop_qty = document.getElementById('dop_qty');

// // Card 8 Variables
// let qc_date = document.getElementById('qc_date');
// let rejected_dop_qty = document.getElementById('rejected_dop_qty');
// let accepted_dop_qty = document.getElementById('accepted_dop_qty');

// // Card 9 Variables
// let prime_qty = document.getElementById('prime_qty');
// let jr_prime_qty = document.getElementById('jp_qty');
