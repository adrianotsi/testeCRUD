<?php
try {
    //verificação da URL
    if (isset($_GET['idfisica'])){
        $op = "fisica";
        $id = $_GET['idfisica'];
    } else if (isset($_GET['idjuridica'])){
        $op = "juridica";
        $id = $_GET['idjuridica'];
    } else {
        throw new Exception('Requisição inválida');
    }

    //Edição
    if (isset ($_GET["idtelefone"])) {
        //incluir o arquivo do banco
        require 'app/conecta.php';
        $idtelefone = trim($_GET['idtelefone']);

        $sql = "select * from telefone where id_telefone = ? limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(1, $idtelefone);
        $consulta->execute();
        $dados = $consulta->fetch(PDO::FETCH_OBJ);
        if (!isset($dados->id_telefone)) {
            throw new Exception('Requisição inválida');
        }
        $idtelefone = $dados->id_telefone;
        $tipoT = $dados->tipoT;
        $numero = $dados->numero;
    }
} catch (Exception $e) {
    $erro = $e->getMessage();
    echo "<script>alert('$erro');history.back();</script>";
    die();
}
?>
<form class="needs-validation" novalidate method="post">
    <label for="op" class="d-none">Operação</label>
    <input type="text" class="d-none" id="op" value="<?php echo $op; ?>">
    <br>
    <label for="idOp" class="d-none">Id Operação</label>
    <input type="text" class="d-none" id="idOp" value="<?php echo $id; ?>">
    <label for="idTelefone" class="d-none">ID Telefone</label>
    <input type="text" class="d-none" id="idTelefone" value="<?php if (isset($idtelefone)) echo $idtelefone; ?>">
    <div class="form-row">
        <div class="col-md-6 mb-3">
            <label for="tipoT">Tipo</label>
            <div class="input-group mb-3">
                <select class="custom-select" id="tipoT" required>
                    <?php if (!empty($idtelefone)) {
                        echo "<option value='$tipoT'>$tipoT</option>";
                    } else {
                        echo "<option value=\"\">Selecione...</option>";
                    } ?>
                    <option value="Celular">Celular</option>
                    <option value="Comercial">Comercial</option>
                    <option value="Residencial">Residencial</option>
                    <option value="Recado">Recado</option>
                </select>
                <div class="invalid-feedback">
                    Este item é obrigatório!
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="numer">Número</label>
            <input type="text" name="numero" id="numero" class="form-control" placeholder="Digite somente números"
                   required data-mask="(00)00000-0000" value="<?php if (isset($numero)) echo $numero; ?>">
            <div class="invalid-feedback">
                Este item é obrigatório!
            </div>
        </div>
    </div>
    <button class="btn btn-primary" type="submit" id="salvarN">Salvar</button>
</form>