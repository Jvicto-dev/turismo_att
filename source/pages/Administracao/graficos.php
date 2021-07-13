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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.1.1/chart.min.js"></script>







    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>GRAFICO DE VENDAS</h3>
                </div>

                <br>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleSelectGender">Destino</label>
                        <select class="form-control" id="select_destinos0">


                        </select>
                    </div>

                    <button onclick="valuesGraph()" type="button" class="btn btn-secondary"><i class="ik ik-clipboard"></i>Gerar Grafico</button>

                </div>




                <div class="card-block">

                    <canvas id="myChart"></canvas>

                </div>
            </div>
        </div>

    </div>

    <br><br>
    <!-- /////////// termina aqui as ações -->
</div> <!-- Fim Div Principal -->




<footer class="footer">
    <div class="w-100 clearfix">
        <span class="text-center text-sm-left d-md-inline-block">Copyright © 2021 RedTag-Mobile All Rights Reserved.</span>
        <span class="float-none float-sm-right mt-1 mt-sm-0 text-center">Crafted with <i class="fa fa-heart text-danger"></i> by <a href="http://lavalite.org/" class="text-dark" target="_blank">Jv and Company</a></span>
    </div>
</footer>

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



<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
    window.jQuery || document.write('<script src="src/js/vendor/jquery-3.3.1.min.js"><\/script>')
</script>
<script src="../../../plugins/popper.js/dist/umd/popper.min.js"></script>
<script src="../../../plugins/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../../../plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
<script src="../../../plugins/screenfull/dist/screenfull.js"></script>
<script src="../../../plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../../plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../../plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../../plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<script src="../../../plugins/jvectormap/jquery-jvectormap.min.js"></script>
<script src="../../../plugins/jvectormap/tests/assets/jquery-jvectormap-world-mill-en.js"></script>
<script src="../../../plugins/moment/moment.js"></script>
<script src="../../../plugins/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="../../../plugins/d3/dist/d3.min.js"></script>
<script src="../../../plugins/c3/c3.min.js"></script>
<script src="../../../js/tables.js"></script>
<script src="../../../js/widgets.js"></script>

<script src="../../../dist/js/theme.min.js"></script>
<script src="../../../plugins/axios/axios.js"></script>
<script src="../../Mains/administrador_main.js"></script>


<script>
    var ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['JAN', 'FEV', 'MARC', 'ABRIL', 'MAIO', 'JUN', 'JUL', 'AGO', 'SET', 'OUT', 'NOV', 'DEZ'],
            datasets: [{
                label: 'Vendas',
                data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                borderWidth: 6,
                borderColor: 'rgba(77,166,253,0.85)',
                backgroundcolor: 'trasnparent'

            }, ],
        },
        options: {}
    });

    // quando clicar, muda os valores do grafico
    function valuesGraph() {
        values_month = []
        axios.post('../../api2/controller.php', {
            action: "values-graph",
            values: [
                $("#select_destinos0").val(),
                $("#fk_login_loja").val()
            ]

        }).then(function(response) {

            values_month.push(response.data[0].janeiro)
            values_month.push(response.data[0].fevereiro)
            values_month.push(response.data[0].marco)
            values_month.push(response.data[0].abril)
            values_month.push(response.data[0].maio)
            values_month.push(response.data[0].junho)
            values_month.push(response.data[0].julho)
            values_month.push(response.data[0].agosto)
            values_month.push(response.data[0].setembro)
            values_month.push(response.data[0].outubro)
            values_month.push(response.data[0].novembro)
            values_month.push(response.data[0].dezembro)

            myChart.data.datasets[0].data = values_month
            myChart.update();
        })

    }

    getDestinos()
</script>

</body>

</html>




<?php

BodyHtml::footer();
Messages::Mensagens();

?>