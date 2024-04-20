<?php

if (isset($_POST["deleteCars"])) {
    
    $carLicense = $_SESSION["carLicense"];

    $query = "DELETE FROM static_data WHERE license = '$carLicense'";
    $result = mysqli_query($conn, $query);
    echo"<script>window.location.href='index.php';</script>";
}

