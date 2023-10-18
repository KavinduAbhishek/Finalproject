// cart.js

let total = 0;

function addToCart(price) {
    const quantity = parseInt(document.querySelector(".quantity").value);
    const itemTotal = price * quantity;
    total += itemTotal;
    updateTotal();
}

function updateTotal() {
    document.getElementById("total").textContent = total.toFixed(2);
}

function clearCart() {
    total = 0;
    updateTotal();
}

document.getElementById("clearcart-button").addEventListener("click", clearCart);

function redirectToCheckout() {
    window.location.href = "checkout.php";
}

document.getElementById("checkout-button").addEventListener("click", redirectToCheckout);
