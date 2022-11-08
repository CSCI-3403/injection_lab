<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo "Please log in to continue";
    header('Location: /login.php');
    exit(0);
} else {
    $username = $_SESSION['username'];
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
                    <div class="column is-four-fifths box">
                        <nav class="navbar pb-5" role="navigation" aria-label="main navigation">
                            <div class="navbar-menu is-active">
                                <div class="navbar-end">
                                    <div class="navbar-item">
                                        <a href="/logout.php" class="button is-size-4">Log out</a>
                                    </div>
                                </div>
                            </div>
                        </nav>
                        <article class="media">
                            <figure class="media-left">
                                <p class="image is-128x128">
                                    <img src="<?php
                                        if ($username === "admin") {
                                            echo "/static/admin.png";
                                        }
                                        else {
                                            echo "/static/user.png";
                                        }
                                    ?>" style="border-radius: 20%">
                                </p>
                            </figure>
                            <div class="media-content">
                                <div class="content">
                                    <span class="title is-size-2 is-bold has-text-black"><?php echo $username; ?></span>
                                    <p class="tagline is-size-4 has-text-grey">
                                        <?php
                                        if ($username === "admin") {
                                            echo "I like long walks on the beach and writing PHP for some reason";
                                        }
                                        else {
                                            echo "<i>No biography</i>";
                                        }
                                    ?>
                                    </p>
                                </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>