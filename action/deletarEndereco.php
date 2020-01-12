<?php
try {
    //recuperar o id
    $idendereco = "";
    if (isset ($_GET["idendereco"])) {
        $idendereco = trim($_GET["idendereco"]);
    } else {
        throw new Exception('Requisição inválida');
    }
} catch (Exception $e) {
    echo $e->getMessage(), "\n";
    exit;
} finally {

    try {
        //verificar se o id esta em branco ou se é inválido
        $idendereco = (int)$idendereco;
        if ($idendereco == 0) {
            //mensagem de erro
            throw new Exception('Requisição inválida');
        } else {

            //incluir o conecta.php
            require "../app/conecta.php";

            //excluir o registro
            $sql = "delete from endereco where id_endereco = ? limit 1";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(1, $idendereco);
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