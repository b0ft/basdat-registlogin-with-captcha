<?php 

    session_start();

    if(!isset($_SESSION['first_name'])) {
        header('Location: login.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['first_name'] ?></h1>
    <form action="logout.php" method="post">
        <input type="submit" value="Logout">
    </form>
</body>
</html>