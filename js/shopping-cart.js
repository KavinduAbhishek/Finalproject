const addToCartButtons = document.getElementsByClassName("add-to-cart");
const cartItemsContainer = document.getElementById("cart-items");
const totalElement = document.getElementById("total");
let total = 0;

// checkout logic
const checkoutButton = document.getElementById("checkout-button");
const clearCartButton = document.getElementById("clearcart-button");

function updateCheckoutButtonStatus() {
    checkoutButton.disabled = total <= 0;
}

function updateClearcarttButtonStatus() {
    clearCartButton.disabled = total <= 0;
}

updateCheckoutButtonStatus();
updateClearcarttButtonStatus();

// Add event listener to update the button status when the total changes
totalElement.addEventListener('change', () => {
    updateCheckoutButtonStatus();
    updateClearcarttButtonStatus();
});

checkoutButton.addEventListener("click", function () {
    const total = parseFloat(totalElement.innerText);
    localStorage.setItem("total", total);
});

// Add item to cart
function addItemToCart(name, price, quantity) {
    const cartItem = document.createElement("div");
    cartItem.classList.add("cart-item");

    const itemInfo = document.createElement("div");
    itemInfo.innerHTML = `${name} - $${price.toFixed(2)} x ${quantity}`;

    const removeButton = document.createElement("button");
    removeButton.innerText = "Remove";
    removeButton.addEventListener("click", () => {
        removeItemFromCart(cartItem, price * quantity);
    });

    cartItem.appendChild(itemInfo);
    cartItem.appendChild(removeButton);
    cartItemsContainer.appendChild(cartItem);

    const itemTotal = price * quantity;
    total += itemTotal;
    totalElement.innerText = total.toFixed(2);
    updateCheckoutButtonStatus();
    updateClearcarttButtonStatus();
}

// Remove item from cart
function removeItemFromCart(cartItem, price) {
    cartItemsContainer.removeChild(cartItem);
    total -= price;
    totalElement.innerText = total.toFixed(2);
    updateCheckoutButtonStatus();
    updateClearcarttButtonStatus();
}

// Remove all from cart
function removeAll() {
    cartItemsContainer.innerHTML = "";
    total = 0;
    totalElement.innerText = total.toFixed(2);
    updateCheckoutButtonStatus();
    updateClearcarttButtonStatus();
}

clearCartButton.addEventListener('click', removeAll);

// Add click event listener to all add-to-cart buttons
for (let i = 0; i < addToCartButtons.length; i++) {
    addToCartButtons[i].addEventListener("click", () => {
        const item = addToCartButtons[i].parentNode;
        const name = item.getElementsByTagName("h3")[0].innerText;
        const price = parseFloat(
            item.getElementsByTagName("p")[0].innerText.split("$")[1]
        );
        const quantity = parseInt(item.querySelector(".quantity").value);
        addItemToCart(name, price, quantity);
    });
}

function redirectToCheckout() {
    window.location.href = 'checkout.php';
}

checkoutButton.addEventListener('click', redirectToCheckout);