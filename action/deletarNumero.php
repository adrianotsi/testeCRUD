<?php
try {
    //recuperar o id
    $idtelefone = "";
    if (isset ($_GET["idtelefone"])) {
        $idtelefone = trim($_GET["idtelefone"]);
    } else {
        throw new Exception('Requisição inválida');
    }
} catch (Exception $e) {
    echo $e->getMessage(), "\n";
    exit;
} finally {

    try {
        //verificar se o id esta em branco ou se é inválido
        $idtelefone = (int)$idtelefone;
        if ($idtelefone == 0) {
            //mensagem de erro
            throw new Exception('Requisição inválida');
        } else {

            //incluir o conecta.php
            require "../app/conecta.php";

            //excluir o registro
            $sql = "delete from telefone where id_telefone = ? limit 1";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(1, $idtelefone);
        }
        //verificar se excluiu mesmo
        if ($consulta->execute()) {
            //se deu certo
            echo "sucesso";
            die();
        } else {
            $erro = $consulta->errorInfo()[2];
            //0 - codigo 2 - mensagem de erro [2]
            throw new Exception($erro);
        }
    } catch (Exception $e) {
        echo $e->getMessage(), "\n";
        exit;
    }
}