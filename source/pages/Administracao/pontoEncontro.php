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


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleSelectGender">Destinos</label>
                            <select onchange="chamaPontoEncontro()" id="select_destinos0" class="form-control" id="exampleSelectGender">

                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
            </div>
            <div class="col-md-2">

            </div>
        </div>
    </div>




    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
            </div>
            <div class="col-md-4">
            </div>
            <div class="col-md-3">
                <a onclick="addPontoEncontro()"><button type="button" class="btn btn-outline-success">Adicionar Pontos de Encontro</button></a>
            </div>
        </div>
    </div>

    <br>

    <div class="container-fluid">
        <!--div da tabela-->
        <div class="row">
            <div class="col-md-12">
                <table id="table" class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Local</th>
                            <th scope="col">Horario</th>
                            <th scope="col">Ações</th>

                        </tr>
                    </thead>
                    <tbody id="tabela_ponto_encontro">
                    </tbody>
                </table>
            </div>
        </div>
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
<script src="../../Mains/administrador_main.js"></script>


<script>
    getDestinos()

    function addPontoEncontro() {
        var id_destino = $("#select_destinos0").val()

        if (id_destino == 'xykk') {
            Swal.fire(
                'Erro!',
                'Selecione um destino antes!',
                'error'
            );
        }else{
            location.href = "pontoEncontro-Adicionar.php?idLocal=" + id_destino;

        }

    }

    function chamaPontoEncontro() {
        var id_destino = $("#select_destinos0").val()
        read(id_destino)
    }

    function read(id_destino) {
        var fk_login_loja = $("#fk_login_loja").val()
        axios.post('../../api2/controller.php', {
            action: "read-ponto-encontro",
            values: [
                fk_login_loja,
                id_destino
            ]
        }).then(function(response) {
            tbody = ""
            for (var i = 0; i < response.data.length; i++) {
                excluir = `<button type="button" class="btn btn-danger" onclick="removerLocal(` + response.data[i].id_ponto_encontro + `)">Remover</button>`;

                editar = `<button type="button" class="btn btn-primary" onclick="editarLocal(` + response.data[i].id_ponto_encontro + `)">Editar</button>`;

                tbody += `<tr>
                        <td>` + response.data[i].descricao + `</td>
                        <td>` + response.data[i].horario + ` </td>
                        <td>` + excluir + "⠀⠀" + editar + `</td>
                    </tr>`
            }
            document.getElementById("tabela_ponto_encontro").innerHTML = tbody
        })
    }
    // read()

    function removerLocal(id) {
        Swal.fire({
            title: 'Tem certeza disso ?',
            text: "Você irá apagar um ponto de encontro",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.post('../../api2/controller.php', {
                    action: "excluir-local",
                    values: [
                        id
                    ]

                }).then(function(response) {
                    Swal.fire(
                        'Sucesso',
                        'Local excluirdo com sucesso !',
                        'success'
                    );
                    setTimeout(function() {
                        location.href = "pontoEncontro.php";
                    }, 1500);

                })
            }
        })
    }

    function editarLocal(id) {
        window.location.href = "pontoEncontro-Editar.php?idLocal=" + id;
    }
</script>

<?php

BodyHtml::footer();
Messages::Mensagens();

?>