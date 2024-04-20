<?php
$username = $_SESSION["username"];
echo "
<header>
    <img src='./images/valkar-logo-site.png' alt='Лого Валкар' class='logo'>

    <button id='add_car' onclick='addForm()'>+ автомобил</button>

    <button class='but' onclick='cars()'>Коли</button>

    <button class='but' id='repairShopButton' name='repairShopButton' onclick='repairShopForm()'>+ сервизи</button>

    <div class='profile'>
        <h1 class='username'>$username</h1>
        <form method='POST'>
            <button id='logoutbutton' type='submit' name='out'>Изход</button>
        </form>
    </div>
</header>";
