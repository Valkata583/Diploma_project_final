<?php
// Check if 'carLicense' is set in the session
if (isset($_SESSION['carLicense'])) {
    // Access the 'carLicense' from the session
    $car_license = $_SESSION['carLicense'];
    
    $sql = "SELECT unplaned_repairs.*, repair_shop.name_repair_shop FROM unplaned_repairs LEFT JOIN repair_shop ON unplaned_repairs.repair_shop = repair_shop.id WHERE car=?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $car_license);
    $stmt->execute();
    
    $result = $stmt->get_result();
    
    echo "<div id='repairsInfo' class='repairsInfo-style' style='display: none;'>";

    while ($row = $result->fetch_assoc()) {
        // Now you can use $car_license wherever you need it
        $type = $row["unplanned_type"];
        $date = $row["date_repair"];
        $km = $row["kilometers"];
        $description = $row["description_repair"];
        $name = $row["name_repair_shop"];
        $price = $row["price"];
        
        echo "<div class='car-info-style'>";
        echo "<span>Вид на ремонта: $type </span>";
        echo "<span>Описание: $description </span>";
        echo "<span>Километри: $km </span>";
        echo "<span>Дата: $date </span>";
        echo "<span>Сервиз: $name </span>";
        echo "<span>Цена: $price </span>";
        echo"</div>";
        //echo "Car license: " . $car_license;
    }

    echo "<button id='addRepairsInfoBut' class='repairs-button-style' onclick='repairsAddForm()'>Обнови списъка</button>";

    echo "</div>";
}

// else {
//     echo "Car license is not set in the session.";
//  }
