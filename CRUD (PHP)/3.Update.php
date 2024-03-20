<?php
    if(!empty($_POST['UbtnId'])){

        include_once '(L)config.php';

        $Up_id = $_POST ["up_id"];
        $Up_nm = $_POST ["up_nm"];
        $Up_vl = $_POST ["up_vl"];
        $Up_qt = $_POST ["up_qt"];
        $Up_img = $_POST ["up_img"];

            
        try {
            $update = "UPDATE PRODUTO SET nm_produto=:Up_nm, vl_produto=:Up_vl, qt_produto=:Up_qt, img_produto=:Up_img WHERE id=:Up_id";
                    
            $res = $conn->prepare($update);
            $res->bindParam(":Up_nm", $Up_nm);
            $res->bindParam(":Up_vl", $Up_vl);
            $res->bindParam(":Up_qt", $Up_qt);
            $res->bindParam(":Up_img", $Up_img);
            $res->bindParam(":Up_id", $Up_id);
            $res->execute();

            $rows_up = $res->rowCount();


            $ById = "SELECT * FROM PRODUTO WHERE id = '$Up_id'";
            $res = $conn->prepare($ById);  
            $res->execute();

            $rows_sel = $res->rowCount();

            if($rows_up > 0){
                echo '<script>alert("Os dados do produto ' . $Up_id . ' foram atualizados com sucesso!")</script>';

                while($row = $res->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    echo "<br><b>Produto atualizado:</b><br><br>";
                    echo "ID: $id <br>";     
                    echo "Nome: $nm_produto <br>";    
                    echo "Preço: $vl_produto <br>";   
                    echo "Quantidade: $qt_produto <br>";      
                    echo 'Imagem:<br><img src="' . $img_produto . '" width="250px" height="250px"><br>';      
                    echo "<br><hr>";
                }
            } 
            else if($rows_up == 0 && $rows_sel == 0){
                echo '<script>alert("Não foi possível atualizar os dados do produto ' . $Up_id . '!")</script>';
                
                echo "<br><h2 style='color: #f00;' align='center'>ID inválido: O produto " .  $Up_id . " não está cadastrado no banco de dados!</h2>";
            } 
            else if($rows_up == 0 && $rows_sel > 0){
                echo '<script>alert("Não foi possível atualizar os dados do produto ' . $Up_id . '!")</script>';

                echo "<br><h2 style='color: #f00;' align='center'>Repetição de dados: O produto " .  $Up_id . " já foi atualizado!</h2>";

                while($row = $res->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    echo "<br><b>Produto atualizado:</b><br><br>";
                    echo "ID: $id <br>";     
                    echo "Nome: $nm_produto <br>";    
                    echo "Preço: $vl_produto <br>";   
                    echo "Quantidade: $qt_produto <br>";      
                    echo 'Imagem:<br><img src="' . $img_produto . '" width="250px" height="250px"><br>';      
                    echo "<br><hr>";
                }
            } 
            else{
                echo '<script>alert("Não foi possível atualizar os dados do produto ' . $Up_id . '!")</script>';
            }    
        } catch(PDOException $e) {
            echo "<br>" . $e->getMessage();
        }
        $conn = null;
    }
?>


<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <link rel="stylesheet" href="style.css">
        <link rel="shortcut icon" href="(img)ZTenis.png" type="image/x-icon">
    </head>
        <body>
            <div class="containerVoltar">
                <form method="post" action="#">
                    <input type="submit" name="voltar" value="voltar" id="nw_btnV">
                </form>
            </div>
        </body>
</html>

<?php 
    if (!empty($_POST['voltar'])){
        header("Location: areaProdutos.php");
    }
?>
