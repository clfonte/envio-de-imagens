<?php
    /*
    // operador ternario
    // condição                   | verdadeiro                       | falso
    isset ( $_POST["descricao"] ) ? $descricao = $_POST["descricao"] : $descricao = $_GET["descricao"]; */

    // vai guardar valores que nao forem nulos
    // vai passando de condição em condição até chegar em uma que não esta em branco

    include "conexao.php";

    $descricao = $_POST["descricao"] ?? "";

    if (empty($descricao)) {
        echo '<script>alert("Preencha o campo descrição.");history.back();</script>';
        exit;
    }

        //print_r ($_FILES); 
        $arquivo = time();

    // $tipo = pathInfo($_FILES["arquivo"]["name"], PATHINFO_EXTENSION);

    // $arquivo = $arquivo.".".$tipo;

    //colocar nome do campo que vai enviar os arquivos
    if ($_FILES["arquivo"]["type"] != "image/jpeg") {
        echo '<script>alert("Não é um arquivo jpg válido.");history.back();</script>';
        exit;
        // vai mover os arquivos que fez upload         | nome temporario |destino
        // se nao conseguir mandar para a pasta arquivo ele vai renomear o arquivo 
        // com a nova mudança, vai renomear o arquivo de acordo com o "horario" enviado
    } else if (!move_uploaded_file(
        $_FILES["arquivo"]["tmp_name"],
        "arquivos/" . $_FILES["arquivo"]["name"]
    )) {
        echo '<script>alert("Não foi possível copiar.");history.back();</script>';
        exit;
    }

    // função de redimensionar
    include "imagem.php";

    LoadImg("arquivos/" . $_FILES["arquivo"]["name"], $arquivo, "arquivos/");

    $sql = "insert into arquivos (descricao, arquivo) values ( ?, ?)";
    
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(1, $descricao);
    $consulta->bindParam(2, $arquivo);

    if ( !$consulta->execute() ) {
        echo '<script>alert("Não foi possível enviar o arquivo");history.back();</script>';
        exit;
    }

    echo '<script>alert("Arquivo enviado.");history.back();</script>';
    exit;