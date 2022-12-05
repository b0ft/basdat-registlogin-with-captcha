<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Basdat</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="first_name" placeholder="First Name">
        <input type="text" name="surname" placeholder="Surname">
        <input type="text" name="email" placeholder="Email">
        <input type="text" name="mobile_number" placeholder="Mobile Number">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="password_confirm" placeholder="Confirm Password">
        <input type="date" name="birthdate" placeholder="Birthdate">
        <input type="radio" name="gender" value="female">
        <label for="female">Female</label>
        <input type="radio" name="gender" value="male">
        <label for="male">Male</label>
        <input type="text" name="captcha" placeholder="Captcha">
        <img src="captcha.php" alt="Captcha Code">
        <input type="submit" name="submit" value="Register">
    </form>

    <a href="login.php">Already Have an Account</a>

    <?php
        session_start();

        include_once('config.php');

        if(isset($_POST['submit'])) {
            $first_name = $_POST['first_name'];
            $surname = $_POST['surname'];
            $password = $_POST['password'];
            $password_confirm = $_POST['password_confirm'];
            $email = $_POST['email'];
            $mobile_number = $_POST['mobile_number'];
            $birthdate = $_POST['birthdate'];
            $gender = $_POST['gender'];
            $captcha = $_POST['captcha'];

            $checkemail = mysqli_query($connection, "SELECT * FROM users WHERE email='$email'");
            $checkemailresult = mysqli_num_rows($checkemail);

            if($checkemailresult == 0) {
                if($_SESSION['CAPTCHA_CODE'] == $captcha) {
                    if($password == $password_confirm) {
                        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
    
                        $result = mysqli_query($connection, "INSERT INTO users (first_name, surname, password, email, mobile_number, birthdate, gender) VALUES ('$first_name', '$surname', '$hashPassword', '$email', '$mobile_number', '$birthdate', '$gender')");
        
                        echo "User added successfully. <a href='login.php'>Login</a>";
                    } else {
                        echo "Password doesn't match!";
                    }
                } else {
                    echo "Captcha doesn't match!";
                }
            } else {
                echo "Email already exists!";
            }
            
        }
    ?>
</body>
</html>