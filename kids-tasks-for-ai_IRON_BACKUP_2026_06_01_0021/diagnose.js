// Diagnostic script - paste this in browser console (F12 -> Console)
console.log("=== DIAGNOSTICS ===");
console.log("balance-big:", document.getElementById('balance-big'));
console.log("stat-earned:", document.getElementById('stat-earned'));
console.log("stat-deducted:", document.getElementById('stat-deducted'));
console.log("withdraw-balance:", document.getElementById('withdraw-balance'));
console.log("withdraw-modal:", document.getElementById('withdraw-modal'));
console.log("withdraw-amount:", document.getElementById('withdraw-amount'));
console.log("withdraw-type-group:", document.getElementById('withdraw-type-group'));
console.log("withdraw-currency-type:", document.getElementById('withdraw-currency-type'));
console.log("btn-withdraw:", document.getElementById('btn-withdraw'));
console.log("page-balance:", document.getElementById('page-balance'));

// Check if there are duplicate IDs
var allIds = [...document.querySelectorAll('[id]')].map(el => el.id);
var duplicates = allIds.filter((id, i) => allIds.indexOf(id) !== i);
if (duplicates.length > 0) {
    console.log("DUPLICATE IDs FOUND:", [...new Set(duplicates)]);
} else {
    console.log("No duplicate IDs");
}

// Check if showWithdrawModal is defined
console.log("showWithdrawModal:", typeof showWithdrawModal);
console.log("submitWithdraw:", typeof submitWithdraw);
console.log("getCurrentChild:", typeof getCurrentChild);

// Check state
if (typeof getCurrentChild === 'function') {
    var child = getCurrentChild();
    console.log("Current child:", child ? child.name : "NULL");
    console.log("child.withdrawals:", child ? child.withdrawals : "N/A");
    console.log("child.rewardType:", child ? child.rewardType : "N/A");
}
console.log("=== END DIAGNOSTICS ===");
