<?php
ob_start();
session_start();
   
if (isset($_POST["login"])) {
    $host = "localhost";
    $db_name = "mydb";
    $db_username = "db_service";
    $db_password = "dbservicepassword";

    $conn = new mysqli($host, $db_username, $db_password, $db_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT username FROM users WHERE username='$username' AND password='$password'";
    try {
        $result = $conn->query($sql);
    } catch (mysqli_sql_exception $e) {
        $error = "Unable to run SQL: $sql";
        $error_details = $e;
    }
    if (!isset($error)) {
        if ($result !== TRUE && $result->num_rows > 0) {
            echo "Login Success";
            $_SESSION["username"] = $result->fetch_assoc()["username"];
            header("Location: /");
            exit(0);
        }
        else {
            $error = "Incorrect username or password";
        }
    }
}
?>

<html>
    <head>
        <title>CSCI 3403: Lab 5</title>
        <link rel="stylesheet" href="/static/bulma.min.css">
        <script src="https://kit.fontawesome.com/2bd72336da.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <!-- From https://codepen.io/stevehalford/pen/YeYEOR -->
        <section class="hero is-primary is-fullheight">
        <div class="hero-body">
            <div class="container">
            <div class="columns is-centered">
                <div class="column is-four-fifths">
                <form action="/login.php" method="POST" class="box">
                    <div class="field">
                    <label for="" class="label is-size-2">Username</label>
                    <div class="control has-icons-left">
                        <input type="username" name="username" placeholder="username" class="input is-size-4" value="<?php echo $_POST['username'] ?? "" ?>" required>
                        <span class="icon is-small is-size-4 is-left">
                        <i class="fa fa-user"></i>
                        </span>
                    </div>
                    </div>
                    <div class="field">
                    <label for="" class="label is-size-2">Password</label>
                    <div class="control has-icons-left">
                        <input type="password" name="password" placeholder="*******" class="input is-size-4" required>
                        <span class="icon is-small is-size-4 is-left">
                        <i class="fa fa-lock"></i>
                        </span>
                        <?php
                            if (isset($error)) {
                                echo "<p class='help is-size-4 is-danger'>$error</p>";
                            }
                            if (isset($error_details)) {
                                echo "<p class='help is-size-4 is-danger'>$error_details</p>";
                            }
                        ?>
                    </div>
                    </div>
                    <div class="field">
                    <input type="submit" name="login" class="button is-success is-size-4" value="Login">
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
        </section>
    </body>
</html>