
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dang ky</title>
</head>
<body>
    <h2>Dang ky</h2>
    <form method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Dang ky</button>
    </form>

    <?php if (isset($error)) { echo "<p>$error</p>"; } ?>

    <p>Ban da co tai khoan? <a href="index.php">Dang nhap</a></p>
</body>
</html>
<?php

$conn = new mysqli('localhost', 'root', '', 'test');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$username ='';
$password ='';
$result = 0;
if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    if (!empty($username)&&!empty($password)) {
    $checkUserexists = "SELECT * FROM username WHERE username = '$username';";
    $result = $conn->query($checkUserexists);
    if ($result->num_rows > 0 && $result !== NULL) {
        $error = "Tai khoan nay da co nguoi khac su dung. Vui long dang ky voi ten nguoi dung khac";
        echo $error;
    }
        else {
            $insert_user = "INSERT INTO username (username,password,so_tien) values ('$username','$password','0');";
        if ($conn->query($insert_user) === TRUE)    {
            // header('Location:test.php');
            echo "Ban da dang ky thanh cong!";
            exit();
        }
        else{
            $error = "Error: " . $conn->error;
        }
        }
}
}
    else {
    $error = "username va password khong duoc de trong!";
}

?>