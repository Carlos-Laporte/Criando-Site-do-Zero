<?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';

    //connecting to database.
    try{
        $conn = new PDO("mysql:host=$servername; dbname=inventory", $username, $password);
        //set the PDO error mode to exception.
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        $error_message = "Erro na conexão: " . $e->getMessage();
        die($error_message);
    }

?>