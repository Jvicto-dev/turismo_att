<?php

require __DIR__ . '/../../../vendor/autoload.php';

use Source\Models\BodyHtml;
use Source\Models\Messages;

if (!function_exists("protect")) {
    function protect()
    {
        if (!isset($_SESSION)) {
            session_start();
            if (!isset($_SESSION['user'])) {
                header('Location:../../index.php');
            }
        }
    }
}
$idLocal = $_GET['idLocal'];

protect();
// $destinos = new Source\Controllers\ControllerDestinos();
?>
<?php
// Cabeçalho ate a div principal
include('../../../includes/head.php');
?>


<div class="main-content">
    <!-- Div principal que comporta tudo -->

    <div class="container-fluid">
        <!-- inicio menu superior que fica dentro da div principal -->
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-bar-chart-2 bg-blue"></i>
                        <div class="d-inline">
                            <h5>Dashboard</h5>
                            <span>aba destinada para o controle das operações</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">UI</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Inicio</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div> <!-- fim menu superior -->

    <!-- //////////// Começo das ações daqui, pode copiar e colar que da certo.  -->



    <div class="row">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-1">
                </div>
                <div class="col-md-10">

                    <div class="card">
                        <div class="card-header">
                            <h3>Formulario de Cadastro de Pontos de Encontro</h3>
                        </div>
                        <div class="card-body">
                            <h5>Adicionando Ponto de encontro para:  </h5> <h3 id="destino"></h3> 
                            <input type="hidden" id="id_local_destino" value="<?= $idLocal ?>"><br>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Descrição do ponto de encontro </label>
                                <textarea class="form-control" id="ponto_encontro" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputUsername1">Horário</label>
                                <input class="form-control" id="horario" type="time">
                            </div>



                            <?php

                            if ($_SESSION['user'][0]['nivel_acesso_fk'] == 1) {
                            ?>

                                <input type="hidden" id="fk_login_loja" value="<?= $_SESSION['user'][0]['id_login'] ?>">

                            <?php } else if ($_SESSION['user'][0]['nivel_acesso_fk'] == 4) { ?>

                                <input type="hidden" id="fk_login_loja" value="<?= $_SESSION['user'][0]['fk_login_loja'] ?>">

                            <?php } ?>


                            <?php

                            // var_dump($_SESSION['user'][0]['nivel_acesso_fk']);

                            ?>


                        </div>
                    </div>

                </div>
                <div class="col-md-1">
                </div>
            </div>
        </div>





    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <button type="Submit" onclick="adicionarPontoEncontro()" class="btn btn-info btn-block" name="" value="">Cadastrar</button>
            </div>
            <div class="col-md-2">
            </div>
        </div>
    </div>




    <!-- /////////// termina aqui as ações -->
</div> <!-- Fim Div Principal -->
<?php
// resto das coisas depois do "fecha div principal" 
include('../../../includes/footer.php'); ?>

<script src="../../../plugins/select2/dist/js/select2.min.js"></script>
<script src="../../../plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="../../../plugins/jquery.repeater/jquery.repeater.min.js"></script>
<script src="../../../plugins/mohithg-switchery/dist/switchery.min.js"></script>
<script src="../../../js/form-advanced.js"></script>


<script>
    function read2() {
        var id_local_destino = $("#id_local_destino").val()
       
        axios.post('../../api2/controller.php', {
            action: "read-destino-encontro-one",
            values: [
                id_local_destino
            ]
        }).then(function(response) {
            text = ""
            for (var i = 0; i < response.data.length; i++) {
                text = response.data[i].nome_destino
            }
            // $("#destino")
            document.getElementById("destino").innerHTML = text
        })
    }
    read2()


    function adicionarPontoEncontro() {
        var descricao = $("#ponto_encontro").val()
        var fk_login_loja = $("#fk_login_loja").val()
        var id_local_destino = $("#id_local_destino").val()
        var horario = $("#horario").val()
        if (descricao == "") {
            Swal.fire(
                'ERRO',
                'CADASTRE OS DADO',
                'error'

            );
        } else {
            axios.post('../../api2/controller.php', {
                action: "add_ponto",
                values: [
                    descricao,
                    horario,
                    id_local_destino,
                    fk_login_loja
                ]
            }).then(function(response) {

                Swal.fire(
                    'Cadastrado !',
                    'Ponto de Encontro cadastrado com sucesso',
                    'success'

                );
                setTimeout(function() {
                    location.href = "pontoEncontro.php";
                }, 1500);

            })
        }
    }
</script>


<?php

BodyHtml::footer();
Messages::Mensagens();

?>