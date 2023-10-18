// cart.js

let total = 0;

function addToCart(price) {
  const quantity = parseInt(document.querySelector(".quantity").value);
  const itemTotal = price * quantity;
  total += itemTotal;
  updateTotal();

  // Extract item details
  const name = document.querySelector("h2").textContent;
  const cost = itemTotal.toFixed(2);
  const size = document.querySelector("p[size]").textContent;
  const description = document.querySelector("p[description]").textContent;
  const image = document.querySelector(".cart-item img").getAttribute("src");
  const quantityValue = quantity;

  // Send the item details to the server
  sendToServer(name, cost, size, description, quantityValue, image);
}

function updateTotal() {
  document.getElementById("total").textContent = total.toFixed(2);
}

function clearCart() {
  total = 0;
  updateTotal();
}

document
  .getElementById("clearcart-button")
  .addEventListener("click", clearCart);

function redirectToCheckout() {
  window.location.href = "checkout.php";
}

document
  .getElementById("checkout-button")
  .addEventListener("click", redirectToCheckout);

function sendToServer(name, cost, size, description, quantity, image) {
  const data = {
    name,
    cost,
    size,
    description,
    quantity,
    image,
  };

  fetch("cart.php", {
    method: "POST",
    body: JSON.stringify(data),
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      return response.text();
    })
    .then((data) => {
      console.log(data); // You can handle the server response here
    })
    .catch((error) => {
      console.error("There was a problem with the fetch operation:", error);
    });
}
