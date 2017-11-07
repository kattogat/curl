<form method="post" action="form.php">
    <label>Namn</label><br>
    <input name="name" type="text"><br>  
    <label>animal</label><br>
    <input type="text" name="animal"><br>
    <input type="submit" text="Sänd">  
</form>

<?php
    require "config.php";

    $nam = $_POST["name"];
    $ani = $_POST["animal"];

    $sql = "INSERT INTO form (name, animal)
    VALUES(:nameuo, :animaluo)";
    $intoDb = $pdo->prepare($sql);
    $intoDb->execute (array(':nameuo' => $nam, ':animaluo' => $ani)); 

?>