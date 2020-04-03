<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fomulário</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body> 
    <!-- enctype serve para quando for enviar arquivo -->
    <form class="container" name="form1" method="post" action="ex01.php" enctype="multipart/form-data"> 
        <h1>Fomulário</h1>
        <label for="descricao">Descrição</label>
        <input type="text" name="descricao" class="form-control" required>

        <label for="arquivo">Arquivo</label>
        <input type="file" name="arquivo" class="form-control" required accept=".jpg,.jpeg,.png">

        <br>

        <button type="submit" class="btn btn-outline-info">Enviar</button>
    </form>
    <br>

    <h2> Imagens cadastradas</h2>

    <div class="row">

        <?php
            include "conexao.php";

            $sql = "select descricao, arquivo from arquivos";
            $consulta = $pdo->prepare($sql);
            $consulta->execute();

            while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
                //separar dados
                $descricao  = $dados->descricao;
                $arquivo     = $dados->arquivo;

                //echo $arquivo. '<br>'; 
                $arquivop = 'arquivos/'. $arquivo . 'p.jpg';
                $arquivog = 'arquivos/'. $arquivo . 'g.jpg';
                
                //echo $arquivog. '<br>';

                echo '<div class="col-4">
                        <a href="'.$arquivog.'">
                            <img src="'.$arquivop.'" alt="'.$descricao.'" title="'.$descricao.'" class="w-100">
                        </a>
                    </div>'; 
            }
        ?>

    </div>

</body>
</html>