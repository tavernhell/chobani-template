//############################## SPECIAL FUNCTIONS ###################################
//allows to set multiple attributes at once
function setAttributes (el, attrs) {
  for(let key in attrs)
    el.setAttribute(key, attrs[key]);
}

//############################## CART/ORDER FUNCTIONS ###################################
function addToCart () {
  let menuId = menuIdElem.value;
  debugger;
  let elemId = "";
  let elemValue = "";

  //show order jumbotron
  const orderJumbo = document.getElementById("order-jumbo");
  orderJumbo.classList.remove("d-none");

  //add menu to cart
  const orderRecapDiv = document.getElementById("order-recap");

  //### MENU NAME ###
  elemId = "menu"+menuId;
  elemValue = menuDDL.options[menuDDL.selectedIndex].value;
  //<div class="form-group"></div>
  const menuNameFormGroup = document.createElement("div");
  menuNameFormGroup.classList.add("form-group");
  
  //<label for="menu1,2,3 etc" class="w-100 text-center">Menu</label>
  const menuLabel = document.createElement("label");
  menuLabel.setAttribute("for",elemId);
  menuLabel.classList.add("w-100","text-center");
  menuLabel.textContent = "Menu";

  //<input disabled="true" id="menu1,2,3 etc" type="text" class="form-control">Menu1,2,3 etc</input>
  const menuNameInput = document.createElement("input");
  setAttributes(menuNameInput, {
    'disabled':true,
    'id':elemId,
    'type':'text'
  });
  menuNameInput.classList.add('form-control');
  menuNameInput.value = elemValue;

  //append label and input to menuNameFormGroup and it to orderRecapDiv
  menuNameFormGroup.appendChild(menuLabel);
  menuNameFormGroup.appendChild(menuNameInput);
  orderRecapDiv.appendChild(menuNameFormGroup);
}

//############################## DATE/HOUR FUNCTIONS ###################################
function getInputDateFormat(date) {
  return date.toISOString().slice(0,10); //yyyy-mm-dd
}

function initialHourValue() {
  const validTime = getCurrentTime();
  timeElem.setAttribute('value',validTime);
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
  const validTime = getCurrentTime();
  //if the chosen date is today's date the minumum time should be the actual one
  if (dateElem.value == dateElem.min) {
    timeElem.min = validTime;
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
  const amount = document.getElementById("amount").value; //value is the property not the HTML attribute!
  //console.log(price);
  //set price
  priceInput.value = (price*amount).toFixed(2);
}

function validAmount() {
  const amount = document.getElementById("amount");
  const maxAmount = amount.max;
  if (amount.value == "") { amount.value = 1;  }
  if (amount.value > maxAmount) { amount.value = maxAmount;  } 
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
const amount = document.getElementById("amount");
const dateElem = document.getElementById("date");
const timeElem = document.getElementById("time");
const menuIdElem = document.getElementById("menu-id");
const menuDDL = document.getElementById("menu-ddl");
const addToCartButton = document.getElementById("addcart-btn")
const orderButton = document.getElementById("order-btn");
const usersDDL = document.getElementById("users-ddl");

//############################## ON PAGE LOAD ###################################
calculatePrice();
setMenuId();
setUserValues();
validAmount();
validDate();
validHour();

//############################## EVENT LISTENERS ###################################
//### DATE ###
dateElem.addEventListener("change", validHour, false); //validHour() would execute the function instead of calling it
orderButton.addEventListener("click", validHour, false);

//### CART ###
addToCartButton.addEventListener("click", addToCart, false);

//### PRICE ###
amount.addEventListener("blur", validAmount, false);
amount.addEventListener("keyup", calculatePrice, false);
menuDDL.addEventListener("change", calculatePrice, false);

//### MENU ###
menuDDL.addEventListener("change", setMenuId, false);

//### USER ###
usersDDL.addEventListener("change", setUserValues, false);