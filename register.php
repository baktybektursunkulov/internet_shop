<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration page</title>
    <link rel="stylesheet" href="css/linearicons.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/nouislider.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<section class="login_box_area section_gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-6" >
                <div class="login_form_inner">
                    <h3>Registration</h3>
                    <?
                    $link=mysqli_connect("localhost", "root", "root", "to_do");
                    if(isset($_POST['submit']))
                    {
                        $err = [];
                        if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
                        {
                            $err[] = "Логин может состоять только из букв английского алфавита и цифр";
                        }

                        if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)
                        {
                            $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
                        }

                        // проверяем, не сущестует ли пользователя с таким именем
                        $query = mysqli_query($link, "SELECT user_id FROM users WHERE user_login='".mysqli_real_escape_string($link, $_POST['login'])."'");

                        if(mysqli_num_rows($query) > 0)
                        {   echo "yes";
                            $err[] = "Пользователь с таким логином уже существует в базе данных";
                        }
                        if(count($err) == 0)
                        {

                            $login = $_POST['login'];
                            $password = md5(md5(trim($_POST['password'])));
                            mysqli_query($link,"INSERT INTO users SET user_login='".$login."', user_password='".$password."'");
                            $query1 = mysqli_query($link, "SELECT user_id FROM users WHERE user_login='".$login."'");
                            $data = mysqli_fetch_assoc($query1);
                            $id=$data['user_id'];
                            mysqli_query($link,"INSERT INTO user_role SET users_id='".$id."', role_id=3");
                            header("Location: login.php"); exit();
                        }
                        else
                        {
                            print "<b>При регистрации произошли следующие ошибки:</b><br>";
                            foreach($err AS $error)
                            {
                                print $error."<br>";
                            }
                        }
                    }
                    ?>
                    <form class="row login_form"  method="POST" id="contactForm" novalidate="novalidate">
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="name" name="login" placeholder="Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'">
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="password" class="form-control" id="name" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
                        </div>
                        <div class="col-md-12 form-group">
                            <input  name="submit" type="submit" value="Sign Up" class="primary-btn">

                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login_box_img">
                    <img class="img-fluid" src="img/indexl.jpg" alt="">
                    <div class="hover">
                        <h4>Are you have an account?</h4>
                        <p>Login with this button</p>
                        <a class="primary-btn" href="/login.php">Log In</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="js/vendor/jquery-2.2.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
<script src="js/vendor/bootstrap.min.js"></script>
<script src="js/jquery.ajaxchimp.min.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/jquery.sticky.js"></script>
<script src="js/nouislider.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<!--gmaps Js-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
<script src="js/gmaps.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
