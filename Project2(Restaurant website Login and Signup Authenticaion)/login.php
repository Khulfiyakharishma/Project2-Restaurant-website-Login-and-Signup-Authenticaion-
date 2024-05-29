<?php
@include 'config.php';

if (isset($_POST['submit'])) {
    if(isset($_POST['password'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        
        $select ="SELECT * FROM user_form WHERE email ='$email' && password = '$password\' ";
        $result = mysqli_query($conn,  $select);
        if(mysqli_num_rows($result) > 0){
            header('Location: index.php');
            $row = mysqli_fetch_array($result);
            }else{
                $error[] = 'incorrect email or password!';
            }
          }  
         };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h3 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        label {
            font-weight: bold;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-size: 16px;
        }
        .form-btn {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        .form-btn:hover {
            background-color: #0056b3;
        }
        .error-msg {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }
        p {
            text-align: center;
            margin-top: 15px;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="center">
            <form action="" method="post">
                <h3>LOGIN</h3>
<?php 
    if(isset($error)){
        foreach($error as $error){
            echo'<span class="error-msg">'.$error.'</span>';
        };
    };

    ?>
                <label for="email">Email:</label>
                <input type="email" name="email" required placeholder="Enter your email"><br><br>
                <label for="password">Password:</label>
                <input type="password" name="password" required placeholder="Enter your password"><br><br>
                <input type="submit" name="submit" value="Login" class="form-btn">
                <p>Don't have an account? <a href="register_form.php">Register now</a></p>
            </form>
        </div>
    </div>
</body>
</html>
