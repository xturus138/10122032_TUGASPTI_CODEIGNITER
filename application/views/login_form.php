<!DOCTYPE html>
<html>

<head>
    <title>PT. Ujung Berung | Login</title>
    <!-- Login CSS -->
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <!-- Load CSS-->
    <?php include 'inc/head.php'; ?>
</head>

<body>
    <div class="container">

        <div id="form-middle">
            <form method="POST" class="form-signin" action="<?php echo
                site_url('login'); ?>">
                <center>
                    <h2 class="form-signin-heading">PT. Ujung Berung</h2>
                    <?php
                    // untuk menampilkan informasi login
                    if (isset($login_info)) {
                        echo "<font color='#ff0000';>";
                        echo $login_info;
                        echo '</font>';
                    }
                    ?>
                </center>
                <br>
                <label for="username" class="sr-only">Username</label>

                <input type="text" name="username" id="username" class="form-
control" placeholder="Username" required autofocus>

                <label for="password" class="sr-only">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password"
                    required>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            </form>
        </div>
    </div> <!-- /container -->
    <!-- Load javascript-->
    <?php include 'inc/jq.php'; ?>
</body>

</html>