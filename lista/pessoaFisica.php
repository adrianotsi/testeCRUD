<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
        <li class="breadcrumb-item active" aria-current="page">Lista de PF</li>
    </ol>
</nav>
<h1>Lista de Pessoas Físicas</h1>
<hr>
<table class="table table-bordered table-hover table-light display" id="lista">
    <thead>
    <tr class="bg-light">
        <th scope="col">Nome</th>
        <th scope="col">CPF</th>
        <th scope="col">RG</th>
        <th scope="col">Sexo</th>
        <th scope="col">Nascimento</th>
        <th class="noExport" scope="col">Opções</th>
    </tr>
    </thead>
    <tbody>

    <?php
    //conectar no banco
    require "app/conecta.php";
    //selecionar todos os professores
    $sql = "select * from p_fisica order by nome";
    $consulta = $pdo->prepare($sql);
    $consulta->execute();

    while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
        //separar os dados
        $idfisica = $dados->id_fisica;
        $cpf = $dados->cpf;
        $nome = $dados->nome;
        $rg = $dados->rg;
        $sexo = $dados->sexo;
        $dt_nascimento = $dados->dt_nascimento;

        //formata data
        $dt_nascimento = new DateTime($dt_nascimento);
        $dt_nascimento = $dt_nascimento->format('d/m/Y');

        //formar uma linha da tabela
        echo "<tr>
					<td>
						$nome
					</td>
					<td>$cpf</td>
					<td>$rg</td>
					<td>$sexo</td>
					<td>$dt_nascimento</td>
					<td>

						<a href=\"javascript:excluirPF($idfisica,'$nome')\" class='btn'>
							<i class='fa fa-trash'></i>
						</a>

						<a href='index.php?op=view&pg=pFisica&idfisica=$idfisica' class='btn'>
							<i class=\"far fa-eye\"></i>
						</a>
						
						<a href='index.php?op=novo&pg=pessoaFisica&idfisica=$idfisica' class='btn'>
							<i class=\"fas fa-edit\"></i>
						</a>
					</td>
				</tr>";
    }
    ?>

    </tbody>
</table>