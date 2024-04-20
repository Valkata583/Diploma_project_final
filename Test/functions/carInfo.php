<?php
include("deleteCar.php");
//echo "<div class='carInfoDiv'>";
echo "<form id='carInfoForm' class='car-info-style' action='index.php' method='POST'>";

if (isset($_POST['license'])) {
    $license = $_POST['license'];

    $sql = "SELECT * FROM static_data WHERE license = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $license);
    $stmt->execute();
    $result = $stmt->get_result();

    $row = $result->fetch_assoc();

    // Output the car information within the form
    echo '<span>Марка: ' . $row["brand"] . '</span>';
    echo '<span>Модел: ' . $row["model"] . '</span>';
    echo '<span>Категория: ' . $row["coupe"] . '</span>';
    echo '<span>Година: ' . $row["production_year"] . '</span>';
    echo '<span>Регистрационен номер: <span id="span_license">' . $row["license"] . '</span></span>';
    echo '<span>Двигател: ' . $row["type_engine"] . '</span>';
    echo '<span>Мощност [к.с.]: ' . $row["hp"] . '</span>';
    echo '<span>Кубатура [куб.м]: ' . $row["cubic"] . '</span>';
    echo '<span>Скоростна кутия: ' . $row["gearbox"] . '</span>';
    echo '<span>Големина джанти [R]: ' . $row["wheels"] . '</span>';
    echo '<span>Големина гуми [широчина/процент от широчината/R]: ' . $row["tyres"] . '</span>';
    echo '<span>Пробег [км]: ' . $row["kilometers"] . '</span>';
    echo '<span>Вид на маслото: ' . $row["oil_type"] . '</span>';

    echo '<input type="submit" id="deleteCars" class="btn-delete" name="deleteCars" value="Изтрий кола">';

    // Save the car license in session
    $_SESSION['carLicense'] = $license;
    //echo $license;
}
echo "<input type='hidden' id='licenseInput' name='license'>";

echo "</form>";
//echo "</div>";
