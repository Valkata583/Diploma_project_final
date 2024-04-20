<?php
session_start();
include("./data/database.php");
$user_id = $_SESSION["user_id"];

if (!isset($_SESSION["user_id"])) {
    // Redirect the user to the login page if not logged in



    header("Location: LogIn.php");
    exit; // Stop further execution
}
if (isset($_POST["out"])) {
    session_unset();
    session_destroy();
    header("Location: LogIn.php");
    exit;
}


?>


<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link href="./style/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="wrapper">
        <!-- header -->
        <?php include("./functions/header.php"); ?>

        <!-- Car Chooser -->
        <?php include("./functions/carChoose.php"); ?>

        <?php include("./functions/leftMenu.php"); ?>
        <section class="content">
            <!-- Left menu -->

            <!-- Right side -->
            <!-- <div id="div_right"> -->

                <!-- Add car -->
                <?php include("./functions/addCar.php"); ?>

                <!-- Car data -->
                <?php include("./functions/carInfo.php"); ?>

                <!-- Delete car -->
                <!-- <?php include("./functions/deleteCar.php"); ?> -->

                <!-- Update car -->
                <?php include("./functions/updateCar.php"); ?>

                <!-- Service data -->
                <?php include("./functions/repairShopInfo.php"); ?>

                <!-- Add service -->
                <?php include("./functions/addRepairShop.php"); ?>

                <!-- Unplanned repairs data -->
                <?php include("./functions/repairInfo.php"); ?>

                <!-- Add unplanned repairs -->
                <?php include("./functions/addRepair.php"); ?>

                <!-- Changed consumes data -->
                <?php include("./functions/consumeInfo.php"); ?>

                <!-- Add changed consumes -->
                <?php include("./functions/addConsume.php"); ?>

            <!-- </div> -->
        </section>

    </div>

    <!-- footer -->
    <?php include("./functions/footer.php"); ?>

    <script src="./js/script.js"></script>
</body>

</html>