<?php
try {
    if (isset ($_GET["idjuridica"])) {
        //incluir o arquivo do banco
        require 'app/conecta.php';
        $idjuridica = trim($_GET['idjuridica']);

        $sql = "select * from p_juridica where id_juridico = ? limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(1, $idjuridica);
        $consulta->execute();
        $dados = $consulta->fetch(PDO::FETCH_OBJ);
        if (!isset($dados->id_juridico)) {
            throw new Exception('Requisição inválida');
        }
        $idjuridica = $dados->id_juridico;
        $cnpj = $dados->cnpj;
        $razaoSocial = $dados->razao_social;
        $nomeFantasia = $dados->nome_fantasia;
        $ie = $dados->inscricao_estadual;
        $dt_fundacao = $dados->dt_fundacao;

        //formata data
        $dt_fundacao = new DateTime($dt_fundacao);
        $dt_fundacao = $dt_fundacao->format('d/m/Y');
    }
} catch (Exception $e) {
    $erro = $e->getMessage();
    echo "<script>alert('$erro');history.back();</script>";
    die();
}
?>
<form class="needs-validation" novalidate method="post">
    <label for="idjuridica" class="d-none">ID</label>
    <input type="text" class="d-none" id="idjuridica" value="<?php if (isset($idjuridica)) echo $idjuridica; ?>">
    <div class="form-row">
        <div class="col-md-6 mb-4">
            <label for="nomeFantasia">Nome Fantasia</label>
            <input type="text" class="form-control" id="nomeFantasia" placeholder="Digite o nome fantasia"
                   value="<?php if (isset($nomeFantasia)) echo $nomeFantasia; ?>" required>
            <div class="invalid-feedback">
                Este item é obrigatório!
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <label for="razaoSocial">Razão Social</label>
            <input type="text" class="form-control" id="razaoSocial" placeholder="Digite a razão social"
                   value="<?php if (isset($razaoSocial)) echo $razaoSocial; ?>" required>
            <div class="invalid-feedback">
                Este item é obrigatório!
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-4 mb-3">
            <label for="cnpj">CNPJ</label>
            <input type="text" class="form-control" id="cnpj" data-mask="00.000.000/0000-00" placeholder="Digite o CNPJ"
                   value="<?php if (isset($cnpj)) echo $cnpj; ?>" required>
            <div class="invalid-feedback">
                Este item é obrigatório!
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="ie">Inscrição Estadual</label>
            <input type="text" name="ie" id="ie" class="form-control" placeholder="Digite a o número de IE se houver"
                   oninput="this.value=this.value.replace(/[^0-9]/g,'');" value="<?php if (isset($ie)) echo $ie; ?>">
        </div>
        <div class="col-md-4 mb-3">
            <label for="dt_fundacao">Data de Fundação</label>
            <input type="text" class="form-control data" id="dt_fundacao" data-mask="00/00/0000"
                   placeholder="Selecione a data de fundação"
                   autocomplete="off" value="<?php if (isset($dt_fundacao)) echo $dt_fundacao; ?>" required>
            <div class="invalid-feedback">
                Este item é obrigatório!
            </div>
        </div>
    </div>
    <button class="btn btn-primary" type="submit" id="salvarJ">Salvar</button>
</form>