<?php

    #Realizando conexão com o SGBD (PhpMyAdmin)
    $servername = "localhost";
    $username = "root";
    $password = "";
  
    try {
        $conn = new PDO("mysql:host=$servername;", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    catch (PDOException $e){
        echo "Connection failed: " . $e->getMessage();
        }
    
        
    #Criando database DB_MAIN
    $cdb_sql = "CREATE DATABASE IF NOT EXISTS DB_MAIN";
    $conn->query($cdb_sql); 

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "DB_MAIN";
    

    #Realizando conexão com a database DB_MAIN
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }
    catch (PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }


    #Criando tabela ADMINISTRADOR
    $ctable_adm_sql = "CREATE TABLE IF NOT EXISTS ADMINISTRADOR (
        user VARCHAR(50) PRIMARY KEY,
        passW VARCHAR(50) NOT NULL)";
    #Utilizando a variável de conexão ($conn) para executar a query especificada.
    $conn->query($ctable_adm_sql); 


    #Criando tabela PRODUTO
    $ctable_prod_sql = "CREATE TABLE IF NOT EXISTS PRODUTO (
        id INT AUTO_INCREMENT PRIMARY KEY, 
        nm_produto VARCHAR (100) NOT NULL,
        vl_produto DECIMAL (10, 2) NOT NULL, 
        qt_produto INT NOT NULL,
        img_produto VARCHAR (100))";
    $conn->query($ctable_prod_sql); 

    #Variável $conn retomando os atributos de conexão.
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>