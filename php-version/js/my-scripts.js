//############################## SPECIAL FUNCTIONS ###################################
//allows to set multiple attributes at once
function setAttributes (el, attrs) {
  for(let key in attrs)
    el.setAttribute(key, attrs[key]);
}

//############################## CART/ORDER FUNCTIONS ###################################
function addMenuToCart (menuId) {
  //create div for ordered menu
  const orderRecap = document.getElementById("order-recap");
  const orderRecapTr = document.createElement("tr");

  //create td that'll contain menus info
  const menuIdTd = createMenuIdTd(menuId);
  const menuNameTd = createMenuNameTd(menuId);
  const menuAmountTd = createMenuAmountTd(menuId);
  const menuPriceTd = createMenuPriceTd(menuId);

  //append the form groups to orderedMenuContainer
  orderRecapTr.appendChild(menuIdTd);
  orderRecapTr.appendChild(menuNameTd);
  orderRecapTr.appendChild(menuAmountTd);
  orderRecapTr.appendChild(menuPriceTd);

  //append orderedMenuContainer to orderRecapDiv
  orderRecap.appendChild(orderRecapTr);
}

function cartOperations () {
  const menuId = parseInt(menuIdElem.value);
  //show order jumbotron
  const orderJumbo = document.getElementById("order-jumbo");
  orderJumbo.classList.remove("d-none");
  //menu already in cart
  if (menuInCart (menuId)) {
    updateCart(menuId);
  }
  else {
    addMenuToCart(menuId);
  }
  calculateTotalPrice();
}

function createMenuAmountTd (id) {
  const amountId = "amount"+id;
  const amountValue = amountElem.value;

  const menuAmountTd = document.createElement("td");
  menuAmountTd.setAttribute("id",amountId);
  menuAmountTd.textContent = amountValue;

  const menuAmountTdInput = document.createElement("input");
  menuAmountTdInput.classList.add("d-none");
  menuAmountTdInput.setAttribute("name","menu_amount[]");
  menuAmountTdInput.value = amountValue;
  menuAmountTd.appendChild(menuAmountTdInput);

  return menuAmountTd;
}

function createMenuIdTd (id) {
  const identifierValue = menuDDL.options[menuDDL.selectedIndex].dataset.menuId; //from data-menu-id to menuId

  const menuIdentifierTd = document.createElement("input");
  menuIdentifierTd.classList.add("d-none");
  //menu-id[] to be received as an array in PHP
  menuIdentifierTd.setAttribute("name","menu_id[]");
  menuIdentifierTd.value = identifierValue;

  return menuIdentifierTd;
}

function createMenuNameTd (id) {
  const menuId = "menu"+id;
  const menuValue = menuDDL.options[menuDDL.selectedIndex].value;

  const menuNameTd = document.createElement("td");
  menuNameTd.setAttribute("id",menuId);
  menuNameTd.textContent = menuValue;

  const menuNameTdInput = document.createElement("input");
  menuNameTdInput.classList.add("d-none");
  menuNameTdInput.setAttribute("name","menu_name[]");
  menuNameTdInput.value = menuValue;
  menuNameTd.appendChild(menuNameTdInput);

  return menuNameTd;
}

function createMenuPriceTd (id) {
  const priceId = "price"+id;
  const priceValue = priceElem.value;

  const menuPriceTd = document.createElement("td");
  menuPriceTd.setAttribute("id",priceId);
  menuPriceTd.textContent = priceValue;

  const menuPriceTdInput = document.createElement("input");
  menuPriceTdInput.classList.add("d-none");
  menuPriceTdInput.setAttribute("name","menu_price[]");
  menuPriceTd.appendChild(menuPriceTdInput);

  return menuPriceTd;
}

//returns a nodelist containing 
function getMenuNodeList () {
  const selector = "#order-recap [id^='menu']";
  return document.querySelectorAll(selector);
}

function getMenuIdx (menuId) { 
  const MenuNodeList = getMenuNodeList();
  for(const [idx,menu] of MenuNodeList.entries()){
    if (parseInt(menu.id.substr(4)) == menuId) {
      return idx; //return index of the menu found
    }
  }
}

function menuInCart (menuId) {
  const MenuNodeList = getMenuNodeList();
  for(const menu of MenuNodeList){
    //take the string, starting from the index 4, from id attribute of menu and parse it to string 
                        //([0]m[1]e[2]n[3]u[4]1)
    if (parseInt(menu.id.substr(4)) == menuId) {
      return true; //menu1,2,3 etc was found
    }
  }
  return false;
}

function updateCart (menuId) {
  //amount
  const amountId = "amount"+menuId;
  const amountCell = document.getElementById(amountId);
  const amountValue = parseInt(amountCell.textContent);
  const currAmount = parseInt(amountElem.value);
  const maxAmount = parseInt(amountElem.max);
  const newAmount = amountValue+currAmount;

  //price
  const priceId = "price"+menuId;
  const priceCell = document.getElementById(priceId);
  const price = Number(menuDDL.options[menuId-1].dataset.price); //get the price of the menu (DDL indexes start from 0!)
  
  //user added x units and the total amount exceeds the max
  if (newAmount>maxAmount) {
    alert(`You can't order more than ${amountElem.max} units!`)
    return;
  }
  //update the amount and the price in the cell
  else {
    //change the value of the first child (td elem) without affecting the input elem
    amountCell.firstChild.nodeValue = newAmount;
    const newPrice = Number(newAmount*price).toFixed(2);
    priceCell.firstChild.nodeValue = newPrice;
    //update amount value for hidden input inside the td
    amountCell.lastChild.value = newAmount;
  }
}

//############################## DATE/HOUR FUNCTIONS ###################################
function getInputDateFormat(date) {
  return date.toISOString().slice(0,10); //yyyy-mm-dd
}

function setInitialTime() {
  const currentTime = getCurrentTime();
  timeElem.value = currentTime;
}

//get current time
function getCurrentTime() {
  //get today's date
  const currentDate = new Date();
  //append '0' for single digits (to prevent 9:15, 17:7 etc)
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
  //get price of currenlty selected menu
  const price = menuDDL.options[menuDDL.selectedIndex].dataset.price; //.dataset.price same as .getAttribute('data-price');
  const amount = amountElem.value; //! value is the property not the HTML attribute!
  //set price
  priceElem.value = (price*amount).toFixed(2);
}

function calculateTotalPrice() {
  const selector = "#order-recap [id^='price']";
  //populate prices with the values of menu prices
  const prices = Array.from(document.querySelectorAll(selector)).map(el => Number(el.textContent));
  //sums every value to totalPrice and add 10 to it if it's <= 49.99
  let totalPrice = prices.reduce((a,b) => a+b);
  if(totalPrice <= 49.99) { 
    totalPrice += 10; 
  }
  totalPriceElem.value = totalPrice.toFixed(2);
}

function validAmount() {
  const maxAmount = amountElem.max;
  if (amountElem.value == "" || Number(amountElem.value) <= 0) { amountElem.value = 1;  }
  if (Number(amountElem.value) > maxAmount) { amountElem.value = maxAmount;  } 
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
const priceElem = document.getElementById("price");
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
addToCartButton.addEventListener("click", cartOperations, false);

//### PRICE ###
amountElem.addEventListener("blur", validAmount, false);
amountElem.addEventListener("keyup", calculatePrice, false);
menuDDL.addEventListener("change", calculatePrice, false);

//### MENU ###
menuDDL.addEventListener("change", setMenuId, false);

//### USER ###
usersDDL.addEventListener("change", setUserValues, false);