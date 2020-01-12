<?php
try {
    //recuperar o id
    $idfisica = "";
    if (isset ($_GET["idfisica"])) {
        $idfisica = trim($_GET["idfisica"]);
    } else {
        throw new Exception('Requisição inválida');
    }
} catch (Exception $e) {
    echo $e->getMessage(), "\n";
    exit;
} finally {

    try {
        //verificar se o id esta em branco ou se é inválido
        $idfisica = (int)$idfisica;
        if ($idfisica == 0) {
            //mensagem de erro
            throw new Exception('Requisição inválida');
        } else {

            //incluir o conecta.php
            require "../app/conecta.php";

            //Deletar números
            $sqlN = "delete from telefone where id_fisica = ?";
            $consulta = $pdo->prepare($sqlN);
            $consulta->bindParam(1,$idfisica);
            if ($consulta->execute()) {
                //excluir endereco
                $sqlE = "delete from endereco where id_fisica = ?";
                $consulta = $pdo->prepare($sqlE);
                $consulta->bindParam(1,$idfisica);
                if ($consulta->execute()) {
                    //excluir o registro
                    $sql = "delete from p_fisica where id_fisica = ? limit 1";
                    $consulta = $pdo->prepare($sql);
                    $consulta->bindParam(1, $idfisica);
                } else {
                    throw new Exception('Erro ao deletar endereço');
                }

            } else {
                throw new Exception('Erro ao deletar número');
            }
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