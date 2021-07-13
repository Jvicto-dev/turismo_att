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
        <div class="col-md-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3>Vendas dos Passeios</h3>
                </div>
                <div class="card-block">
                    <div id="placeholder" class="demo-placeholder" style="height:300px;">
                    <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3>Vendas dos vendedores</h3>
                </div>
                <div class="card-block">
                    <div id="placeholder1" class="demo-placeholder" style="height:300px;">
                    <canvas id="myChart2"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>







    <hr>
    <!-- <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>GRAFICO DESTINOS</h3>
                </div>

                <br>


                <div class="card-block">

                   

                </div>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>GRAFICO VENDEDORES</h3>
                </div>

                <br>


                <div class="card-block">

                    <canvas id="myChart2"></canvas>

                </div>
            </div>
        </div>

    </div> -->



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
    function RandomColor() {

        var r = Math.floor(Math.random() * 255);
        var g = Math.floor(Math.random() * 255);
        var b = Math.floor(Math.random() * 255);
        return "rgba(" + r + "," + g + "," + b + "," + 0.5 + ")";

    }

    function graficoDestinos(arrayDestinos, arrayNVendas) {
        colors = []
        for (var i = 0; i < arrayDestinos.length; i++) {
            colors.push(RandomColor());
        }
        var ctx = document.getElementById('myChart');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: arrayDestinos,
                datasets: [{
                    label: ['Vendas Totais'],
                    data: arrayNVendas,
                    backgroundColor: colors,
                    borderWidth: 2
                }]
            },

        });

    }



    function graficoVendedores(arrayNomes, arrayNVendasVendedor) {
        colors = []
        for (var i = 0; i < arrayNomes.length; i++) {
            colors.push(RandomColor());
        }
        var ctx = document.getElementById('myChart2');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: arrayNomes,
                datasets: [{
                    label: ['Vendas Totais'],
                    data: arrayNVendasVendedor,
                    backgroundColor: colors,
                    borderWidth: 2
                }]
            },

        });

    }



    // quando clicar, muda os valores do grafico
    function valuesGraph() {
        destinos = []
        vendas = []
        axios.post('../../api2/controller.php', {
            action: "grafico-geral-destino",
            values: [
                $("#fk_login_loja").val()
            ]

        }).then(function(response) {
            var a = ""
            for (var i = 0; i < response.data.length; i++) {
                destinos.push(response.data[i].nome_destino)
                vendas.push(response.data[i].vendas)

            }
            graficoDestinos(destinos, vendas)


        })

    }

    function valuesGraphVendedores() {
        nome_vendedor = []
        vendas_vendedor = []
        axios.post('../../api2/controller.php', {
            action: "grafico-geral-vendedores",
            values: [
                $("#fk_login_loja").val()
            ]

        }).then(function(response) {
            var a = ""
            for (var i = 0; i < response.data.length; i++) {
                nome_vendedor.push(response.data[i].nome_vendedor)
                vendas_vendedor.push(response.data[i].vendas_vendedor)

            }
            graficoVendedores(nome_vendedor, vendas_vendedor)


        })

    }

    valuesGraphVendedores()
    valuesGraph()
</script>

</body>

</html>




<?php

BodyHtml::footer();
Messages::Mensagens();

?>