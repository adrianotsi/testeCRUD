<?php
//Conexão com o banco
require "../app/conecta.php";
require "../app/validaCPF.php";

try {
    //Verificação de variaveis
    foreach ($_POST as $key => $value) {
        $$key = ($value);
    }

    if (empty($_POST["nome"]))
        throw new Exception('Não foi possível identificar o nome');

    if (empty($_POST["dt_nascimento"]))
        throw new Exception('Não foi possível identificar a data de nasicmento');

    if (empty($_POST["sexo"]) | $_POST == "0")
        throw new Exception('Por favor, selecione o sexo');

    if (empty($_POST["rg"]))
        throw new Exception('Não foi possível identificar o RG');

    if (empty($_POST["cpf"]))
        throw new Exception('Não foi possível identificar o CPF');

    //Verifica CPF
    $msg = validaCPF($cpf);

    if ($msg != 1) {
        throw new Exception($msg);
    }

    //formata data
    $dt_nascimento = str_replace('/','-',$dt_nascimento);
    $dt_nascimento = new DateTime($dt_nascimento);
    $dt_nascimento = $dt_nascimento->format('Y-m-d');

} catch (Exception $e) {
    echo $e->getMessage(), "\n ";
    exit;
} finally {

    //se o id estiver vazio - INSERT
    if (empty ($idfisica)) {

        //criar um sql para insert
        $sql = "insert into p_fisica(id_fisica, cpf, nome, rg, sexo, dt_nascimento)
                values (NULL,?,?,?,?,?)";
        //utilizar o pdo para preparar o sql
        $consulta = $pdo->prepare($sql);
        //passar parametros
        $consulta->bindParam(1, $cpf);
        $consulta->bindParam(2, $nome);
        $consulta->bindParam(3, $rg);
        $consulta->bindParam(4, $sexo);
        $consulta->bindParam(5, $dt_nascimento);

    } else {
        //Atualizar dados se já existirem
        if (!empty($idfisica)) {
            $sql = "update p_fisica set
            cpf = ?,
            nome = ?,
            rg = ?,
            sexo = ?,
            dt_nascimento = ?
            where id_fisica = ? limit 1";

            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(1, $cpf);
            $consulta->bindParam(2, $nome);
            $consulta->bindParam(3, $rg);
            $consulta->bindParam(4, $sexo);
            $consulta->bindParam(5, $dt_nascimento);
            $consulta->bindParam(6, $idfisica);
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