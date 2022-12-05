<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Basdat</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <input type="text" name="captcha" placeholder="Captcha">
        <img src="captcha.php" alt="Captcha Code">
        <input type="submit" name="submit" value="Login">
    </form>

    <a href="register.php">Create New Account</a>

    <?php

    session_start();

    include_once('config.php');

    if(isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $captcha = $_POST['captcha'];

        if($captcha == $_SESSION['CAPTCHA_CODE']) {
            $result = mysqli_query($connection, "SELECT * FROM users WHERE email='$email'");
            $rowresult = mysqli_num_rows($result);
            if($rowresult > 0) {
                $row = mysqli_fetch_array($result);
                $hashedPassword = $row['password'];
                $first_name = $row['first_name'];
                if(password_verify($password, $hashedPassword)) {
                    $_SESSION['first_name'] = $first_name;
                    header('Location: index.php');
                } else {
                    echo "Email or password is incorrect!";
                }
            } else {
                echo "Email or password is incorrect!";
            }
        } else {
            echo "Captcha doesn't match!";
        }

    }

    ?>

</body>
</html>