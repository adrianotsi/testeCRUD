<?php
//Conexão com o banco
require "../app/conecta.php";
require "../app/validaCNPJ.php";

try {
    //Verificação de variaveis
    foreach ($_POST as $key => $value) {
        $$key = ($value);
    }

    if (empty($_POST["nomeFantasia"]))
        throw new Exception('Não foi possível identificar o nome fantasia');

    if (empty($_POST["razaoSocial"]))
        throw new Exception('Não foi possível identificar a razão social');

    if (empty($_POST["cnpj"]))
        throw new Exception('Não foi possível identificar o CNPJ');

    if (empty($_POST["ie"]))
        $ie = "Isento";

    if (empty($_POST["dt_fundacao"]))
        throw new Exception('Não foi possível identificar a data de fundação');

    //Verifica CNPJ
    $msg = validaCNPJ($cnpj);

    if ($msg != 1) {
        throw new Exception($msg);
    }

    //formata data
    $dt_fundacao = str_replace('/','-',$dt_fundacao);
    $dt_fundacao = new DateTime($dt_fundacao);
    $dt_fundacao = $dt_fundacao->format('Y-m-d');

} catch (Exception $e) {
    echo $e->getMessage(), "\n ";
    exit;
} finally {

    //se o id estiver vazio - INSERT
    if (empty ($idjuridica)) {

        //criar um sql para insert
        $sql = "insert into p_juridica(id_juridico,cnpj,razao_social,nome_fantasia,inscricao_estadual,dt_fundacao)
                values (NULL,?,?,?,?,?)";
        //utilizar o pdo para preparar o sql
        $consulta = $pdo->prepare($sql);
        //passar parametros
        $consulta->bindParam(1, $cnpj);
        $consulta->bindParam(2, $razaoSocial);
        $consulta->bindParam(3, $nomeFantasia);
        $consulta->bindParam(4, $ie);
        $consulta->bindParam(5, $dt_fundacao);

    } else {
        //Atualizar dados se já existirem
        if (!empty($idjuridica)) {
            $sql = "update p_juridica set
            cnpj = ?,
            razao_social = ?,
            nome_fantasia = ?,
            inscricao_estadual = ?,
            dt_fundacao = ?
            where id_juridico = ? limit 1";

            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(1, $cnpj);
            $consulta->bindParam(2, $razaoSocial);
            $consulta->bindParam(3, $nomeFantasia);
            $consulta->bindParam(4, $ie);
            $consulta->bindParam(5, $dt_fundacao);
            $consulta->bindParam(6, $idjuridica);
            $op = "atualizado";
        }
    }
    //verificar se os comandos foram executados
    try {
        if ($consulta->execute()) {
            if (isset($op)) {
                echo "sucesso $op";
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