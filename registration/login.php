<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
if (isset($_POST["login"])) {
    $email=$_POST["email"];
    $password=$_POST["pass"];
     require_once "conn.php";
     $sql="SELECT * FROM users WHERE email = '$email'";
     $result=mysqli_query($conn,$sql);
     $user = mysqli_fetch_array($result,MYSQLI_ASSOC);
     if ($user) {
        if (password_verify($password,$user["password"])) {
            header("Location: index.php ");
            die();
        }else {
        echo("<div class='alert alert-danger'>password does not exists!</div>") ;

        }
     }else {
        echo("<div class='alert alert-danger'>Email does not exists!</div>") ;
     }

}
?>



<div class="center" style=" display: flex;
    justify-content: center;">
    <h1>Login</h1>
</div>
<div class="container">
    <form action="login.php" method="post">
    <div class="form-group">
        <input type="email" class="form-control form-control-lg" placeholder="Enter valid email" name="email"> <br>
    </div>
    <div class="form-group">
        <input type="password"  class="form-control form-control-lg" placeholder="password please" name="pass"> <br>
    </div>
    <div class="form-btn">
        <input type="submit" class="btn btn-primary" value="login" name="login">
    </div>
    </form>
    </div>
</body>
</html>