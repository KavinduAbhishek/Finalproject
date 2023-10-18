/* COPY INPUT VALUES TO CARD MOCKUP */
const bounds = document.querySelectorAll("[data-bound]");

for (let i = 0; i < bounds.length; i++) {
  const targetId = bounds[i].getAttribute("data-bound");
  const defValue = bounds[i].getAttribute("data-def");
  const targetEl = document.getElementById(targetId);
  bounds[i].addEventListener(
    "keyup",
    () => (targetEl.innerText = bounds[i].value || defValue)
  );
}

/* TOGGLE CVC DISPLAY MODE */
const cvc_toggler = document.getElementById("cvc_toggler");

cvc_toggler.addEventListener("click", () => {
  const target = cvc_toggler.getAttribute("data-target");
  const el = document.getElementById(target);
  el.setAttribute("type", el.type === "text" ? "password" : "text");
});

function generateOrderNumber() {
  const currentDate = new Date();
  const year = currentDate.getFullYear();
  const month = String(currentDate.getMonth() + 1).padStart(2, "0");
  const day = String(currentDate.getDate()).padStart(2, "0");
  const hours = String(currentDate.getHours()).padStart(2, "0");
  const minutes = String(currentDate.getMinutes()).padStart(2, "0");
  const seconds = String(currentDate.getSeconds()).padStart(2, "0");

  const ordernumber = document.getElementById("ordernumber");
  ordernumber.innerText = `${year}${month}${day}${hours}${minutes}${seconds}`;
}

function vatCalculate(total) {
  const vatcal = document.getElementById("vatcalculate");
  var vat = total * 0.2;
  vatcal.innerText = `$${vat}`;
  return vat;
}

function totalPay(total_, vat_) {
  const total = document.getElementById("totalPay");
  var totalnet = total_ + vat_;
  const stringValue = totalnet.toString();
  const splitArray = stringValue.split(".");
  if (splitArray.length > 1) {
    total.innerHTML = `<strong>${splitArray[0]}</strong>
  <small
    >.${splitArray[1]} <span class="f-secondary-color">USD</span></small
  >`;
  } else {
    total.innerHTML = `<strong>${stringValue}</strong>
    <small
      >.00 <span class="f-secondary-color">USD</span></small
    >`;
  }
}

document.addEventListener("DOMContentLoaded", function () {
  generateOrderNumber();
  // Get the total value from local storage
  const total = localStorage.getItem("total");
  const vat = vatCalculate(total);
  // Display the total value on the page
  const totalDisplay = document.getElementById("total-display");
  totalPay(parseInt(total), vat);
  totalDisplay.innerText = `$${total}`;
});
