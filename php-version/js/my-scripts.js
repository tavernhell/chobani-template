//############################## SPECIAL FUNCTIONS ###################################
//allows to set multiple attributes at once
function setAttributes (el, attrs) {
  for(let key in attrs)
    el.setAttribute(key, attrs[key]);
}

//############################## CART/ORDER FUNCTIONS ###################################
function createMenuNameFormGroup (menuIdentifier) {
  const menuId = "menu"+menuIdentifier;
  const menuValue = menuDDL.options[menuDDL.selectedIndex].value;

  //<div class="form-group"></div>
  const menuNameFormGroup = document.createElement("div");
  menuNameFormGroup.classList.add("form-group");
  
  //<label for="menu1,2,3 etc" class="w-100 text-center">Menu</label>
  const menuNameLabel = document.createElement("label");
  menuNameLabel.setAttribute("for",menuId);
  menuNameLabel.classList.add("w-100","text-center");
  menuNameLabel.textContent = "Menu";

  //<input disabled="true" id="menu1,2,3 etc" type="text" class="form-control">Menu1,2,3 etc</input>
  const menuNameInput = document.createElement("input");
  setAttributes(menuNameInput, {
    'disabled':true,
    'id':menuId,
    'type':'text'
  });
  menuNameInput.classList.add("form-control","text-center");
  menuNameInput.value = menuValue;

  //append label and input to menuNameFormGroup
  menuNameFormGroup.appendChild(menuNameLabel);
  menuNameFormGroup.appendChild(menuNameInput);

  return menuNameFormGroup;
}

function createMenuAmountFormGroup (menuIdentifier) {
  const amountId = "amount"+menuIdentifier;
  const amountValue = amountElem.value;

  //<div class="form-group"></div>
  const menuAmountFormGroup = document.createElement("div");
  menuAmountFormGroup.classList.add("form-group","w-100px");

  //<label for="amount1,2,3 etc" class="w-100 text-center">Amount</label>
  const menuAmountLabel = document.createElement("label");
  menuAmountLabel.setAttribute("for",amountId);
  menuAmountLabel.classList.add("w-100","text-center");
  menuAmountLabel.textContent = "Amount";

  //<input disabled="true" id="amount1,2,3 etc" type="text" class="form-control">Amount1,2,3 etc</input>
  const menuAmountInput = document.createElement("input");
  setAttributes(menuAmountInput, {
    'disabled':true,
    'id':amountId,
    'type':'number'
  });
  menuAmountInput.classList.add("form-control","text-center");
  menuAmountInput.value = amountValue;

  //append label and input to menuAmountFormGroup
  menuAmountFormGroup.appendChild(menuAmountLabel);
  menuAmountFormGroup.appendChild(menuAmountInput);

  return menuAmountFormGroup;
}

function createMenuPriceFormGroup (menuIdentifier) {
  const priceId = "price"+menuIdentifier;
  const priceValue = price.value;

  //<div class="form-group"></div>
  const menuPriceFormGroup = document.createElement("div");
  menuPriceFormGroup.classList.add("form-group","w-150px");

  //<label for="price1,2,3 etc" class="w-100 text-center">Price</label>
  const menuPriceLabel = document.createElement("label");
  menuPriceLabel.setAttribute("for",priceId);
  menuPriceLabel.classList.add("w-100","text-center");
  menuPriceLabel.textContent = "Price";

  //<input disabled="true" id="price1,2,3 etc" type="text" class="form-control">Price1,2,3 etc</input>
  const menuPriceInput = document.createElement("input");
  setAttributes(menuPriceInput, {
    'disabled':true,
    'id':priceId,
    'type':'number'
  });
  menuPriceInput.classList.add("form-control","text-center");
  menuPriceInput.value = priceValue;

  //append label and input to menuPriceFormGroup
  menuPriceFormGroup.appendChild(menuPriceLabel);
  menuPriceFormGroup.appendChild(menuPriceInput);
  
  return menuPriceFormGroup;
}

function addToCart () {
  const menuId = menuIdElem.value;

  //show order jumbotron
  const orderJumbo = document.getElementById("order-jumbo");
  orderJumbo.classList.remove("d-none");

  //create div for ordered menu
  const orderRecapDiv = document.getElementById("order-recap");
  const orderedMenuContainer = document.createElement("div");
  orderedMenuContainer.classList.add("col-11", "d-flex", "justify-content-around", "mx-auto")

  //create form groups that'll contain menus info
  const menuNameFormGroup = createMenuNameFormGroup(menuId); //menu name
  const menuAmountFormGroup = createMenuAmountFormGroup(menuId); //menu amount
  const menuPriceFormGroup = createMenuPriceFormGroup(menuId); //menu price

  //append the form groups to orderedMenuContainer
  orderedMenuContainer.appendChild(menuNameFormGroup);
  orderedMenuContainer.appendChild(menuAmountFormGroup);
  orderedMenuContainer.appendChild(menuPriceFormGroup);

  //append orderedMenuContainer to orderRecapDiv
  orderRecapDiv.appendChild(orderedMenuContainer);

  calculateTotalPrice();
}

//############################## DATE/HOUR FUNCTIONS ###################################
function getInputDateFormat(date) {
  return date.toISOString().slice(0,10); //yyyy-mm-dd
}

function setInitialTime() {
  const currentTime = getCurrentTime();
  timeElem.value = currentTime;
}

function getCurrentTime() {
    //get current time
    const currentDate = new Date();
    //appen '0' for single digits (to prevent 9:15, 17:7 etc)
    const currentHour = ("0"+currentDate.getHours()).slice(-2);
    const currentMin = ("0"+currentDate.getMinutes()).slice(-2);
    const validTime = currentHour+':'+currentMin;
    return validTime;
}

//sets initial value of #date, as well as min and max value for it
function validDate() {
  const today = new Date();
  const maxDate = new Date();
  maxDate.setDate(maxDate.getDate() + 30);

  const dateElem = document.getElementById("date");
  //document.getElementById("date") --> <input type="date" class="form-control" name="date" id="date">

  setAttributes(dateElem, {
    'value':getInputDateFormat(today), 
    'min':getInputDateFormat(today),
    'max':getInputDateFormat(maxDate)
  });
}

//set initial value of #hour
function validHour() {
  const currentTime = getCurrentTime();
  //if the chosen date is today's date the minumum time should be the actual one
  if (dateElem.value == dateElem.min) {
    timeElem.min = currentTime;
  }
  //else the user can choose any date
  else {
    timeElem.removeAttribute("min");
  }
}

//############################## PRICE FUNCTIONS ###################################
function calculatePrice () {
  const priceInput = document.getElementById("price");
  //get price of currenlty selected menu
  const price = menuDDL.options[menuDDL.selectedIndex].dataset.price; //.dataset.price same as .getAttribute('data-price');
  const amount = amountElem.value; //value is the property not the HTML attribute!
  //set price
  priceInput.value = (price*amount).toFixed(2);
}

function calculateTotalPrice() {
  const selector = "#order-recap-container [id^='price']";
  //populate prices with the values of menu prices
  const prices = Array.from(document.querySelectorAll(selector)).map(el => Number(el.value));
  //sums every value to totalPrice and add 10 to it if it's <= 49.99
  let totalPrice = prices.reduce((a,b) => a+b);
  if(totalPrice <= 49.99) { totalPrice += 10; }
  totalPriceElem.value = totalPrice.toFixed(2);
}

function validAmount() {
  const maxAmount = amountElem.max;
  if (amountElem.value == "") { amountElem.value = 1;  }
  if (amountElem.value > maxAmount) { amountElem.value = maxAmount;  } 
  calculatePrice();
}

//############################## USER/MENU FUNCTIONS ###################################
function setMenuId () {
  menuIdElem.value = menuDDL.options[menuDDL.selectedIndex].dataset.menuId;
}

function setUserValues () {
  //associate HTML elements to JS variables
  const idField = document.getElementById("user-id");
  const nameField = document.getElementById("user-name");
  const emailField = document.getElementById("email");
  const phoneField = document.getElementById("phone");
  const addressField = document.getElementById("address");

  //get values of currently selected user
  const id = usersDDL.options[usersDDL.selectedIndex].dataset.userId; //! JS automatically converts data-user-id to camelCase!!!
  const name = usersDDL.options[usersDDL.selectedIndex].value;
  const email = usersDDL.options[usersDDL.selectedIndex].dataset.email;
  const phone = usersDDL.options[usersDDL.selectedIndex].dataset.phone;
  const address = usersDDL.options[usersDDL.selectedIndex].dataset.address;

  //assign retrieved values to HTML elements
  idField.value = id;
  nameField.value = name;
  emailField.value = email;
  phoneField.value = phone;
  addressField.value = address;
}

//############################## GLOBAL VARIABLES ###################################
const addToCartButton = document.getElementById("addcart-btn");
const amountElem = document.getElementById("amount");
const dateElem = document.getElementById("date");
const menuIdElem = document.getElementById("menu-id");
const menuDDL = document.getElementById("menu-ddl");
const orderButton = document.getElementById("order-btn");
const timeElem = document.getElementById("time");
const totalPriceElem = document.getElementById("total-price");
const usersDDL = document.getElementById("users-ddl");

//############################## ON PAGE LOAD ###################################
calculatePrice();
setInitialTime();
setMenuId();
setUserValues();
validAmount();
validDate();
validHour();

//############################## EVENT LISTENERS ###################################
//### DATE/TIME ###
dateElem.addEventListener("change", validHour, false); //validHour() would execute the function instead of calling it
orderButton.addEventListener("click", validHour, false);

//### CART ###
addToCartButton.addEventListener("click", addToCart, false);

//### PRICE ###
amountElem.addEventListener("blur", validAmount, false);
amountElem.addEventListener("keyup", calculatePrice, false);
menuDDL.addEventListener("change", calculatePrice, false);

//### MENU ###
menuDDL.addEventListener("change", setMenuId, false);

//### USER ###
usersDDL.addEventListener("change", setUserValues, false);