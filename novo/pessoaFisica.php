<?php
try {
    if (isset ($_GET["idfisica"])) {
        //incluir o arquivo do banco
        require 'app/conecta.php';
        $idfisica = trim($_GET['idfisica']);

        $sql = "select * from p_fisica where id_fisica = ? limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(1, $idfisica);
        $consulta->execute();
        $dados = $consulta->fetch(PDO::FETCH_OBJ);
        if (!isset($dados->id_fisica)) {
            throw new Exception('Requisição inválida');
        }
        $idfisica = $dados->id_fisica;
        $cpf = $dados->cpf;
        $nome = $dados->nome;
        $rg = $dados->rg;
        $sexo = $dados->sexo;
        $dt_nascimento = $dados->dt_nascimento;

        //formata data
        $dt_nascimento = new DateTime($dt_nascimento);
        $dt_nascimento = $dt_nascimento->format('d/m/Y');
    }
} catch (Exception $e) {
    $erro = $e->getMessage();
    echo "<script>alert('$erro');history.back();</script>";
    die();
}
?>
<form class="needs-validation" novalidate method="post">
    <label for="idfisica" class="d-none">ID</label>
    <input type="text" class="d-none" id="idfisica" value="<?php if (isset($idfisica)) echo $idfisica; ?>">
    <div class="form-row">
        <div class="col-md-8 mb-4">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" placeholder="Digite seu nome completo"
                   value="<?php if (isset($nome)) echo $nome; ?>" required>
            <div class="invalid-feedback">
                Este item é obrigatório!
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="dt_nascimento">Data de Nascimento</label>
            <input type="text" class="form-control data" id="dt_nascimento" data-mask="00/00/0000"
                   placeholder="Selecione a data de nascimento"
                   autocomplete="off" value="<?php if (isset($dt_nascimento)) echo $dt_nascimento; ?>" required>
            <div class="invalid-feedback">
                Este item é obrigatório!
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-4 mb-3">
            <label for="sexo">Sexo</label>
            <div class="input-group mb-3">
                <select class="custom-select" id="sexo" required>
                    <?php if (!empty($idfisica)) {
                        echo "<option value='$sexo'>$sexo</option>";
                    } else {
                        echo "<option value=\"\">Selecione...</option>";
                    } ?>
                    <option value="Masculino">Masculino</option>
                    <option value="Feminino">Feminino</option>
                    <option value="N/A">Prefiro não informar</option>
                </select>
                <div class="invalid-feedback">
                    Este item é obrigatório!
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="rg">RG</label>
            <input type="text" name="rg" id="rg" class="form-control" placeholder="Digite somente números"
                   required oninput="this.value=this.value.replace(/[^0-9]/g,'');" value="<?php if (isset($rg)) echo $rg;?>">
            <div class="invalid-feedback">
                Este item é obrigatório!
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="cpf">CPF</label>
            <input type="text" class="form-control" id="cpf" data-mask="000.000.000-00" placeholder="Digite seu CPF"
                   value="<?php if (isset($cpf)) echo $cpf; ?>" required>
            <div class="invalid-feedback">
                Este item é obrigatório!
            </div>
        </div>
    </div>
    <button class="btn btn-primary" type="submit" id="salvarF">Salvar</button>
</form>