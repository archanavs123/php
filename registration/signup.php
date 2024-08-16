<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>


    <?php
  if(isset($_POST["submit"])){
    $fullname=$_POST["fname"];
    $email=$_POST["email"];
    $password1=$_POST["pass"];
    $password2=$_POST["cpass"];
    $passwordHash=password_hash($password1,PASSWORD_DEFAULT);
    $errors=array();
    if (empty($fullname) OR empty($email) OR empty($password1) OR empty($password2)){
        array_push($errors,"all fields are required");
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        array_push($errors,"Email is not valid");
    }
    if(strlen($password1)<8){
        array_push($errors,"Password must be at least 8 characters long");
    }
    if ($password1!==$password2){
        array_push($errors,"Password does not match");
    }
    require_once "conn.php";
    $sql="SELECT * FROM users WHERE email = '$email'";
    $result=mysqli_query($conn,$sql);
    $rowCount = mysqli_num_rows($result);
    if ($rowCount>0) {
        array_push($errors,"Email already exists");

    }

    if (count($errors)>0) {
        foreach($errors as $error){
            echo("<div class='alert alert-danger'>$error</div>");
        }
    }else{

    
         
           $sql="INSERT INTO users (full_name,email,password) VALUES ( ?, ?, ? )";

           $stmt=mysqli_stmt_init($conn); //initializing mysqli

          $prepareStmt= mysqli_stmt_prepare($stmt,$sql); //preparing mysqli

          if ( $prepareStmt) {
            mysqli_stmt_bind_param($stmt,"sss",  $fullname,$email,$passwordHash); // bind parameter
            mysqli_stmt_execute($stmt);
            echo("<div class='alert alert-success'>You are registered successfully!!</div>");
            header("Location: login.php ");
          }else {
            die("Something went wrong");
          } 
        }

    }

    ?>



<div class="center" style=" display: flex;
    justify-content: center;">
    <h1 >User Registration</h1>
    </div>
    <div class="container">
        <form action="signup.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control form-control-lg" placeholder="Enter Your Fullname Name" name="fname"> <br>
            </div>
            <div class="form-group">
                <input type="email" class="form-control form-control-lg" placeholder="Enter Your Email" name="email"> <br>
            </div>
            <div class="form-group">
                <input type="password" class="form-control form-control-lg" placeholder="Enter Your Password" name="pass"> <br>
            </div>
            <div class="form-group">
                <input type="password" class="form-control form-control-lg" placeholder="Repeat Password" name="cpass"> <br>
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>






        </form>
    </div>
</body>

</html>

<!-- phpmyadmin=192.168.1.25/phpmyadmin -->