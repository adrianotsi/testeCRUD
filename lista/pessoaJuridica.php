<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
        <li class="breadcrumb-item active" aria-current="page">Lista de PJ</li>
    </ol>
</nav>
<h1>Lista de Pessoas Jurídicas</h1>
<hr>
<table class="table table-bordered table-hover table-light display" id="lista">
    <thead>
    <tr class="bg-light">
        <th scope="col">Razão Social</th>
        <th scope="col">Nome Fantasia</th>
        <th scope="col">CNPJ</th>
        <th scope="col">Inscrição Estadual</th>
        <th scope="col">Fundação</th>
        <th class="noExport" scope="col">Opções</th>
    </tr>
    </thead>
    <tbody>

    <?php
    //conectar no banco
    require "app/conecta.php";
    //selecionar todos os professores
    $sql = "select * from p_juridica order by nome_fantasia";
    $consulta = $pdo->prepare($sql);
    $consulta->execute();

    while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
        //separar os dados
        $idjuridica = $dados->id_juridico;
        $cnpj = $dados->cnpj;
        $razaoSocial = $dados->razao_social;
        $nomeFantasia = $dados->nome_fantasia;
        $ie = $dados->inscricao_estadual;
        $dt_fundacao = $dados->dt_fundacao;

        //formata data
        $dt_fundacao = new DateTime($dt_fundacao);
        $dt_fundacao = $dt_fundacao->format('d/m/Y');

        //formar uma linha da tabela
        echo "<tr>
					<td>
						$razaoSocial
					</td>
					<td>$nomeFantasia</td>
					<td>$cnpj</td>
					<td>$ie</td>
					<td>$dt_fundacao</td>
					<td>

						<a href=\"javascript:excluirPJ($idjuridica,'$nomeFantasia')\" class='btn'>
							<i class='fa fa-trash'></i>
						</a>

						<a href='index.php?op=view&pg=pJuridica&idjuridica=$idjuridica' class='btn'>
							<i class=\"far fa-eye\"></i>
						</a>
						
						<a href='index.php?op=novo&pg=pessoaJuridica&idjuridica=$idjuridica' class='btn'>
							<i class=\"fas fa-edit\"></i>
						</a>
					</td>
				</tr>";
    }
    ?>

    </tbody>
</table>