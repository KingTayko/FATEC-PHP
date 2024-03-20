<?php

    #Inserindo o login padrão na tabela ADMINISTRADOR
    $adm_default = "INSERT INTO ADMINISTRADOR (user, passW) VALUES ('adm1', '123') ON DUPLICATE KEY UPDATE user = VALUES (user), passW = VALUES (passW)";
    $conn->query($adm_default); 

    #Inserindo produtos na tabela PRODUTO
    /*Obs: esses produtos serão inseridos no BDA todas as vezes que o admin realizar o login e iniciar a sessão (na página index.php)
    Então, caso seja realizado um processo de delete em um dos produtos abaixo, saiba que eles serão reenseridos quando login for realizado novament*/
    $iprod1_sql = "INSERT IGNORE INTO PRODUTO (id, nm_produto, vl_produto, qt_produto, img_produto) VALUES 
    ('1', 'Runfalcon 3.0', '259.00', '50', '(img)Adidas.jpg'),
    ('2', 'Nike Air Max SC', '399.00', '50', '(img)Nike.jpg'),
    ('3', 'Vans Old Skool', '399.00', '100', '(img)Vans.jpg'),
    ('4', 'All Star Chuck Taylor', '269.00', '100', '(img)AllStar.jpg')";
    $conn->query($iprod1_sql); 


    #Variável $conn retomando os atributos de conexão.
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>