<?php
try {
    //verificação da URL
    if (isset($_GET['idfisica'])) {
        $op = "fisica";
        $id = $_GET['idfisica'];
    } else if (isset($_GET['idjuridica'])) {
        $op = "juridica";
        $id = $_GET['idjuridica'];
    } else {
        throw new Exception('Requisição inválida');
    }

    //Edição
    if (isset ($_GET["idendereco"])) {
        //incluir o arquivo do banco
        require 'app/conecta.php';
        $idendereco = trim($_GET['idendereco']);

        $sql = "select * from endereco where id_endereco = ? limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(1, $idendereco);
        $consulta->execute();
        $dados = $consulta->fetch(PDO::FETCH_OBJ);
        if (!isset($dados->id_endereco)) {
            throw new Exception('Requisição inválida');
        }
        $idendereco = $dados->id_endereco;
        $tipoE = $dados->tipoE;
        $cep = $dados->cep;
        $logradouro = $dados->logradouro;
        $bairro = $dados->bairro;
        $cidade = $dados->cidade;
        $estado = $dados->estado;
        $numero = $dados->numero;
        $ref = $dados->ref;
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
    <label for="idEndereco" class="d-none">ID Telefone</label>
    <input type="text" class="d-none" id="idEndereco" value="<?php if (isset($idendereco)) echo $idendereco; ?>">
    <div class="form-row">
        <div class="col-md-6 mb-3">
            <label for="tipoE">Tipo</label>
            <div class="input-group mb-3">
                <select class="custom-select" id="tipoE" required>
                    <?php if (!empty($idendereco)) {
                        echo "<option value='$tipoE'>$tipoE</option>";
                    } else {
                        echo "<option value=\"\">Selecione...</option>";
                    } ?>
                    <option value="Casa">Casa</option>
                    <option value="Trabalho">Trabalho</option>
                    <option value="Outro">Outro</option>
                </select>
                <div class="invalid-feedback">
                    Este item é obrigatório!
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="cep">CEP</label>
            <input type="text" name="cep" class="form-control" data-mask="99999-999" id="cep" size="10" maxlength="9"
                   onblur="pesquisacep(this.value);" placeholder="Digite um CEP válido" required
                   value="<?php if (isset($cep)) echo $cep; ?>">
            <a href="http://www.buscacep.correios.com.br/sistemas/buscacep/" target="_blank" class="badge badge-info">Não
                sei
                meu cep?</a>
            <p class="badge badge-warning">Informações serão preenchidas automaticamente</p>
            <div class="invalid-feedback">
                Este item é obrigatório!
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-6 mb-3">
            <label for="logradouro">Logradouro</label>
            <div class="input-group mb-3">
                <input type="text" name="logradouro" class="form-control" id="rua" size="60" required
                       placeholder="Endereço Completo" value="<?php if (isset($logradouro)) echo $logradouro; ?>">
                <div class="invalid-feedback">
                    Este item é obrigatório!
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="bairro">Bairro</label>
            <div class="input-group mb-3">
                <input type="text" name="bairro" class="form-control" id="bairro" size="40" required
                       placeholder="Digite o nome do bairro" value="<?php if (isset($bairro)) echo $bairro; ?>">
                <div class="invalid-feedback">
                    Este item é obrigatório!
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-6 mb-3">
            <label for="cidade">Cidade</label>
            <div class="input-group mb-3">
                <input type="text" name="cidade" class="form-control" id="cidade" size="40" required
                       placeholder="Digite o nome da cidade" value="<?php if (isset($cidade)) echo $cidade; ?>">
                <div class="invalid-feedback">
                    Este item é obrigatório!
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="estado">Estado</label>
            <div class="input-group mb-3">
                <input type="text" name="estado" class="form-control" id="uf" size="2" maxlength="2" required
                       placeholder="Digite a sigla do estado" value="<?php if (isset($estado)) echo $estado ?>">
                <div class="invalid-feedback">
                    Este item é obrigatório!
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-6 mb-3">
            <label for="numero">Número</label>
            <div class="input-group mb-3">
                <input type="number" name="numero" class="form-control" id="numero"
                       placeholder="Digite o número da residência se houver"
                       value="<?php if (isset($numero)) echo $numero ?>">
                <div class="invalid-feedback">
                    Este item é obrigatório!
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="ref">Referência</label>
            <div class="input-group mb-3">
                <input type="text" name="ref" class="form-control" id="ref"
                       placeholder="Digite uma referência do endereço, se houver"
                       value="<?php if (isset($ref)) echo $ref ?>">
                <div class="invalid-feedback">
                    Este item é obrigatório!
                </div>
            </div>
        </div>
    </div>
    <button class="btn btn-primary" type="submit" id="salvarE">Salvar</button>
</form>