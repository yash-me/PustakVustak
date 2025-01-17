<?php
    
    session_start();
    
    
    
    $error = "";

    if (isset($_GET['logout'])) {
        
        // unset($_SESSION);
        // setcookie("id", "", time() - 60*60);
        // $_COOKIE["id"] = "";  

        session_destroy();
        
    // } else if ((array_key_exists("id", $_SESSION) AND $_SESSION['id']) OR (array_key_exists("id", $_COOKIE) AND $_COOKIE['id'])) {

    } else if (array_key_exists("id", $_SESSION) AND $_SESSION['id']) {  
        
        header("Location: otpConfirmation.php?email=<?php echo $_POST['email']; ?>");
        
    }


    // ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    





    if(array_key_exists("submit", $_POST)){

      include("connection.php");
      

      if(($_POST['name'] == "") or ($_POST['email'] == "") or ($_POST['otp'] == "") or ($_POST['password'] == "") or ($_POST['gender'] == "")){

          $error = '<div class="alert alert-danger" role="alert">Some field is missing!</div>';

      }

      else{

        
        if($_POST['signUp'] == '1'){

          $query = "SELECT id FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";

          $result = mysqli_query($link, $query);

          if(mysqli_num_rows($result) > 0){

            $error = '<div class="alert alert-danger" role="alert">That email is already taken.</div>';
          }

          else{

            $query = "INSERT INTO `users` (`name`, `email`, `password`, `gender`) VALUES ('".mysqli_real_escape_string($link, $_POST['name'])."', '".mysqli_real_escape_string($link, $_POST['email'])."', '".mysqli_real_escape_string($link, $_POST['password'])."', '".mysqli_real_escape_string($link, $_POST['gender'])."')";

            if (!mysqli_query($link, $query)) {

                        $error = '<div class="alert alert-danger" role="alert">Could not sign you up - please try again later.</div>';

            }
            else{

                
                $id = mysqli_insert_id($link);
                $_SESSION['id'] = $id;
                


                

                // if (isset($_POST['stayLoggedIn'])) {



                //             setcookie("id", $id, time() + 60*60*24*365);

                // } 



                 header("Location: otpConfirmation.php?email=<?php echo $_POST['email']; ?>");

            }
          }

        }

        else{


        }


      }


    }



    include("header.php");
    
     ?>

    
      
      
      <div class="jumbotron">


        <div class="cotainer">
        
          <div class="signUpForm">

            

            <label><h3 style="margin-top:-15px;">Sign Up Now!</h3></label>
            <div id="error"><?php echo $error; ?></div>

            <form method="post">

              <div class="form-group">
                
                <input type="text" class="form-control" id="exampleInputName" name="name"  placeholder="Enter name" value="<?php echo ($_POST['name']); ?>">
                
              </div>
              <div class="form-group">
                
                <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="<?php echo ($_POST['email']); ?>">
                <small id="emailHelp" class="form-text ">We'll never share your email with anyone else.</small>
              </div>
              
                
               
                <!-- <div class="form-inline">
                  
                  <div class="form-group mx-sm-4 mb-2">
                    
                    <input type="tel" class="form-control" id="inputPassword2" name="otp" placeholder="OTP received in email">
                  </div>
                  <button type="submit" name="otpSubmit" class="btn btn-primary mx-sm-4 mb-2">Confirm email(via OTP)</button>
                </div> -->
                
                
                
              
              <div class="form-group">
                
                <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password" value="<?php echo ($_POST['password']); ?>">
              </div>
              <div class="form-group">
                
                <select class="form-control" id="exampleFormControlSelect1" name="gender" value="<?php echo ($_POST['gender']); ?>">
                  <option disabled='' selected='' value=''>Select Gender</option>
                  <option>Male</option>
                  <option>Female</option>
                  <option>Others</option>
                </select>
              </div>
              <div  id="about"></div>
              <!-- <form class="form-inline">
                
                <div class="form-group mx-sm-5 mb-2">
                  <input type="tel" class="form-control" id="inputMobileNumber" placeholder="Mobile no.">
                </div>
                <div class="form-group mx-sm-5 mb-2">
                  <input type="tel" class="form-control" id="inputOtp" placeholder="OTP">
                </div>
                <button type="submit" class="btn btn-primary mb-2 mx-sm-5">SEND OTP</button>
                
              </form> -->
              

              <div class="form-group">
                 <input type="hidden" name="signUp" value="1">
                     <input type="submit" name="submit" value="Sign Up!" class="btn btn-success">
              </div>
            </form>
            

          </div>
        </div>  
        
      </div>

            <div id="intro" class="container banner text-center">
        <h1>Sell Books Easily</h1>
        <p>
          We offer a secure  eCommerce service for anyone to sell and buy books quickly and easily. You can get started selling and buying books with bookvale in just a few minutes using our simple and easy platform.
            <a role="button" data-toggle="modal" data-target="#myModal2" data-title="Seller" class="try-it">Sign up now!</a>
        </p>
       </div> 
      <div style="height:30px; background-color: #F3F7FA; margin-top: 40px;"></div> 
       <div class="conatiner text-center" style="background-color: #F3F7FA;">
        
         <i class="fas fa-credit-card" style="font-size:30px;">   Safe Payment</i>
         <i class="fas fa-shopping-cart" style="font-size:30px; margin-left: 45px; margin-right: 45px;"> Easy buy &amp; sell</i>
         <i class="fas fa-concierge-bell" style="font-size:30px;"> Best customer service</i>
        
       </div>
      <div style="height:30px; background-color: #F3F7FA;"></div>  
    


      <!-- cards-->
      <div class="container">
        <div class="card-deck">
            <div class="card">
              <img class="card-img-top" src="images/novels.jpg" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">Novels</h5>
                <p class="card-text">We provide latest and various genres of novels to our customers .</p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
              </div>
            </div>
            <div class="card">
              <img class="card-img-top" src="images/refrence.jpg" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">Refrence Books</h5>
                <p class="card-text">We have compiled a list of Best Reference Books on Engineering  Subjects. These books are used by students of top universities, institutes and colleges.</p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
              </div>
            </div>
            <div class="card">
              <img class="card-img-top" src="images/ebook.jpg" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">eBooks</h5>
                <p class="card-text">The world's leading online source of ebooks, with a vast range of ebooks from academic, popular and professional publishers.</p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
              </div>
            </div>
          </div>
        </div>
<?php include("footer.php") ?>