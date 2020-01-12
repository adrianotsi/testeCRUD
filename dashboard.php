<?php
require "app/conecta.php";
//Contagem de PF
$sqlPF = "select count(*) as qtd from p_fisica";
$consultaPF = $pdo->prepare($sqlPF);
$consultaPF->execute();
$dadosPF = $consultaPF->fetch(PDO::FETCH_OBJ);
$qtdPF = $dadosPF->qtd;

//Contagem de PJ
$sqlPJ = "select count(*) as qtd from p_juridica";
$consultaPJ = $pdo->prepare($sqlPJ);
$consultaPJ->execute();
$dadosPJ = $consultaPJ->fetch(PDO::FETCH_OBJ);
$qtdPJ = $dadosPJ->qtd;
?>
<div class="row">
    <div class="col-md-6">
        <div class="card text-center">
            <div class="card-header">
                <i class="fas fa-user-tie"></i> Pessoa Física
            </div>
            <div class="card-body">
                <h5 class="card-title">Visualizar ou editar dados de pessoas físicas</h5>
                <a href="index.php?op=lista&pg=pessoaFisica" class="btn btn-primary">Listar Todos</a>
                <a href="index.php?op=novo&pg=pessoaFisica" class="btn btn-primary">Novo Cadastro</a>
            </div>
            <div class="card-footer text-muted">
                Atualmente você possui <span class="badge badge-info"><?php echo $qtdPF;?></span> registros
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card text-center">
            <div class="card-header">
                <i class="fas fa-building"></i> Pessoa Jurídica
            </div>
            <div class="card-body">
                <h5 class="card-title">Visualizar ou editar dados de pessoas jurídicas</h5>
                <a href="index.php?op=lista&pg=pessoaJuridica" class="btn btn-primary">Listar Todos</a>
                <a href="index.php?op=novo&pg=pessoaJuridica" class="btn btn-primary">Novo Cadastro</a>
            </div>
            <div class="card-footer text-muted">
                Atualmente você possui <span class="badge badge-info"><?php echo $qtdPJ;?></span> registros
            </div>
        </div>
    </div>
</div>