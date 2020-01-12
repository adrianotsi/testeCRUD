<?php
//Conexão com o banco
require "../app/conecta.php";

try {
    //Verificação de variaveis
    foreach ($_POST as $key => $value) {
        $$key = ($value);
    }

    if (empty($_POST["tipoE"]))
        throw new Exception('Não foi possível identificar o tipo');

    if (empty($_POST["numero"]))
        throw new Exception('Não foi possível identificar o número');

} catch (Exception $e) {
    echo $e->getMessage(), "\n ";
    exit;
} finally {

    //se o id estiver vazio - INSERT
    if (empty ($idendereco)) {

        //criar um sql para insert
        if ($op == "fisica") {
            $sql = "insert into endereco(id_endereco, tipoE, cep,logradouro,bairro,cidade,estado,numero,ref, id_fisica)
                values (NULL,?,?,?,?,?,?,?,?,?)";
        } else if ($op == "juridica") {
            $sql = "insert into endereco(id_endereco, tipoE, cep,logradouro,bairro,cidade,estado,numero,ref, id_juridico)
                values (NULL,?,?,?,?,?,?,?,?,?)";
        }
        //utilizar o pdo para preparar o sql
        $consulta = $pdo->prepare($sql);
        //passar parametros
        $consulta->bindParam(1, $tipoE);
        $consulta->bindParam(2, $cep);
        $consulta->bindParam(3, $logradouro);
        $consulta->bindParam(4, $bairro);
        $consulta->bindParam(5, $cidade);
        $consulta->bindParam(6, $estado);
        $consulta->bindParam(7, $numero);
        $consulta->bindParam(8, $ref);
        $consulta->bindParam(9, $idOp);
    } else {
        //Atualizar dados se já existirem
        $sql = "UPDATE endereco SET
                tipoE = ?,
                cep = ?,
                logradouro = ?,
                bairro = ?,
                cidade = ?,
                estado = ?,
                numero = ?,
                ref = ? 
                WHERE endereco.id_endereco = ?;";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(1, $tipoE);
        $consulta->bindParam(2, $cep);
        $consulta->bindParam(3, $logradouro);
        $consulta->bindParam(4, $bairro);
        $consulta->bindParam(5, $cidade);
        $consulta->bindParam(6, $estado);
        $consulta->bindParam(7, $numero);
        $consulta->bindParam(8, $ref);
        $consulta->bindParam(9, $idendereco);
        $at = "atualizado";
    }
    //verificar se os comandos foram executados
    try {
        if ($consulta->execute()) {
            if (isset($at)) {
                echo "sucesso $at";
            } else {
                echo "sucesso";
            }
        } else {
            //recuperar erro - array
            $erro = $consulta->errorInfo()[2];
            //0 - codigo 2 - mensagem de erro [2]
            throw new Exception($erro);
        }
    } catch (Exception $e) {
        echo $e->getMessage(), "\n ";
        exit;
    }
}