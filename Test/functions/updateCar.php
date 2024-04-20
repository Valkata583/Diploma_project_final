<?php
if(isset($_SESSION["carLicense"])){


    $licenseBefore=$_SESSION["carLicense"];
    
     
    
        // Select data from the database based on the license plate
        $sql = "SELECT * FROM static_data WHERE license = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $licenseBefore);
        $stmt->execute();
    
        // Get the result
        $result = $stmt->get_result();
    
        // Fetch the data
        $row = $result->fetch_assoc();
    
        if ($row) {
            // Extract the data from the row
            $brandBefore = $row['brand'];
            $modelBefore = $row['model'];
            $coupeBefore = $row['coupe'];
            $yearBefore = $row['production_year'];
            $engineBefore = $row['type_engine'];
            $hpBefore = $row['hp'];
            $cubicBefore = $row['cubic'];
            $gearboxBefore = $row['gearbox'];
            $wheelsBefore = $row['wheels'];
            $tyresBefore = $row['tyres'];
            $kilometersBefore = $row['kilometers'];
            $oilBefore = $row['oil_type'];
    

    }
    
    echo "
    <form id='carUpdate' class='car-info-style' method='POST' style='display: none;'>
    <button type='button' class='close' onclick='closeForm4()'>x</button>
    <label class='updateLabel' for='brand'>Марка:</label>
    <input class='updateInput' id='brand' type='text' name='brand' value='$brandBefore'>
    <br>
    <label class='updateLabel' for='model'>Модел:</label>
    <input class='updateInput' id='model' type='text' name='model' value='$modelBefore'>
    <br>
    <label class='updateLabel' for='coupe'>Категория:</label>
    <input type='text' class='updateInput' id='coupe' name='coupe' value='$coupeBefore'>
    <br>
    <label for='year' class='updateLabel' id='yearLabel'>Година:</label>
    <input type='text' class='updateInput' id='year' name='year' value='$yearBefore'>
    <br>
    <label for='engine' class='updateLabel' id='engineLabel'>Двигател</label>
    <select id='engine' name='engine'>
    <option value='Бензин'>Бензин</option>
    <option value='Бензин с газ'>Бензин с газ</option>
    <option value='Дизел'>Дизел</option>
    <option value='Електрически'>Електрически</option>
    <option value='Хибриден'>Хибриден</option>
    </select>
    <br>
    <label class='updateLabel' for='hp'>Мощност [к.с.]:</label>
    <input type='text' class='updateInput' id='hp' name='hp' value='$hpBefore'>
    <br>
    <label class='updateLabel' for='cubic'>Кубатура [куб.м]:</label>
    <input type='text' class='updateInput' id='cubic' name='cubic' value='$cubicBefore'>
    <br>
    <label class='updateLabel' for='gearbox' id='gearboxLabel'>Скоростна кутия</label>
    <select id='gearbox' name='gearbox'>
    <option value='none' selected disabled hidden>Избери</option> 
    <option value='Ръчна'>Ръчна</option>
    <option value='Автоматична'>Автоматична</option>
    </select>
    <br>
    <label class='updateLabel' for='wheels'>Големина джанти [R]:</label>
    <input type='text' class='updateInput' id='wheels' name='wheels' value='$wheelsBefore'>
    <br>
    <label class='updateLabel' for='tyres'>Големина гуми [широчина/процент от широчината/R]:</label>
    <input type='text' class='updateInput' id='tyres' name='tyres' value='$tyresBefore'>
    <br>
    <label class='updateLabel' for='kilometers'>Пробег [км]:</label>
    <input type='text' class='updateInput' id='kilometers' name='kilometers' value='$kilometersBefore'>
    <br>
    <label class='updateLabel' for='oil'>Вид на маслото:</label>
    <input type='text' class='updateInput' id='oil' name='oil' value='$oilBefore'>
    <br>";
    echo "<input type='submit' class'submit-style' id='updateCarBut' name='updateCarBut' value='Промени' onclick='updateCarForm' >";
    echo"</form> ";

    if(isset($_POST["updateCarBut"])){
    $brandUpdate = filter_input(INPUT_POST, 'brand', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $modelUpdate = filter_input(INPUT_POST, 'model', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $coupeUpdate = filter_input(INPUT_POST, 'coupe', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $yearUpdate = filter_input(INPUT_POST, 'year', FILTER_VALIDATE_INT);
    $engineUpdate = filter_input(INPUT_POST, 'engine', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $hpUpdate = filter_input(INPUT_POST, 'hp', FILTER_VALIDATE_INT);
    $wheelsUpdate = filter_input(INPUT_POST, 'wheels', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $cubicUpdate = filter_input(INPUT_POST, 'cubic', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $gearboxUpdate = filter_input(INPUT_POST, 'gearbox', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $tyresUpdate = filter_input(INPUT_POST, 'tyres', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $kmUpdate = filter_input(INPUT_POST, 'kilometers', FILTER_VALIDATE_INT);
    $oilUpdate = filter_input(INPUT_POST, 'oil', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    try {
    $sql = "UPDATE static_data SET brand=?, model=?, coupe=?, type_engine=?, hp=?, wheels=?, 
    tyres=?, oil_type=?, production_year=?, gearbox=?, cubic=?, kilometers=? WHERE license=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssisssisdis", 
        $brandUpdate, $modelUpdate, $coupeUpdate, $engineUpdate, $hpUpdate, $wheelsUpdate, 
        $tyresUpdate, $oilUpdate, $yearUpdate, $gearboxUpdate, $cubicUpdate, $kilometersUpdate, $licenseBefore);
        if ($stmt->execute()){
        echo"<script>window.location.href='index.php';</script>";
        exit;
        } else {
            echo "Error: " . $conn->error;
        }
        $stmt->close();
    }catch (mysqli_sql_exception $e){
        echo "Error: " . $e->getMessage();
    }
    }

}
    ?>