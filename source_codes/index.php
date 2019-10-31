<link href='styles/style.css' rel='stylesheet' type='text/css'>
<?php
session_start();
include("functions/functions.php");

?>
<!--header begin -->
<div id="navwrapper">
  <div id="navbar"> 
    


    <form method="post" action="" id="form1">
      <div align="left">
        
      
    <table class="tablewrapper">
    <tr>
      
      <td class="row1">Email or Phone</td>
      <td class="row1">Password</td>
    </tr>
    <tr>

      <td><input type="text" name="email" placeholder="name@domain.com" class="inputtext">
      </td>
      <td><input type="password"name="pass" placeholder="********" class="inputtext">
      </td>
      <td><div ><button name="login">Login</button></div></td>
    </tr>
    
  </table>
    </form>
    <div align=left>
    <img src="image/logo.png" height=75 width=400 class="logowrap">
  </div>
    
   
  </div>
  </div>
<!--header ends-->
<!--contebt begins-->
<form action="" method="post" enctype="multipart/form-data" >
  <div id="contentwrapper">
<div id="backpage">

    <div id="content">
    
   
      <div id="leftbod">


        
        <div class="connect bolder">
          Join the largest educational network </div>
        
        <div class="leftbar">
          <img src="image\back.png" alt="" class="iconwrap fb1"/>
          
           
        </div> 
       
            
      </div>
       
      <div id="rightbod">
        <div class="signup bolder">Sign Up</div>
        <div class="free bolder">It's free and always will be</div>
        
        <div class="formbox">
        <input type="text" name="u_name" class="inputbody in1" placeholder="Enter your name" required="required">
        
        </div>
       
        <div class="formbox">
        <input type="email" name="u_email" class="inputbody in2" placeholder="enter your email "  required="required">
        </div>
        <div class="formbox">
        <input type="password" name="u_pass" class="inputbody in2" placeholder="enter your password"  required="required">
        </div>
        <div class="formbox">
         <select name="u_country" required="required" class="inputbody in2" placehorder="select country">
          <option>select country</option>
          <option>Afghanistan</option>
          <option>India</option>
          <option>USA</option>
          <option>UK</option>
          <option>Bangladesh</option>
          <option>Afganistan</option>
          <option>New Zealand</option>
        </select>

        </div>
         <div class="formbox">
          <div class="bday">PROFILE PICTURE</div>
        <input type="file" name="u_image" class="inputbody in2"   required="required">
        </div>
        <div class="formbox">

          <div class="bday">DOB</div>
        </div>

        <div class="formbox">
           <input type="date" name="u_birthday" class="inputbody in2">
        </div>
          
            <div class="formbox mt1">
              <span data-type="radio" class="spanpad">
                <input type="radio" id="fem" class="m0" name="u_gender" value="Female">
                <label for="fem" class="gender" >Female
                </label>
                <input type="radio" id="male" class="m0" name="u_gender" value="Male">
                <label for="male" class="gender">Male
                </label>
              </span>
            </div>
              
            <div class="formbox">
              <div class="agree">
                By clicking Sign Up, you agree to our <div class="link">Terms</div> and that you have read our <div class="link">Data Use Policy</div>, including our <div class="link">Cookie Use</div>.
              </div>  
            </div>
            <div class="formbox">
              <button name="sign_up" class="signbut bolder">Sign up</button>
            </div>
          </div>
      </div>
     </div>
    </div>
</form>
<?php
include("user_insert.php");

?>
  <!--conten ends-->
  <?php
include("template/footer.php");
include("login.php");

  ?>
