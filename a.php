
<?php
session_start();

if (isset($_GET["logout"])) {
    session_destroy();
    setcookie("username", "", time()-3600, "/");
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = trim($_POST["username"]);
    $pass = $_POST["password"];

    if ($user == "admin" && $pass == "1234") {
        $_SESSION["user"] = $user;
        setcookie("username", $user, time()+3600, "/");
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<?php if (isset($_SESSION["user"])) { ?>

    <h2>Welcome <?php echo htmlspecialchars($_SESSION["user"]); ?>!</h2>
    <a href="?logout=1">Logout</a>

<?php } else { ?>

    <h2>Login Form</h2>

    <form method="post">
        <input name="username" placeholder="Username" required>
        <input type="password" name="password"
               placeholder="Password" required>
        <button type="submit">Login</button>
    </form>

    <p style="color:red">
        <?php echo $error ?? ""; ?>
    </p>

<?php } ?>
