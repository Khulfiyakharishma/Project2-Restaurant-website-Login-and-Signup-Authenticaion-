<?php
@include 'config.php';

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if email already exists
    $check_email_query = "SELECT email FROM user_form WHERE email='$email'";
    $check_email_result = mysqli_query($conn, $check_email_query);

    if (mysqli_num_rows($check_email_result) > 0) {
        $error[] = 'User with this email already exists!';
    } else {
        // Insert the new user into the database
        $insert = "INSERT INTO user_form (name, email, phone, password) VALUES ('$name', '$email', '$phone', '$password')";
        if (mysqli_query($conn, $insert)) {
            header('Location: login.php');
            exit();
        } else {
            $error[] = 'Error occurred while registering. Please try again.';
        }
    }

    // Display errors if any
    if (!empty($error)) {
        foreach ($error as $err) {
            echo "<p style='color: red;'>$err</p>";
        }
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Register Form</title>
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
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-size: 16px;
        }
        select {
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
                <h3>REGISTER</h3>
                <?php 
                if(isset($error)){
                    foreach($error as $err){
                        echo '<span class="error-msg">'.$err.'</span>';
                    }
                }
                ?>
                <label for="name">Name:</label>
                <input type="text" name="name" required placeholder="Enter your name"><br>
                <label for="email">Email:</label>
                <input type="email" name="email" required placeholder="Enter your email"><br>
                <label for="phone">Phone Number:</label>
                <input type="tel" name="phone" required placeholder="Enter your phone number"><br>
                <label for="password">Password:</label>
                <input type="password" name="password" required placeholder="Enter your password"><br>
                <input type="submit" name="submit" value="Register" class="form-btn">
                <p>Already have an account? <a href="login.php">Login now</a></p>
            </form>
        </div>
    </div>
</body>
</html>
