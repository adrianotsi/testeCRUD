<?php
try {
    //recuperar o id
    $idjuridica = "";
    if (isset ($_GET["idjuridica"])) {
        $idjuridica = trim($_GET["idjuridica"]);
    } else {
        throw new Exception('Requisição inválida');
    }
} catch (Exception $e) {
    echo $e->getMessage(), "\n";
    exit;
} finally {

    try {
        //verificar se o id esta em branco ou se é inválido
        $idjuridica = (int)$idjuridica;
        if ($idjuridica == 0) {
            //mensagem de erro
            throw new Exception('Requisição inválida');
        } else {

            //incluir o conecta.php
            require "../app/conecta.php";

            //Deletar números
            $sqlN = "delete from telefone where id_juridico = ?";
            $consulta = $pdo->prepare($sqlN);
            $consulta->bindParam(1,$idjuridica);
            if ($consulta->execute()) {
                //excluir endereco
                $sqlE = "delete from endereco where id_juridico = ?";
                $consulta = $pdo->prepare($sqlE);
                $consulta->bindParam(1,$idjuridica);
                if ($consulta->execute()) {
                    //excluir o registro
                    $sql = "delete from p_juridica where id_juridico = ? limit 1";
                    $consulta = $pdo->prepare($sql);
                    $consulta->bindParam(1, $idjuridica);
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