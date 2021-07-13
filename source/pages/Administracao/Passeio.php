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

$passagens = new \Source\Controllers\ControllerPassagem();
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



    <div class="alert alert-primary" role="alert">
        Passeios
    </div>


    <!-- Button trigger modal -->


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputUsername1">Data para a viagem</label>
                    <input id="data_ir" class="form-control" type="date" value="2021-06-01">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleSelectGender">Destino</label>
                    <select class="form-control" id="select_destinos0">


                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <br><br>
                <button type="button" class="btn btn-outline-success" onclick="consultar()">Consultar</button>
            </div>
        </div>
    </div>





    <!-- 
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
            </div>
            <div class="col-md-5">
            </div>
            <div class="col-md-2">
                <a href="Passeio-Adicionar.php"><button type="button" class="btn btn-outline-success">Adicionar Passeios</button></a>
            </div>
        </div>
    </div> -->




    <br>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">


                <!-- <div class="card-header d-block">
                    <h3>Tabela de Clientes para o passeio</h3>
                    <span>use class <code>table-inverse</code> inside table element</span>
                </div> -->
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-lg-7 col-md-12">
                                <h3 class="card-title" id="nome_pass">nome do passeio / data do</h3>
                                <div class="card-body p-0 table-border-style">
                                    <div class="table-responsive">
                                        <table class="table table-inverse">
                                            <thead>
                                                <tr>

                                                    <th>Veiculo</th>
                                                    <th>Capacidade</th>
                                                    <th>Ocupação</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody_passeio">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-5 col-md-12">
                                <div class="card-header">
                                    <h3>Informações Gerais</h3>
                                </div>
                                <br>
                                <div id="geral_infors"></div>

                            </div>

                        </div>
                        <!-- card rodapé -->
                        <div id="card_rodape"></div>


                    </div>

                </div>


                <div id="tables"></div>
                <div id="b"></div>


                <!-- fim Div Grid 12 -->
            </div>
        </div>
    </div>

    <br>

    <div id="div_passeio"></div>

</div>




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input type="hidden" id="editar_id_veiculo"><br>

                <div class="form-group">
                    <label for="exampleSelectGender">Trocar veiculo:</label>
                    <select class="form-control" id="opEditVeiculo">

                    </select>
                </div>


                <div class="form-group">
                    <label for="exampleSelectGender">Veiculo pelo qual será trocado:</label>
                    <select class="form-control" id="newVeiculo">

                    </select>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" onclick="trocarVeiculo()" class="btn btn-primary">Fazer Troca</button>
            </div>
        </div>
    </div>
</div>



<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="modalMotoristaeGuia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Configurações para este Veiculo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <br>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Responsavel</th>
                                    <th scope="col">Gategoria</th>

                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="guiaEMotorista">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>




            <div class="modal-body">

                <input type="hidden" id="id_veiculo_GeM">

                <div class="form-group">

                    <label for="exampleSelectGender">Nome do Responsavel</label>
                    <input class="form-control" type="text" id="nome_responsavel" placeholder="nome" data-placement="top" title="Tooltip on top">

                </div>

                <div class="form-group">

                    
                    <div class="form-group">
                    <label for="exampleSelectGender">Categoria</label>
                        <select class="form-control" id="select_categoria_responsavel">
                            <option value="1"> Guia </option>
                            <option value="2"> Motorista </option>
                        </select>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" onclick="InsertGuiaEMotorista()" class="btn btn-primary">Cadastrar</button>
            </div>
        </div>
    </div>
</div>




<!-- Modal colocar clientes no veiculo -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">

                    <label for="exampleSelectGender">Quantidade de pessoas selecionada</label>
                    <input class="form-control" type="text" id="qPessoas" placeholder="">
                    <input type="hidden" id="codigos">
                </div>
                <div class="form-group">
                    <label for="exampleSelectGender">Veiculo:</label>
                    <select class="form-control" id="select_veiculo">

                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="insertVeiculos()" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>



<?php

if ($_SESSION['user'][0]['nivel_acesso_fk'] == 1) {
?>

    <input type="text" id="fk_login_loja" name="fk_login_loja" value="<?= $_SESSION['user'][0]['id_login'] ?>">

<?php } else if ($_SESSION['user'][0]['nivel_acesso_fk'] == 2) { ?>

    <input type="text" id="fk_login_loja" name="fk_login_loja" value="<?= $_SESSION['user'][0]['fk_login_loja'] ?>">

<?php } ?>



<!-- /////////// termina aqui as ações -->
</div> <!-- Fim Div Principal -->
<?php
// resto das coisas depois do "fecha div principal" 
// include('../../../includes/footer.php'); 
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
<script src="../../../js/charts.js"></script>
<script src="../../../dist/js/theme.min.js"></script>
<script src="../../../plugins/axios/axios.js"></script>

<!-- <script src="../../../plugins/select2/dist/js/select2.min.js"></script>
<script src="../../../plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="../../../plugins/jquery.repeater/jquery.repeater.min.js"></script>
<script src="../../../plugins/mohithg-switchery/dist/switchery.min.js"></script>
<script src="../../../js/form-advanced.js"></script> -->
<script src="../../Mains/administrador_main.js"></script>

<script>
    getDestinos()

    // getPasseio() // basicamente, desencadeia todo o resto

    function consultar() {
        var id_destino = $("#select_destinos0").val()
        var dataIr = $("#data_ir").val()
        pegarCodigoFamilia(id_destino, dataIr)
        pegarVeiculos(id_destino, dataIr)
        infoPasseio(id_destino, dataIr)

    }

    function addGuiaMotorista() {

    }

    // apenas coloca o valor la
    function inforVeiculo(n) {
        $("#id_veiculo_GeM").val(n)
        var destino = $("#select_destinos0").val()
        var id_veiculo = $("#id_veiculo_GeM").val()
        var data_ir = $("#data_ir").val()
        var fk_login_loja = $("#fk_login_loja").val()
        axios.post('../../api2/controller.php', {
            action: "get-motorista-guia",
            values: [
                destino,
                id_veiculo,
                data_ir,
                fk_login_loja


            ]
        }).then(function(response) {
            console.log(response.data[0])
            tsr = ""
            for (var i = 0; i < response.data.length; i++) {
                categoria = ""
                if (response.data[i].categoria == 1) {
                    categoria = "Guia"
                } else if (response.data[i].categoria == 2) {
                    categoria = "Motorista"
                }

                tsr += `
            <tr>
                
                <td>` + response.data[i].responsavel + `</td>
                    
                <td> ` + categoria + `  </td>

                <td> 
                    <button onclick="deletResponsavel(`+response.data[i].id_passeio+`)" type="button" class="btn btn-danger">
                        Apagar
                    </button>
                </td>
                
            </tr>`

            }
            document.getElementById("guiaEMotorista").innerHTML = tsr
        })

    }

    function deletResponsavel(id_passeio){
        Swal.fire({
            title: 'Tem certeza disso ?',
            text: "Você irá remover um responsavel, não poderá reverter isso",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim remover'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.post('../../api2/controller.php', {
                    action: "deletar_responsavel",
                    values: [
                       id_passeio
                    ]

                }).then(function(response) {
                    Swal.fire(
                        'Sucesso',
                        'Responsavel deletado com sucesso !',
                        'success'
                    );
                    setTimeout(function() {
                        location.href = "Passeio.php";
                    }, 1500);

                })
            }
        })
    }

    function InsertGuiaEMotorista() {

        var destino = $("#select_destinos0").val()
        var id_veiculo = $("#id_veiculo_GeM").val()
        var select_categoria_responsavel = $("#select_categoria_responsavel").val()
        var nome_responsavel = $("#nome_responsavel").val()
        var data_ir = $("#data_ir").val()
        var fk_login_loja = $("#fk_login_loja").val()


        axios.post('../../api2/controller.php', {
            action: "insert-guia-motorista",
            values: [
                destino,
                id_veiculo,
                nome_responsavel,
                select_categoria_responsavel,
                data_ir,
                fk_login_loja
            ]
        }).then(function(response) {
            Swal.fire(
                'Sucesso',
                'Integrantes do veiculo inseridas',
                'success'
            );
            setTimeout(function() {
                location.href = "Passeio.php";
            }, 1500);
        })

    }

    function editVeiculo(id) {
        $("#editar_id_veiculo").val(id);
        axios.post('../../api2/controller.php', {
            action: "get-one-veiculo",
            values: [

                $("#editar_id_veiculo").val(),
                $("#data_ir").val(),
                $("#select_destinos0").val()


            ]
        }).then(function(response) {
            estruz = ""
            veiculo = response.data[0];
            estruz = `<option value=" ` + veiculo.idVeiculo + `|` + veiculo.calculo + `">` + veiculo.nomeVeiculo + " | Vagas Restantes: " + veiculo.calculo + " | Ocupação " +
                (veiculo.capacidade - veiculo.calculo) +
                `</option>`
            document.getElementById("opEditVeiculo").innerHTML = estruz;

        })


        // colocar outro axios aqui pra puxar os os valores dos onibus com aquelas info


        var id_gambi = ""

        axios.post('../../api2/controller.php', {
            action: "get-veiculos",
            values: [
                $("#fk_login_loja").val()

            ]
        }).then(function(response) {
            var estru = ""
            var options = ""
            for (var i = 0; i < response.data.length; i++) {
                // colocando axios dentro de outro pra ver
                id_gambi = response.data[i].id_veiculo;
                // alert(response.data[i].id_veiculo)
                axios.post('../../api2/controller.php', {
                    action: "get-one-veiculo",
                    values: [
                        response.data[i].id_veiculo,

                        $("#data_ir").val(),


                        $("#select_destinos0").val()


                    ]
                }).then(function(response) {
                    for (var j = 0; j < response.data.length; j++) {
                        // alert(id_gambiarra)
                        estru += `<option value=" ` + response.data[j].idVeiculo + `|` + response.data[j].calculo + `">` + response.data[j].nomeVeiculo + " | Vagas Restantes: " + response.data[j].calculo + `</option>`
                        // options = `<option value="xykss">Selecione um Veiculo</option>` + estru;

                    }

                    document.getElementById("newVeiculo").innerHTML = estru;




                })

                //fim do axios que coloquei dentro do outro 

            }

        })


        // novo axios acaba aqui ^^^^^^^^^^^^^^

    }

    function trocarVeiculo() {
        var id_new_veiculo = $("#newVeiculo").val().split('|')
        var id_old_veiculo = $("#opEditVeiculo").val().split('|')


        Swal.fire({
            title: 'Tem certeza disso ?',
            text: "Você irá fazer uma troca de veiculo, passageiros serão realocados",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim Trocar'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.post('../../api2/controller.php', {
                    action: "trocar-veiculo",
                    values: [
                        parseInt(id_new_veiculo[0]),
                        parseInt(id_old_veiculo[0]),
                        $("#data_ir").val(),
                        $("#select_destinos0").val()
                    ]

                }).then(function(response) {
                    Swal.fire(
                        'Sucesso',
                        'Veiculo Trocado com sucesso !',
                        'success'
                    );
                    setTimeout(function() {
                        location.href = "Passeio.php";
                    }, 1500);

                })
            }
        })



    }



    function infoPasseio(id_destino, dataIr) {

        axios.post('../../api2/controller.php', {
            action: "info-passeios",
            values: [
                id_destino,
                $("#data_ir").val()
            ]
        }).then(function(response) {
            estrutura = ""
            for (var i = 0; i < response.data.length; i++) {
                estrutura = `<div class="row mb-15">
                                    <div class="col-9"> <i class="ik ik-user text-success"></i> Quantidade de Familias</div>
                                    <div class="col-3 text-right">` + response.data[i].qFamilias + ` familias</div>
                                    <div class="col-12">
                                        <div class="progress progress-sm mt-5">
                                            <div class="progress-bar bg-green" role="progressbar" style="width: 100%" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-15">
                                    <div class="col-9"> <i class="fas fa-bus-alt" style="color: red;"></i> Quantidade de veiculos para o passeio</div>
                                    <div class="col-3 text-right">` + response.data[i].qVeiculos + ` veiculos</div>
                                    <div class="col-12">
                                        <div class="progress progress-sm mt-5">
                                            <div class="progress-bar bg-aqua" role="progressbar" style="width: 100%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-15">
                                    <div class="col-9"> <i class="ik ik-alert-circle text-warning"></i> Total de Pessoas para a viagem</div>
                                    <div class="col-3 text-right">` + response.data[i].qPessoas + ` pessoas </div>
                                    <div class="col-12">
                                        <div class="progress progress-sm mt-5">
                                            <div class="progress-bar bg-purple" role="progressbar" style="width: 100%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-9"> <i class="ik ik-dollar-sign text-success"></i> Arrecadado</div>
                                    <div class="col-3 text-right">` + "R$" + response.data[i].vViagem + ",00" + `</div>
                                    <div class="col-12">
                                        <div class="progress progress-sm mt-5">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>`
            }
            document.getElementById("geral_infors").innerHTML = estrutura
        })
    }


    function pegarVeiculos(id_destino, data_ir) {
        axios.post('../../api2/controller.php', {
            action: "pegar-veiculos",
            values: [
                id_destino,
                data_ir
            ]
        }).then(function(response) {
            nd = response.data[0].nome_destino
            estrutura = ""
            for (var i = 0; i < response.data.length; i++) {
                // pegarCodigoFamilia(id_destino,$("#data_ir").val())

                if (response.data[i].id_veiculo == 0) {
                    estrutura += `<tr>
                    <td><span class="badge badge-pill badge-danger mb-1">*Pessoas sem veiculo*</span></td>
                    <td>---</td>
                    <td><h2><span class="badge badge-pill badge-danger mb-1">` + response.data[i].ocupacao + `</span></h2></td>
                    <td>---</td>
                    </tr>`
                } else {



                    estrutura += `<tr>
                
                <td>` + response.data[i].nome_veiculo + `</td>
                
                <td> ` + response.data[i].capacidade + `  </td>

                <td> ` + response.data[i].ocupacao + `  </td>

                <td> 
                <button type="button" onclick="editVeiculo(` + response.data[i].id_veiculo + `)" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                 Trocar
                </button>   

                <button type="button" onclick="inforVeiculo(` + response.data[i].id_veiculo + `)" class="btn btn-primary" data-toggle="modal" data-target="#modalMotoristaeGuia">
                 Configurar <i class="ik ik-settings"></i>   
                </button>  

                </td>

  

                
    </tr>`

                }
            }
            cadRodape = `<div class="card-header d-block">
                            <h3>Tabela de Clientes para o passeio</h3>
                           </div>`

            document.getElementById("tbody_passeio").innerHTML = estrutura
            document.getElementById("nome_pass").innerHTML = nd + " - " + moment($("#data_ir").val()).format("DD/MM/YYYY")
            document.getElementById("card_rodape").innerHTML = cadRodape
        })
    }




    function pegarCodigoFamilia(id_destino, dataIr) {
        axios.post('../../api2/controller.php', {
            action: "get-cod-fa",
            values: [
                id_destino,
                dataIr
            ]
        }).then(function(response) {
            tableEstru = "";
            for (var i = 0; i < response.data.length; i++) {
                tbodyPessoasPasseio(id_destino, response.data[i].cFamilia)
                tableEstru += `
                <div class="card">

            <div class="card-body p-0 table-border-style">
                <div class="table-responsive">
                    <table class="table table-inverse">
                        <thead>
                            <tr>
                                <th> <label class="custom-control custom-checkbox">
                                    <input type="checkbox" value="` + response.data[i].cFamilia + `" name="Pacote" class="custom-control-input">
                                    <span class="custom-control-label">&nbsp;</span>
                                    </label>
                                    
                                </th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Telefone 1</th>
                                <th>Telefone 2</th>
                                <th>veiculo</th>

                                <th>R$ Passagem</th>
                            </tr>
                        </thead>
                        <tbody id="carrega_tabela_familias` + response.data[i].cFamilia + `">
                        </tbody>
                    </table>
                </div>
            </div>
            </div>      
            
            `;
            }
            b = `
            <button onclick="colocarVeiculos()" type="button" class="btn btn-outline-success "data-toggle="modal" data-target=".bd-example-modal-lg">
            Adicionar ao Onibus
            </button>
            <br><br>`
            document.getElementById("tables").innerHTML = tableEstru

            document.getElementById("b").innerHTML = b

        })
    }

    function tbodyPessoasPasseio(id_do_destino, codigo_familia) {
        axios.post('../../api2/controller.php', {
            action: "familias-pessoas-adm",
            values: [
                id_do_destino,
                codigo_familia
            ]
        }).then(function(response) {
            estrutura_tbody = "";
            for (var i = 0; i < response.data.length; i++) {
                veiculo = ""
                if (response.data[i].id_veiculo_fk == 0) {
                    veiculo = `<span class="badge badge-pill badge-danger mb-1">Sem veiculo ainda</span>`
                } else {
                    veiculo = response.data[i].nome_veiculo
                }
                estrutura_tbody += `

    <tr>
                <td>
              
                </td>
                <td>` + response.data[i].nome + `</td>
                
                <td> ` + response.data[i].email + `  </td>

                <td> ` + response.data[i].telefone1 + `  </td>

                

                <td> ` + response.data[i].telefone2 + `  </td>

                <td>` + veiculo + `</td>
                
                <td>R$` + response.data[i].valor_na_epoca + ",00" + `</td>
    </tr>

`;

            }
            codigo = codigo_familia
            document.getElementById("carrega_tabela_familias" + codigo).innerHTML = estrutura_tbody;


        })
    }

    function colocarVeiculos() {

        var pacote = document.querySelectorAll('[name=Pacote]:checked');
        var c = 0
        var cdgs = ""
        for (var i = 0; i < pacote.length; i++) {
            codigos_das_familias = pacote[i].value; // chechbox
            cdgs += codigos_das_familias + "|"
            axios.post('../../api2/controller.php', {
                action: "cont-for-bus",
                values: [
                    codigos_das_familias

                ]
            }).then(function(response) {
                c += parseInt(response.data[0].qFamilia)

                $("#qPessoas").val(c)
                $("#codigos").val(cdgs)
            })



        }

        var id_gambiarra = ""

        axios.post('../../api2/controller.php', {
            action: "get-veiculos",
            values: [
                $("#fk_login_loja").val()

            ]
        }).then(function(response) {
            var estru = ""
            var options = ""
            for (var i = 0; i < response.data.length; i++) {
                // colocando axios dentro de outro pra ver
                id_gambiarra = response.data[i].id_veiculo;
                // alert(response.data[i].id_veiculo)
                axios.post('../../api2/controller.php', {
                    action: "acesso-veiculo",
                    values: [
                        response.data[i].id_veiculo,
                        $("#data_ir").val(),
                        $("#select_destinos0").val()

                    ]
                }).then(function(response) {
                    for (var j = 0; j < response.data.length; j++) {
                        // alert(id_gambiarra)
                        estru += `<option value=" ` + response.data[j].idVeiculo + `|` + response.data[j].calculo + `">` + response.data[j].nomeVeiculo + " | Vagas Restantes: " + response.data[j].calculo + `</option>`
                        // options = `<option value="xykss">Selecione um Veiculo</option>` + estru;

                    }
                    document.getElementById("select_veiculo").innerHTML = options;
                    document.getElementById("select_veiculo").innerHTML = estru;




                })

                //fim do axios que coloquei dentro do outro 

            }

        })




    }

    function insertVeiculos() {
        // UPDATE `familia` SET `id_veiculo_fk` = '2' WHERE familia.codigo_familia = '972eccbf'

        qPessoas = $("#qPessoas").val() // pega a quantidade de pessoas que foi selecionada
        var array_codigos = $("#codigos").val().split('|')
        var veiculos = $("#select_veiculo").val().split('|') // [0]-> id do veiculo [1]-> capacidade do veiculo
        tFamilias = (array_codigos.length) - 1 // pega a quantidade de familias que foi selecionada


        if (parseInt(veiculos[1]) < parseInt(qPessoas)) {

            Swal.fire(
                'Ops! ....',
                'Está tentando colocar mais pessoas do que a capacidade do Veiculo',
                'warning'
            )
        } else {

            //  função para barra caso ultrapasse a quantidade de pessoas no onibus depois chama o laço for

            for (var i = 0; i < tFamilias; i++) {
                axios.post('../../api2/controller.php', {
                    action: "add-veiculo-familias",
                    values: [
                        veiculos[0],
                        array_codigos[i]
                    ]
                }).then(function(response) {

                    Swal.fire(
                        'Cadastrado !',
                        'Familia(as) colocada(as) no veiculo com sucesso',
                        'success'

                    );
                    setTimeout(function() {
                        location.href = "Passeio.php";
                    }, 1500);

                })
            }
        }
    }
</script>

<?php

BodyHtml::footer();
Messages::Mensagens();

?>