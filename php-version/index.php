<!-- REQUIRE STATEMENTS && CONNECTION TO THE DB -->
<?php 
  require('php/db-config.php');
  require('php/functions.php');
  
  //connecting to DB
  try {
    //create a PDO connection with a timeout set to 10 seconds
    $conn = new PDO($dsn, $username, $password, array(PDO::ATTR_TIMEOUT => 10));
    //throws exception on bad queries
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch (PDOException $e) {
    //report error message (die prevents the page to be rendered)
    die($e->getMessage());
  }
?>

<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='utf-8'>
  <title>Chobani template</title>

  <!-- Bootstrap CSS -->
  <link rel='stylesheet' 
        href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'
        integrity='sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z' 
        crossorigin='anonymous'>
  <!-- My CSS -->
  <link rel='stylesheet' href='css/my-style.css'>
  <!-- Material Icons -->
  <link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
  
  <!-- Bootstrap JS-->
  <script defer src='https://code.jquery.com/jquery-3.5.1.slim.min.js'
          integrity='sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj'
          crossorigin='anonymous'></script>
  <script defer src='https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js'
          integrity='sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN'
          crossorigin='anonymous'></script>
  <script defer src='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js'
          integrity='sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV'
          crossorigin='anonymous'></script>
  <!-- My JS -->
  <script defer src='js/my-scripts.js'></script>
</head>

<body>
  <!-- Navbar -->
  <header>
    <nav class='navbar navbar-light navbar-expand-lg'>
      <a class='navbar-brand' href='#'>Chobani</a>
      <!-- iPad -->
      <button class='navbar-toggler ml-auto' type='button' data-toggle='collapse' data-target='#navbarSupportedContent'
        aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
        <!-- ml-auto -> put toggle lines on right for iPad -->
        <span class='navbar-toggler-icon'></span>
      </button>
      <!-- iPad -->

      <div class='collapse navbar-collapse' id='navbarSupportedContent'>
        <div class='row w-100'>
          <div class='col-lg-2'></div> <!-- to leave some space from the brand -->

          <div class='col-lg-4 col-md-12'>
            <!-- shortcuts -->
            <ul class='navbar-nav'>
              <li class='nav-item'>
                <a class='nav-link' href='#shop'>Shop</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='#about'>About</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='#help'>Help</a>
              </li>
            </ul>
          </div>

          <div class='col-lg-2 col-md-12'>
            <!-- contacts -->
            <ul class='navbar-nav'>
              <li class='nav-item'>
                <a class='nav-link' href='tel:+62123456789'>+39123456789</a>
              </li>
            </ul>
          </div>

          <div class='col-lg-1 ml-auto col-md-12'>
            <!-- login && cart -->
            <ul class='navbar-nav w-100 d-flex justify-content-between'>
              <li class='nav-item'>
                <a class='nav-link'>Login</a>
              </li>
              <li class='nav-item pt-2'>
                <i class='btn p-0 material-icons'>shopping_cart</i>
              </li>
            </ul>
          </div>
        </div> <!-- row -->
      </div>
    </nav>
  </header>
  <!-- End of navbar -->

  <!-- Main container -->
  <main>
    <div class='container-fluid p-0'>
      <!-- Special food + our services -->
      <div id='first-block'>
        <div id='specialfood-content'>
          <img src='img/leaves.png' id='leaves-topright'>
          <div class='d-flex justify-content-center align-items-center'>
            <div id='specialfood-text'>
              <img src='img/leaf.png' id='leaf-leftofspecial'>
              <img src='img/leaf.png' id='leaf-abovespecial'>
              <P class='biggestText'>Special food every time in our shop</p>
              <P>We promise you'll enjoy every sweet moment.
                <br>
                Find your favorite food now, eat what you love and save
                some time for something cool!
              </P>
              <button type='button' class='btn' href='#'>Get started</button>
            </div>
            <div class='img-container'>
              <img src='img/food-bowl.png' id='food-bowl' class='img-fluid' alt='Bowl of food'>
            </div>
          </div>
        </div>
        <!-- End of special food && pic -->


        <div class='separator'>
        </div>

        <!-- Our services -->
        <div class='row' id='our-services'>
          <div class='col-11 mx-auto'>
            <p class='biggerText text-center'>Our services</p>
            <!-- Services cards container + cards inside -->
            <div class='d-flex flex-column flex-lg-row justify-content-md-around justify-content-center mt-2'>
              <div class='card-img-top d-flex align-items-center col-6 col-lg-3 bg-white px-2 my-1 shadow rounded'>
                <img class='img-fluid minsize' src='img/catering.png' alt='Catering'>
                <p class='p-2 m-0'>Catering<br>Service</p>
              </div>
              <div class='card-img-top d-flex align-items-center col-6 col-lg-3 bg-white px-2 my-1 shadow rounded'>
                <div>
                  <img class='img-fluid minsize' src='img/booking.png' alt='Booking'>
                </div>
                <p class='p-2 m-0'>Online <br> Booking</p>
              </div>
              <div class='card-img-top d-flex align-items-center col-6 col-lg-3 bg-white px-2 my-1 shadow rounded'>
                <div>
                  <img class='img-fluid minsize' src='img/food-delivery.png' alt='Delivery'>
                </div>
                <p class='p-2 m-0'>Delivery<br>Service</p>
              </div>
            </div>
          </div>
        </div>
        <!-- End of our services -->
      </div>

      <div class='separator'></div>

      <!-- Background circle on right -->
      <div class='bg-container'>
        <div class='circle circle-right'></div>
        <div class='circle-border circle-right'></div>
      </div>

      <!-- Special menus -->
      <div class='row' id='special-menus'>
        <div class='col-11 mx-auto p-0'>
          <p class='biggestText text-center'>Special menus</p>
          <p class='text-center'>Choose what's best for you!</p>
          <div class='d-flex flex-nowrap justify-content-center mt-2'>
            <?php 
              $stm = "SELECT * FROM menus ORDER BY RAND() LIMIT 3";
              foreach ($conn->query($stm) as $menu) {
            ?>      
            <div class='card-img-top bg-white col-3 p-2 shadow-lg' title='<?=$menu["menu_description"]?>'>
              <div class='text-center'>
              <div class='text-center bold'><span><?=$menu["menu_name"]?></span></div>
                <img class='menu-img' src='img/<?=$menu["menu_picture_name"]?>.png' alt='<?=$menu["menu_name"]?>'></div>
              <div class='d-flex flex-column'>
                <div class='rating'>
                  <?php for($i = 1; $i <= $menu['menu_rating']; $i++){ echo "&#11088;"; } ?>
                </div>
                <div>$ <?=$menu["menu_price"]?></div>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
      <!-- End of special menus -->

      <div class='separator'></div>
      <div class='separator'></div>

      <!-- Background circle on left -->
      <div class='bg-container'>
        <div class='circle circle-left'></div>
        <div class='circle-border circle-left'></div>
        <img src='img/big-leaf.png' id='bigleaf-about'>
      </div>

      <!-- All about Chobani -->
      <div class='row'>
        <div class='col-10 mx-auto d-flex flex-nowrap justify-content-center align-items-center'>
          <div class='px-2'>
            <p class='biggerText'>
              All about Chobani
              <br>
              We are the best quality restaurant
            </p>
            <div class='my-3'></div>
            <div>
              <p>Not only quality rice and sushi plates.
                <br>
                Find the best selection of curry and other traditional Indian dishes as well!
              </p>
            </div>
            <div class='my-3'></div>
            <button type='button' class='btn' href='#'>View more</button>
          </div>
          <div id='styled-img-container' class='d-flex flex-column'>
              <div class='d-flex align-items-end'>
                <div class='img-frame curry1 radius-bltr'></div>
                <div class='img-frame curry2 radius-brtl'></div>
              </div>
              <div class='d-flex justify-content-center'>
                <div class='img-frame curry3 radius-brtl'></div>
                <div class='img-frame curry4 radius-bltr'></div>
              </div>
          </div>
        </div>
      </div>
      <!-- End of all about Chobani -->


      <div class='bg-container'>
        <div class='circle circle-mini circle-right'></div>
        <div class='circle-border circle-mini circle-right'></div>
      </div>

      <div class='separator'></div>
      <div class='separator'></div>
      <!-- Background circle on right -->

      <!-- Shipping and payment -->
      <div class='biggerText d-flex justify-content-center'>
        Shipping and payment
      </div>
      <div class='separator'></div>
      <div class='row'>
        <div class='col-10 mx-auto'>
          <div class='row d-flex align-items-center'>
            <div class='col-3'>
              <div class='text-center'><span class='bold'>Making an order</span></div>
              <div class='text-center'>We take orders and deliver 24/7!</div>
            </div>
            <div class='col-3'>
              <div class='text-center'><span class='bold'>Paying</span></div>
              <div class='text-center'>You can pay cash or credit card to courier</div>
            </div>
            <div class='col-3'>
              <div class='text-center'><span class='bold'>Delivery</span></div>
              <div class='text-center'>Delivery cost is $10 for orders < 49.99$ </div>
            </div>
            <div class='col-3'>
              <div class='text-center'><span class='bold'>Feedback</span></div>
              <div class='text-center'>You can give us feedback, if you want</div>
            </div>
          </div>
        </div>
      </div>
      <!-- End of shipping and payment -->

      <div class='separator'></div>
      <div class='separator'></div>
      <div class='bg-container'>
        <img src='img/soup.png' class='soup soup-right'>
        <img src='img/soup.png' class='soup soup-left'>
      </div>

      <!-- Satisfied costumers -->
      <p class='biggerText text-center'>
        Testimonials: costumer reviews
      </p>
      
      <div id='reviewCarousel' class='carousel slide w-75 mx-auto' data-interval='false'>
        <!-- Carousel body -->
        <div class='carousel-inner h-100 d-flex align-items-center'>
          <?php 
            //var inizialization
            $i = 0; 
            $ext = $class = '';
            //query + cycle
            $stm = "SELECT user_id, first_name as name, review, profile_pic as pic
                    FROM users 
                    WHERE review IS NOT NULL 
                    ORDER BY RAND() LIMIT 4";
            foreach ($conn->query($stm) as $user) {
              //determine class and ext values
              $class = ($i == 0) ? 'active' : '';
              $ext = ($user['pic']=='placeholder') ? '.png' : '.jpg';
          ?>  
          <div class='carousel-item <?=$class?>'>
            <img class='d-block mx-auto carousel-img' 
                 src='img/profiles/<?= $user['pic'].$ext?>' 
                 alt='Costumer <?=$user['user_id']?>'>
            <p class='text-center'>
              <?= '<span class="bold">'. $user['name'].' said:</span> <br>'.$user['review'] ?>
            </p>
          </div>
          <?php $i++; } ?>
          <!-- Carousel body -->
          <!-- Carousel controls -->
          <a class='carousel-control-prev' href='#reviewCarousel' role='button' data-slide='prev'>
            <span class='carousel-control-prev-icon' aria-hidden='true'></span>
            <span class='sr-only'>Previous</span>
          </a>
          <a class='carousel-control-next' href='#reviewCarousel' role='button' data-slide='next'>
            <span class='carousel-control-next-icon' aria-hidden='true'></span>
            <span class='sr-only'>Next</span>
          </a>
          <!-- Carousel controls -->
        </div>
      </div>
      <!-- End of satisfied costumers -->

      <div class='separator'></div>

      <!-- Jumbotron cart -->
      <div class='jumbotron p-3 shadow-lg' id='cart-jumbo'>
        <p class='text-center biggerText'>
          Add to cart what you want!
        </p>
        <form>
          <div class='my-3'></div>
          <!-- ORDER SECTION -->
          <div class='row d-flex justify-content-around'>
            <!-- MENU -->
            <div class='form-group'>
              <label for='menu' class='w-100 text-center'>Menu</label>
              <div class='input-group'>
                <div class='input-group-prepend'>
                  <span class='input-group-text'>
                    <i class='material-icons'>menu_book</i>
                  </span>
                </div>
                <select class='pr-2' id='menu-ddl'>
                  <?php 
                    $stm = "SELECT menu_id, menu_name, menu_price FROM menus";
                    $i = 0;
                    foreach ($conn->query($stm) as $menu) {
                      //use the first menu as default value
                      $selected = ($i == 0) ? 'selected' : '';
                  ?>  
                  <option value='<?= $menu["menu_name"]?>' 
                          <?=$selected?>
                          data-price='<?= $menu["menu_price"]?>'
                          data-menu-id='<?= $menu["menu_id"]?>'
                  > <!-- JS converts upperCase to uppercase and dash-case to dashCase -->
                    <?= $menu['menu_name']?>
                  </option>
                  <?php $i++;} ?>
                </select>
                <!-- <input required type='text' class='form-control' name='menu' id='menu'> -->
              </div>
            </div>
            <!-- MENUID -->
            <input type='number' class='d-none' id='menu-id'>
            <!-- AMOUNT -->
            <div class='form-group'>
              <label for='amount' class='w-100 text-center'>Amount</label>
              <div class='input-group'>
                <div class='input-group-prepend'>
                  <span class='input-group-text'>
                    <i class='material-icons'>add</i>
                  </span>
                </div>
                <input type='number' min='1' max='10' value='1' class='form-control' name='amount' id='amount'>
              </div>
            </div>
            <!-- PRICE -->
            <div class='form-group'>
              <label for='Price' class='w-100 text-center'>Price</label>
              <div class='input-group' id='price-inputgroup'>
                <div class='input-group-prepend'>
                  <span class='input-group-text'>
                    <i class='material-icons'>attach_money</i>
                  </span>
                </div>
                <input type='number' disabled class='form-control' name='price' id='price'>
              </div>
            </div>
          </div>
          <!-- END OF ORDER SECTION -->
          <div class='my-3'></div>
          <!-- ADD TO CART BUTTON -->
          <div class='d-flex justify-content-center'>
            <button type='button' class='btn' id='addcart-btn'>Add to cart</button>
          </div>
          <!-- END OF ADD TO CART BUTTON -->
        </form>
      </div>
      <!-- End of jumbotron order -->

      <div class='separator'></div>
      <div class='separator'></div>
      
      <!-- Jumbotron order for "registered users" -->
      <div class='jumbotron p-3 shadow-lg d-none' id='order-jumbo'>
        <img src='img/leaf.png' id='leaf-leftofjumbo'>
        <img src='img/table-with-food.png' id='jumbo-table'>
        <p class='text-center biggerText'>
          Confim your order here
        </p>
        <!-- SELECT USER -->
        <div class='d-flex justify-content-center'>
          Select user: &nbsp;
          <select class='pr-2' id='users-ddl'>
            <?php 
              $stm = "SELECT user_id, first_name, last_name, email, phone, address FROM users";
              $i = 0;
              foreach ($conn->query($stm) as $user) {
                //use the first user as default value
                $selected = ($i == 0) ? 'selected' : '';
            ?>  
            <option value='<?= $user["first_name"]." ".$user["last_name"]?>' 
                    <?=$selected?>
                    data-user-id='<?= $user["user_id"]?>'
                    data-phone='<?= $user["phone"]?>'
                    data-email='<?= $user["email"]?>'
                    data-address='<?= $user["address"]?>'
            >
              <?= $user["first_name"]." ".$user["last_name"]?>
            </option>
            <?php $i++;} ?>
          </select>
        </div>
        <div class='my-3'></div>
        <form>
          <!-- PERSONAL SECTION -->
          <div class='row d-flex flex-sm-column flex-xl-row justify-content-around'>
            <!-- ID -->
            <input type='number' class='d-none' id='user-id'>
            <!-- NAME -->
            <div class='form-group'>
              <label for='user-name' class='w-100 text-center'>Name</label>
              <div class='input-group'>
                <div class='input-group-prepend'>
                  <span class='input-group-text'>
                    <i class='material-icons'>perm_identity</i>
                  </span>
                </div>
                <input disabled type='text' class='form-control' id='user-name'>
              </div>
            </div>
            <!-- PHONE -->
            <div class='form-group'>
              <label for='phone' class='w-100 text-center'>Phone</label>
              <div class='input-group'>
                <div class='input-group-prepend'>
                  <span class='input-group-text'>
                    <i class='material-icons'>smartphone</i>
                  </span>
                </div>
                <input disabled type='tel' class='form-control' id='phone' pattern='^[0-9]{10}$' title='Please insert 10 numeric values (e.g. 01234567899)'>
              </div>
            </div>
            <!-- EMAIL -->
            <div class='form-group'>
              <label for='email' class='w-100 text-center'>Email</label>
              <div class='input-group'>
                <div class='input-group-prepend'>
                  <span class='input-group-text'>
                    <i class='material-icons'>email</i>
                  </span>
                </div>
                <input disabled type='email' class='form-control' id='email'>
              </div>
            </div>
            <!-- ADDRESS -->
            <div class='form-group'>
              <label for='address' class='w-100 text-center'>Address</label>
              <div class='input-group'>
                <div class='input-group-prepend'>
                  <span class='input-group-text'>
                    <i class='material-icons'>home</i>
                  </span>
                </div>
                <input disabled type='text' class='form-control' id='address'>
              </div>
            </div>
          </div>
          <!-- END OF PERSONAL SECTION -->
          <div class='my-3'></div>
          <!-- ORDER RECAP -->
          <div id='order-recap-container'>
            <p class='text-center biggerText'>
              Your cart:
            </p>
            <div class='row d-flex justify-content-around' id='order-recap' >
            </div>
          </div>
          <div class='my-3'></div>
          <div class='row d-flex justify-content-around'>
            <!-- DATE -->
            <div class='form-group'>
              <label for='date' class='w-100 text-center'>Date</label>
              <div class='input-group'>
                <div class='input-group-prepend'>
                  <span class='input-group-text'>
                    <i class='material-icons'>calendar_today</i>
                  </span>
                </div>
                <input required type='date' class='form-control' name='date' id='date'>
              </div>
            </div>
            <!-- TIME -->
            <div class='form-group'>
              <label for='time' class='w-100 text-center'>Time</label>
              <div class='input-group'>
                <div class='input-group-prepend'>
                  <span class='input-group-text'>
                    <i class='material-icons'>schedule</i>
                  </span>
                </div>
                <input required type='time' class='form-control' name='time' id='time'>
              </div>
            </div>
          </div>
          <!-- END OF ORDER SECTION -->
          <div class='my-3'></div>
          <!-- ORDER BUTTON -->
          <div class='d-flex justify-content-center'>
            <button type='submit' class='btn' id='order-btn'>Book now</button>
          </div>
          <!-- END OF ORDER BUTTON -->
        </form>
      </div>
      <!-- End of jumbotron order -->

      <?php
      /*
      <!-- Jumbotron order for new users -->
      <div class='jumbotron p-3 shadow-lg' id='order-jumbo'>
        <img src='img/leaf.png' id='leaf-leftofjumbo'>
        <img src='img/table-with-food.png' id='jumbo-table'>
        <p class='text-center biggerText'>
          Confim your order here
        </p>
        <form>
          <!-- PERSONAL SECTION -->
          <div class='row d-flex justify-content-around'>
            <!-- NAME -->
            <div class='form-group'>
              <label for='name' class='w-100 text-center'>Name</label>
              <div class='input-group'>
                <div class='input-group-prepend'>
                  <span class='input-group-text'>
                    <i class='material-icons'>perm_identity</i>
                  </span>
                </div>
                <input required type='text' class='form-control' id='name' value='Riccardo Testa'>
              </div>
            </div>
            <!-- PHONE -->
            <div class='form-group'>
              <label for='phone' class='w-100 text-center'>Phone</label>
              <div class='input-group'>
                <div class='input-group-prepend'>
                  <span class='input-group-text'>
                    <i class='material-icons'>smartphone</i>
                  </span>
                </div>
                <input required type='tel' class='form-control' id='phone' pattern='^[0-9]{10}$' title='Please insert 10 numeric values (e.g. 01234567899)' value='0123456789'>
              </div>
            </div>
            <!-- EMAIL -->
            <div class='form-group'>
              <label for='email' class='w-100 text-center'>Email</label>
              <div class='input-group'>
                <div class='input-group-prepend'>
                  <span class='input-group-text'>
                    <i class='material-icons'>email</i>
                  </span>
                </div>
                <input required type='email' class='form-control' id='email' value='test@email.com'>
              </div>
            </div>
            <!-- ADDRESS -->
            <div class='form-group'>
              <label for='address' class='w-100 text-center'>Address</label>
              <div class='input-group'>
                <div class='input-group-prepend'>
                  <span class='input-group-text'>
                    <i class='material-icons'>home</i>
                  </span>
                </div>
                <input required type='text' class='form-control' id='address' value='Via XX Settembre 15'>
              </div>
            </div>
          </div>
          <!-- END OF PERSONAL SECTION -->
          <div class='my-3'></div>
          <div class='row d-flex justify-content-around'>
            <!-- DATE -->
            <div class='form-group'>
              <label for='date' class='w-100 text-center'>Date</label>
              <div class='input-group'>
                <div class='input-group-prepend'>
                  <span class='input-group-text'>
                    <i class='material-icons'>calendar_today</i>
                  </span>
                </div>
                <input required type='date' class='form-control' name='date' id='date'>
              </div>
            </div>
            <!-- TIME -->
            <div class='form-group'>
              <label for='time' class='w-100 text-center'>Time</label>
              <div class='input-group'>
                <div class='input-group-prepend'>
                  <span class='input-group-text'>
                    <i class='material-icons'>schedule</i>
                  </span>
                </div>
                <input required type='time' class='form-control' name='time' id='time'>
              </div>
            </div>
          </div>
          <!-- END OF ORDER SECTION -->
          <div class='my-3'></div>
          <!-- ORDER BUTTON -->
          <div class='d-flex justify-content-center'>
            <button type='submit' class='btn' id='order-btn'>Book now</button>
          </div>
          <!-- END OF ORDER BUTTON -->
        </form>
      </div>
      <!-- End of jumbotron order -->
      */
      ?>

    </div>
  </main>
  <!-- End of main container -->

  <div class='separator'></div>

  <!-- Footer -->
  <footer class='d-flex flex-wrap align-items-end'>
    <div class='w-100 d-flex align-items-center justify-content-around'>
      <!-- SOCIAL MEDIA LINKS -->
      <div class='text-center'>
        <span class='bold'>CHOBANI</span>
        <br>
        <a class='social' href='#'>
          <img src='img/facebook.png' alt='Facebook logo' class='social-img'>
        </a>
        <a class='social' href='#'>
          <img src='img/instagram.png' alt='Instagram logo' class='social-img'>
        </a>
        <a class='social' href='#'>
          <img src='img/twitter.png' alt='Twitter logo' class='social-img'>
        </a>
      </div>
      <!-- END OF SOCIAL MEDIA LINKS -->
      <!-- NAVIGATION LINKS -->
      <div>
        <a class='special' href='#'>Shop</a>
        <br>
        <a class='special' href='#'>About</a>
        <br>
        <a class='special' href='#'>Help</a>
      </div>
      <!-- END OF NAVIGATION LINKS -->
      <!-- CONTACT US -->
      <div>
        <address>
          <div>
            <strong>Contact us</strong>
          </div>
          <div class='d-flex align-content-center'>
            <span>
              <i class='material-icons'>smartphone</i>
            </span>
            <a class='special' href='tel:+62123456789'>tel:+39123456789</a>
          </div>
          <div class='d-flex align-content-center'>
            <span>
              <i class='material-icons'>email</i>
            </span>
            <a class='special' href='mailto:chobani@choba.com'>chobani@choba.com</a>
          </div>
          <div class='d-flex align-content-center'>
            <span>
              <i class='material-icons'>home</i>
            </span>
            Indonesia
          </div>
        </address>
      </div>
      <!-- END OF CONTACT US -->
      <div>Chobani &copy;</div>
    </div>
  </footer>
  <!-- End of footer -->
</body>

</html>