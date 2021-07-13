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


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleSelectGender">Destinos</label>
                            <select onchange="chamaVendas()" id="destino_vendedor" class="form-control" id="exampleSelectGender">

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


                            <div class="col-lg-12 col-md-12">
                                <h3 class="card-title" id="nome_pass">Familias</h3>

                                <div id="tables"></div>

                            </div>


                        </div>


                    </div>

                </div>



                <div id="b"></div>


                <!-- fim Div Grid 12 -->
            </div>
        </div>
    </div>



    <div id="tables">


    </div>

    <?php
    $idLoja = "";

    if ($_SESSION['user'][0]['nivel_acesso_fk'] == 4) {
        $idLoja = $_SESSION['user'][0]['fk_login_loja'];
    } else {
        $idLoja = $_SESSION['user'][0]['id_login'];
    }



    ?>






    <?php

    if ($_SESSION['user'][0]['nivel_acesso_fk'] == 1) {
    ?>

        <input type="hidden" id="fk_login_loja" name="fk_login_loja" value="<?= $_SESSION['user'][0]['id_login'] ?>">

    <?php } else if ($_SESSION['user'][0]['nivel_acesso_fk'] == 2) { ?>

        <input type="hidden" id="fk_login_loja" name="fk_login_loja" value="<?= $_SESSION['user'][0]['fk_login_loja'] ?>">

    <?php } ?>

    <input type="hidden" value="<?= $_SESSION['user'][0]['id_login'] ?>" id="id_do_vendedor">

    <?php

    // var_dump($_SESSION['user'][0]['id_login']);

    ?>




    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar membro a esta familia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="codigo_familia_update"><br>
                    <input type="hidden" id="id_veiculo"><br>
                    <input type="hidden" id="id_destino"><br>
                    <input type="hidden" id="dia_viagem">

                    <div class="form-group">
                        <label for="">Nome</label>
                        <input type="text" class="form-control" id="nome" placeholder="nome">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Passagem</label>
                        <select class="form-control" id="id_passagem_fk">

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Valor de venda</label>
                        <input type="text" class="form-control" id="valor_venda" placeholder="valor de venda" required>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button onclick="atualizar()" type="button" class="btn btn-primary">Adicionar</button>
                </div>
            </div>
        </div>
    </div>


    <input type="text" value="<?php echo $_SESSION['user'][0]['id_login'] ?>" name="allselects" id="id_vendedor">



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
<script src="../../Mains/vendedor_main.js"></script>
<script>
    getDestinos()
    // getMinhasVendas()
    loadDestinos()
    chamaVendas()



    function update(codigo) {
        $("#codigo_familia_update").val(codigo);
        axios.post('../../api2/controller.php', {
            action: "passagem-familia",
            values: [

                codigo

            ]
        }).then(function(response) {
            // <option onclick="" value="50.00|47">Beach Park - Categoria:  Adulto Preço: 50.00</option>
            options = ""
            for (var i = 0; i < response.data.length; i++) {
                options += `<option value="` + response.data[i].valor + `|` + response.data[i].id_passagem + `">` + response.data[i].nome_destino + " - Categoria:  " + response.data[i].nome_categoria + " Preço: " + response.data[i].valor + `</option>
      `
            }
            veiculo_id = response.data[0].id_veiculo
            destino_id = response.data[0].id_destino
            dia_viagem = response.data[0].dia_viagem
            // alert(destino_id)
            $("#id_veiculo").val(veiculo_id)
            $("#id_destino").val(destino_id)
            $("#dia_viagem").val(dia_viagem)
            document.getElementById("id_passagem_fk").innerHTML = options
        })
    }


    function atualizar(){
        nome = $("#nome").val()
        rg = "---"
        email = "---"
        telefoneA = "---"
        telefoneB = "---"
        id_destino_fk = $("#id_destino").val()
        id_veiculo = $("#id_veiculo").val()
     
        idPassagem_e_valor = $("#id_passagem_fk").val().split('|')
         // ^ pega o valor na espoca[0] e o id da passagem[1]
        
        id_vendedor_fk = $("#id_vendedor").val()
        codigo = $("#codigo_familia_update").val()
        valor_venda = $("#valor_venda").val()
        dia_viagem = $("#dia_viagem").val()
    
        fk_login_loja = $("#fk_login_loja").val()

        enviaaxiosCadastroVenda2(nome, rg, email, telefoneA, telefoneB, id_destino_fk, id_veiculo, idPassagem_e_valor[1],
        id_vendedor_fk, idPassagem_e_valor[0], valor_venda, codigo, dia_viagem, fk_login_loja)
                   
        
    }



    
function enviaaxiosCadastroVenda2(arrayNomes, rg, arrayEmails, arrayTelefones1, arrayTelefones2,
    id_destino_fk, id_veiculo_fk, id_passagem_fk, id_vendedor_fk, valorNaEpoca, valorDeVenda, codigoFamilia, data_para_viagem, fk_login_loja) {
    axios.post('../../api2/controller.php', {
        action: "fazer-venda",
        values: [
            arrayNomes, // nome de todo mundo
            rg,
            arrayEmails, // emails 
            arrayTelefones1, // telefones 1
            arrayTelefones2, // telefones 2
            id_destino_fk, // destino de cada um
            id_veiculo_fk, // veiculo onde cada membro vai ficar
            id_passagem_fk, // id referente a passagem
            id_vendedor_fk, // id do vendedor que fez a venda 
            valorNaEpoca, // valor que valia a passagem na epoca
            valorDeVenda, // valor que o vendedor vendeu a passagem
            codigoFamilia, // codigo da familia, o mesmo para todos os membros
            data_para_viagem, // data para qual a familia vai para a viagem...
            fk_login_loja // id referente  loja. controle para o super admin....
        ]
    }).then(function (response) {
        Swal.fire(
            'Cadastrado !',
            'Venda feita com sucesso!',
            'success'
        );
        setTimeout(function () {
            location.href = "suasVendas.php";
        }, 1500);
    })
}









</script>

<?php

BodyHtml::footer();
Messages::Mensagens();

?>