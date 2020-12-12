<?php
    $logged_in = isset($_SESSION["logged_in"]) ? $_SESSION["logged_in"] : null;
?>
<div id="navbar" class="navbar">
    <h2>Salence</h2>
    <div class="toggler" id="toggler"><i class="fa fa-bars"></i></div>
    <ul class="floater" id="floater">
        <?php
            if ($logged_in == true) {
        ?>
                <li><a href="logout.php">Log out</a></li>
                <?php
            } else{
        ?>
        <li><a href="login.php">Log in</a></li>
        <li><a href="register.php">Register</a></li>
        <?php
            }
        ?>
        <li><a href="create.php">Create letter</a></li>
    </ul>
</div>

<script src="js/toggler.js"></script>
