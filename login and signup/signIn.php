<?php
session_start();
//errors for login and register
$errors=[
    'login'=>$_SESSION['login_error'] ??'',
    'register'=>$_SESSION['register_error']??''];
$activeForm=$_SESSION['active_form']??'login' ;
session_unset();

function showError($error){
    if (is_array($error)) {
        $error = implode('<br>', $error);
    }
    return !empty($error)?"<p class='error-message'>$error</p>":'';
}

//function for add class active for login or register
function isActiveForm($formName,$activeForm){
    return $formName===$activeForm ? 'active' :'';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and register</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="login_register.css">
</head>
<body>
    <!--login page-->
    <div class="container <?= ($activeForm === 'register') ? 'active' : '' ?>">
        <div class="form-box <?= isActiveForm('login',$activeForm);?>" id="login">
            <form action="login_register.php" method="post">
                <h1>Login</h1>
                <?= showError($errors['login']);?>
                <div class="input-box">
                    <input type="email" name="email" placeholder="Email" required>
                    <i class='bx bx-envelope'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password"  required>
                    <i class='bx bx-lock' ></i>
                </div>
                <div class="forgot-link">
                    <a href="#">Forgot password?</a>
                </div>
                <button type="submit" class="btn" name="login" onclick="showForm('register')">Login</button>
            </form>
        </div>
       
      <!--register page-->
        <div class="form-box <?= isActiveForm('register',$activeForm);?>" id="register">
            <form action="login_register.php" method="post">
                <h1>Register</h1>
                <?= showError($errors['register']);?>
                <div class="input-box">
                    <input type="text" name="username" placeholder="Username" required>
                    <i class='bx bxs-user' ></i>
                </div>
                <div class="input-box">
                    <input type="email" name="email" placeholder="Email" required>
                    <i class='bx bx-envelope'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class='bx bx-lock' ></i>
                </div>
                <div class="radio-checked">
                    <label>
                        <input type="radio" name="role" value="artist" checked>
                        <span>Artist</span>
                    </label>
                    <label>
                        <input type="radio" name="role" value="client">
                        <span>Client</span>
                    </label> 
                </div>
                <button type="submit" class="btn" name="register" onclick="showForm('login')">Register</button>
            </form>
        </div>

         <div class="toggle-box">
            <div class="toggle-panel toggle-left">
                <h1>Hello, Welcome!</h1>
                <p>Don't have an account?</p>
                <button class="btn register-btn">Register </button>
            </div>

            <div class="toggle-panel toggle-right">
                <h1>Welcome Back!</h1>
                <p>Already have an account?</p>
                <button class="btn login-btn">Login</button>
            </div>
        </div>
    </div>
<!-- java script for change between login and register -->
    <script >document.addEventListener('DOMContentLoaded', () => {
  const container = document.querySelector('.container');
  const registerBtn = document.querySelector('.register-btn');
  const loginBtn = document.querySelector('.login-btn');

  registerBtn.addEventListener('click', () => {
    container.classList.add('active');
  });

  loginBtn.addEventListener('click', () => {
    container.classList.remove('active'); 
  });
});
</script>
    
</body>
</html>