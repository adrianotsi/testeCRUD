<?php
//Conexão com o banco
require "../app/conecta.php";

try {
    //Verificação de variaveis
    foreach ($_POST as $key => $value) {
        $$key = ($value);
    }

    if (empty($_POST["tipoT"]))
        throw new Exception('Não foi possível identificar o tipo');

    if (empty($_POST["numero"]))
        throw new Exception('Não foi possível identificar o número');

} catch (Exception $e) {
    echo $e->getMessage(), "\n ";
    exit;
} finally {

    //se o id estiver vazio - INSERT
    if (empty ($idtelefone)) {

        //criar um sql para insert
        if ($op == "fisica") {
            $sql = "insert into telefone(id_telefone, tipoT, numero, id_fisica)
                values (NULL,?,?,?)";
        } else if ($op == "juridica") {
            $sql = "insert into telefone(id_telefone, tipoT, numero, id_juridico)
                values (NULL,?,?,?)";
        }
        //utilizar o pdo para preparar o sql
        $consulta = $pdo->prepare($sql);
        //passar parametros
        $consulta->bindParam(1, $tipoT);
        $consulta->bindParam(2, $numero);
        $consulta->bindParam(3, $idOp);
    } else {
        //Atualizar dados se já existirem
        $sql = "UPDATE telefone SET
                tipoT = ?,
                numero = ? 
                WHERE telefone.id_telefone = ?;";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(1, $tipoT);
        $consulta->bindParam(2, $numero);
        $consulta->bindParam(3, $idtelefone);
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