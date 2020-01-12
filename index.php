<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Adriano Vieira">
    <!-- Main CSS -->
    <link type="text/css" rel="stylesheet" href="style/css/style.css">
    <!-- Bootstrap CSS -->
    <link type="text/css" rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <!-- SweetAlert -->
    <link type="text/css" rel="stylesheet" href="node_modules/sweetalert2/dist/sweetalert2.min.css">
    <!-- DataTable -->
    <link type="text/css" rel="stylesheet" href="node_modules/datatables.net-dt/css/jquery.dataTables.min.css">
    <!-- Date pIcker -->
    <link type="text/css" rel="stylesheet"
          href="node_modules/jquery-datetimepicker/build/jquery.datetimepicker.min.css">
    <title>Teste - CRUD</title>
</head>
<body>
<div class="loader"></div>
<nav class="navbar navbar-expand-lg navbar-dark bg-success mb-5">
    <div class="container">
        <a class="navbar-brand" href="index.php">CRUD - Adriano</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Inicio</span></a>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#contato">
                        Contato
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="contato" tabindex="-1" role="dialog" aria-labelledby="contato"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="contato">Contato</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <a href="https://api.whatsapp.com/send?phone=5544997091798"
                                       class="btn btn-outline-success btn-lg btn-block" role="button"
                                       aria-pressed="true" target="_blank">
                                        <i class="fab fa-whatsapp-square"></i> (44) 9 9709-1798
                                    </a>
                                    <a href="mailto:tsiadriano@gmail.com" class="btn btn-outline-danger btn-lg btn-block" role="button"
                                       aria-pressed="true">
                                        <i class="fas fa-envelope-square"></i> tsiadriano@gmail.com
                                    </a>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php
$op = $pg = "";
//recuperar o op
if (isset ($_GET["op"])) {
    $op = trim($_GET["op"]);
}
if (isset ($_GET["pg"])) {
    $pg = trim($_GET["pg"]);
}
?>
<!-- MAIN CONTENT-->
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php

            if (empty ($pg)) {
                $pagina = "dashboard.php";
            } else {
                $pagina = $op . "/" . $pg . ".php";
            }

            //verificar se o arquivo existe
            if (file_exists($pagina)) {
                include $pagina;
            } else {
                echo "<h1>Erro 404</h1>
                                       <hr>
                                       <h3>Está página está em desenvolvimento...</h3>";
            }

            ?>
        </div>
    </div>
</div>
<div id="footer">
    <div class="container text-center">
        <p class="footer-block">Desenvolvido por Adriano.</p>
    </div>
</div>
<!-- SCRIPTS -->
<script type="text/javascript" src="node_modules/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="node_modules/jquery-mask-plugin/dist/jquery.mask.min.js"></script>
<script type="text/javascript" src="style/js/fontawesome.js"></script>
<script type="text/javascript" src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
<script type="text/javascript" src="node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
<script type="text/javascript"
        src="node_modules/jquery-datetimepicker/build/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript" src="style/js/style.js"></script>
<script type="text/javascript" src="app/request.js"></script>
<script>
    // loading
    $(document).ready(function () {
        $(".loader").fadeOut("slow");
    });
</script>

</body>
</html>