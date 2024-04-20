<?php
$user = $_SESSION["user_id"];

$sql = "SELECT * FROM repair_shop WHERE customers = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user);
$stmt->execute();
$result = $stmt->get_result();
echo "<div id='repairShopsInfo' style='display: none;'>";
while ($row = $result->fetch_assoc()) {

    $name = $row["name_repair_shop"];
    $phone = $row["phone_number"];
    echo "<div class='car-info-style'>";
    echo "<span>Име на сервиза: $name </span><br>";
    echo "<span>Телефон: $phone </span><br>";
    echo "</br>";
    echo "</div>";
   // echo "<hr>";
}
echo "<button id='addRepairShopBut' class='repair-shop-button-style' onclick='repairShopAddForm()'>Добави сервиз</button>";
echo "</div>";

?>
