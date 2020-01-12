<?php
if (isset($_GET['idfisica'])) {
    $idfisica = $_GET['idfisica'];
} else {
    echo "<script>alert('Requisição Inválida');history.back();</script>";
}
//conectar no banco
require "app/conecta.php";
$sqlN = "select nome from p_fisica where id_fisica = ?";
$consulta = $pdo->prepare($sqlN);
$consulta->bindParam(1, $idfisica);
$consulta->execute();
$dados = $consulta->fetch(PDo::FETCH_OBJ);
if ($dados != false) {
    $nome = $dados->nome;
} else {
    echo "<script>alert('Requisição Inválida');history.back();</script>";
}

//Listar telefone
$sql = "select n.id_telefone id_telefone,n.numero telefone, n.tipoT as tipo
        from telefone n 
        inner join p_fisica p 
        on (n.id_fisica = p.id_fisica) 
        where n.id_fisica = ?";
$consulta = $pdo->prepare($sql);
$consulta->bindParam(1, $idfisica);
$consulta->execute();
$dados = $consulta->fetch(PDO::FETCH_OBJ);
if ($dados == false){
    $vazio = true;
} else {
    $vazio = false;
}
$sqlE ="select
        e.id_endereco id_endereco,e.tipoE,e.cep,e.logradouro,e.bairro,e.cidade,e.estado, e.numero,e.ref 
        from endereco e 
        inner join p_fisica p 
        on (e.id_fisica = p.id_fisica) 
        where e.id_fisica = ?";
$consultaE = $pdo->prepare($sqlE);
$consultaE->bindParam(1, $idfisica);
$consultaE->execute();
$dadosE = $consultaE->fetch(PDO::FETCH_OBJ);
if ($dadosE == false){
    $vazioE = true;
} else {
    $vazioE = false;
}
?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
        <li class="breadcrumb-item"><a href="index.php?op=lista&pg=pessoaFisica">Lista de PF</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $nome; ?></li>
    </ol>
</nav>
<div class="card text-center">
    <div class="card-header">
        <?php echo $nome; ?>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="list-group list-group-horizontal-lg" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list"
                       href="#list-home" role="tab" aria-controls="home">Telefones</a>
                    <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list"
                       href="#list-profile" role="tab" aria-controls="profile">Endereços</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="list-home" role="tabpanel"
                         aria-labelledby="list-home-list">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Tipo</th>
                                <th scope="col">Número</th>
                                <th scope="col">Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $consulta->execute();
                            while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
                                //separar os dados
                                $id_telefone = $dados->id_telefone;
                                $tipo = $dados->tipo;
                                $telefone = $dados->telefone;
                                //formar uma linha da tabela
                                echo "<tr>
                                        <td>
                                            $tipo
                                        </td>
					                    <td>$telefone</td>
                                        <td>
                    
                                            <a href=\"javascript:excluirT($id_telefone,'$tipo')\" class='btn'>
                                                <i class='fa fa-trash'></i>
                                            </a>
                                            
                                            <a href='index.php?op=novo&pg=numero&idfisica=$idfisica&idtelefone=$id_telefone' class='btn'>
                                                <i class=\"fas fa-edit\"></i>
                                            </a>
                                        </td>
				                       </tr>";
                            }
                            if ($vazio == true) {
                                echo "<tr>
                                        <td colspan='2'>Nenhum registro encontrado</td>
                                        <td>
                                            <a href='index.php?op=novo&pg=numero&idfisica=$idfisica' class='btn'>
                                                <i class=\"fas fa-plus-circle\"></i>
                                            </a>
                                        </td>
                                      </tr>";

                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Tipo</th>
                                <th scope="col">CEP</th>
                                <th scope="col">Logradouro</th>
                                <th scope="col">Bairro</th>
                                <th scope="col">Cidade</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Número</th>
                                <th scope="col">Ref.</th>
                                <th scope="col">Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $consultaE->execute();
                            while ($dadosE = $consultaE->fetch(PDO::FETCH_OBJ)) {
                                //separar os dados
                                $id_endereco = $dadosE->id_endereco;
                                $tipoE = $dadosE->tipoE;
                                $cep = $dadosE->cep;
                                $logradouro = $dadosE->logradouro;
                                $bairro = $dadosE->bairro;
                                $cidade = $dadosE->cidade;
                                $estado = $dadosE->estado;
                                $numero = $dadosE->numero;
                                $ref = $dadosE->ref;
                                //formar uma linha da tabela
                                echo "<tr>
                                        <td>
                                            $tipoE
                                        </td>
					                    <td>$cep</td>
					                    <td>$logradouro</td>
					                    <td>$bairro</td>
					                    <td>$cidade</td>
					                    <td>$estado</td>
					                    <td>$numero</td>
					                    <td>$ref</td>
                                        <td>
                    
                                            <a href=\"javascript:excluirE($id_endereco,'$tipoE')\" class='btn'>
                                                <i class='fa fa-trash'></i>
                                            </a>
                                            
                                            <a href='index.php?op=novo&pg=endereco&idfisica=$idfisica&idendereco=$id_endereco' class='btn'>
                                                <i class=\"fas fa-edit\"></i>
                                            </a>
                                        </td>
				                       </tr>";
                            }
                            if ($vazioE == true) {
                                echo "<tr>
                                        <td colspan='8'>Nenhum registro encontrado</td>
                                        <td>
                                            <a href='index.php?op=novo&pg=endereco&idfisica=$idfisica' class='btn'>
                                                <i class=\"fas fa-plus-circle\"></i>
                                            </a>
                                        </td>
                                      </tr>";

                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-muted">
        <a class="btn btn-info" href='index.php?op=novo&pg=numero&idfisica=<?php echo $idfisica; ?>'>
            <i class="fas fa-plus-circle"></i> Novo Número
        </a>
        <a class="btn btn-info" href='index.php?op=novo&pg=endereco&idfisica=<?php echo $idfisica; ?>'>
            <i class="fas fa-plus-circle"></i> Novo Endereço
        </a>
    </div>
</div>