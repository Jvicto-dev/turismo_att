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

$code = substr(md5(md5(time())), -8);

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




    <!-- <form action="" method="POST" class="forms-sample"> -->

    <div class="row">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-1">
                </div>
                <div class="col-md-10">

                    <div class="card">
                        <div class="card-header">
                            <h3>Formulario de vendas </h3>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="exampleInputUsername1">Data para a viagem</label>
                                <input id="data_ir" class="form-control" type="date">
                            </div>


                            <div class="form-group">
                                <label for="exampleSelectGender">Destinos</label>
                                <select class="form-control" onchange="gerarVenda()" id="select_destinos0">

                                </select>
                            </div>

                            <!-- <div class="form-group">
                                <label for="exampleSelectGender">Veiculo:</label>
                                <select class="form-control" id="select_veiculo">

                                </select>
                            </div> -->




                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleSelectGender">Hotel</label>
                                        <select class="form-control" id="select_hotel">

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail3">Valor</label>
                                        <input onkeyup="k(this)" type="text" class="form-control" id="valor_hotel_familia" placeholder="Valor" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail3">Nº Apartamento</label>
                                        <input type="text" class="form-control" id="n_apartamento" placeholder="digite..." required>

                                    </div>
                                </div>


                            </div>


                            <br>

                            <h3>Resposavel da familia</h3>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail3">Nome</label>
                                        <input type="text" class="form-control" id="nome0" placeholder="Nome" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail3">Email</label>
                                        <input type="email" class="form-control" id="email0" placeholder="Email" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail3">Telefone 1</label>
                                        <input type="text" class="form-control" id="telefoneA0" placeholder="telefone 1" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail3">Telefone 2</label>
                                        <input type="text" class="form-control" id="telefoneB0" placeholder="telefone 2" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail3">Rg </label>
                                        <input type="text" class="form-control" id="rg0" placeholder="Rg " required>
                                    </div>
                                </div>


                            </div>



                            <div class="form-group">
                                <label for="exampleSelectGender">Passagem do responsável</label>
                                <select class="form-control" id="select_passagens0" onchange="valorEpoca()">

                                </select>
                            </div>




                            <div class="form-group">
                                <div class="form-group">
                                    <label for="exampleInputEmail3">Valor de venda</label>
                                    <input onkeyup="k(this)" type="text" class="form-control" id="valor_venda0" placeholder="valor de venda" required>
                                </div>
                            </div>



                            <div id="inputs">
                            </div>

                            <div id="estrutura_familia">
                                <!-- <button type="button" class="btn btn-icon btn-success" id="addfamiliar"><i class="ik ik-plus"></i></button> -->
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail3">Composição familiar</label>
                                        <input type="text" class="form-control" id="sizefamily" placeholder="exemplo: 5">

                                    </div>
                                </div>

                            </div>

                            <button type="button" onclick="gerarPassagensFamiliares()" class="btn btn-outline-success">Gerar</button>
                            <br>

                            <br>

                            <div id="familia">
                                <!-- <h3>Familiar</h3> -->
                            </div>


                            <input type="hidden" name="allnomes" id="allnomes"><br>
                            <input type="hidden" name="allemails" id="allemails"><br>
                            <input type="hidden" name="alltelefone1" id="alltelefone1"><br>
                            <input type="hidden" name="alltelefone2" id="alltelefone2"><br>
                            <input type="hidden" name="allselects" id="allselects"><br><br>

                            <!-- <h3>Codigo da familia:</h3> -->
                            <input type="hidden" value="<?= $code ?>" name="id_codigo_familia" id="id_codigo_familia">
                            <!-- <h3>Id do vendedor</h3> -->
                            <input type="hidden" value="<?php echo $_SESSION['user'][0]['id_login'] ?>" name="allselects" id="id_vendedor">


                            <!-- <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                            <button class="btn btn-light">Cancel</button> -->

                            <?php

                            if ($_SESSION['user'][0]['nivel_acesso_fk'] == 1) {
                            ?>

                                <input type="hidden" id="fk_login_loja" name="fk_login_loja" value="<?= $_SESSION['user'][0]['id_login'] ?>">

                            <?php } else if ($_SESSION['user'][0]['nivel_acesso_fk'] == 2) { ?>

                                <input type="hidden" id="fk_login_loja" name="fk_login_loja" value="<?= $_SESSION['user'][0]['fk_login_loja'] ?>">

                            <?php } ?>



                            <?php

                            // var_dump($_SESSION['user'][0]['id_login']);

                            ?>



                            <div class="form-group">
                                <label for="exampleSelectGender">Ponto de encontro</label>
                                <select class="form-control" id="select_ponto_encontro">

                                </select>
                            </div>


                            <div class="form-group">
                                <div class="form-group">
                                    <label for="exampleInputEmail3">Valor de entrada</label>
                                    <input type="text" onkeyup="k(this)" class="form-control" id="valor_entrada" placeholder="valor de Entrada" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleSelectGender">Forma de pagamento</label>
                                <select class="form-control" id="forma_pagamento_familia" onchange="valorEpoca()">
                                    <option value="1">Cartão - Credito</option>
                                    <option value="2">Cartão - Debito</option>
                                    <option value="3">Dinheiro</option>
                                    <option value="4">Transferencia</option>
                                    <option value="5">Pix</option>
                                </select>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="col-md-1">
                </div>
            </div>
        </div>





    </div>



    <div>
    </div>



    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <button type="Submit" class="btn btn-info btn-block" name="CadastrarDestino" value="fazerVenda" onclick="jogaValues()">Fazer Venda</button>
            </div>
            <div class="col-md-2">
            </div>
        </div>
    </div>

    <!-- </form> -->



    <!-- /////////// termina aqui as ações -->
</div> <!-- Fim Div Principal -->
<?php
// resto das coisas depois do "fecha div principal" 
include('../../../includes/footer.php'); ?>

<script src="https://unpkg.com/imask"></script>
<script src="../../Mains/vendedor_main.js"></script>

<script src="../../Mains/main_email.js"></script>
<script>
    getDestinos()
    // getPasseios()
    gerarVenda()


    // var currencyMask = IMask(
    //     document.getElementById('valor_venda0'), {
    //         mask: 'num',
    //         blocks: {
    //             num: {
    //                 // nested masks are available!
    //                 mask: Number,
    //                 thousandsSeparator: ''
    //             }
    //         }
    //     });

    var phoneMask = IMask(
        document.getElementById('telefoneA0'), {
            mask: '(00)00000-0000'
        });

    var phoneMask = IMask(
        document.getElementById('telefoneB0'), {
            mask: '(00)00000-0000'
        });


    // função que converte os inputs formatando com as casas hexasentesimais
    function k(i) {
        var v = i.value.replace(/\D/g, '');
        v = (v / 100).toFixed(2) + '';
        v = v.replace(".", ".");
        v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1.$2.$3,");
        v = v.replace(/(\d)(\d{3}),/g, "$1.$2,");

        i.value = v;
    }




    function readPonto() {
        var fk_login_loja = $("#fk_login_loja").val()
        var id_destino = $("#select_destinos0").val()
        axios.post('../../api2/controller.php', {
            action: "read-ponto-encontro",
            values: [
                fk_login_loja,
                id_destino
            ]
        }).then(function(response) {
            options = ""
            for (var i = 0; i < response.data.length; i++) {
                options += `<option value="` + response.data[i].id_ponto_encontro + `">` + response.data[i].descricao + " | " + response.data[i].horario + `</option>`

            }
            document.getElementById("select_ponto_encontro").innerHTML = options
        })
    }
    // readPonto()
</script>

<?php

BodyHtml::footer();
Messages::Mensagens();

?>