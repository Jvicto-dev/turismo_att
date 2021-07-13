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
   </div>
   <!-- fim menu superior -->
   <!-- //////////// Começo das ações daqui, pode copiar e colar que da certo.  -->
   <div class="row">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-1">
            </div>
            <div class="col-md-10">
               <div class="card">
                  <div class="card-header">
                     <h3>PAGAMENTO DE COMISSÃO</h3>
                  </div>
                  <div class="card-body">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label for="exampleSelectGender">Vendedor</label>
                              <select class="form-control" onchange="gerarDash()" id="select_vendedor">
                              </select>
                           </div>
                        </div>
                     </div>
                     <!-- <button type="button" class="btn btn-outline-success">Buscar</button> -->
                     <br><br><br>

                     <!-- Estrutura dashboard -->

                     <div id="dashComissao"></div>



                     <!-- Historico de transições -->

                     <div id="tabelaHitorico"></div>

                     <button type="button" class="btn btn-outline-success " data-toggle="modal" data-target=".bd-example-modal-lg">
                        Fazer Transação
                     </button>
                     <br><br><br>

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





   <!-- Modal colocar clientes no veiculo -->
   <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Transação de valores</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="form-group">

                  <label for="exampleSelectGender">valor da Transação</label>
                  <input onkeyup="k(this)" class="form-control" type="text" id="valor" placeholder="R$..." require>
                  <input type="hidden" id="codigos">
               </div>
               <div class="form-group">
                  <label for="exampleSelectGender">Categoria</label>
                  <select class="form-control" id="categoria">
                     <option value="ppp">Selecione uma opção</option>
                     <option value="1">Fazer pagamento de comissão</option>
                     <option value="2">Vendedor Trouxe dinheiro</option>
                  </select>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="button" onclick="transacao()" class="btn btn-primary">Concluir</button>
            </div>
         </div>
      </div>
   </div>






   <!-- /////////// termina aqui as ações -->
</div>
<!-- Fim Div Principal -->
<?php
// resto das coisas depois do "fecha div principal" 
include('../../../includes/footer.php'); ?>
<script src="../../../plugins/select2/dist/js/select2.min.js"></script>
<script src="../../../plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="../../../plugins/jquery.repeater/jquery.repeater.min.js"></script>
<script src="../../../plugins/mohithg-switchery/dist/switchery.min.js"></script>
<script src="../../../js/form-advanced.js"></script>
<script src="../../../plugins/axios/axios.js"></script>
<script src="../../Mains/administrador_main.js"></script>
<script>
   function gerarVendedores() {
      axios.post('../../api2/controller.php', {
         action: "get-vendedores",
         values: [
            $("#fk_login_loja").val()
         ]
      }).then(function(response) {
         estrutura = "";
         option = "";
         for (var i = 0; i < response.data.length; i++) {
            estrutura += `<option value="` + response.data[i].id_login + `">` + response.data[i].nome + `</option> `;

         }
         option = `<option value="xyk">Selecione um Vendedor</option>` + estrutura;
         document.getElementById("select_vendedor").innerHTML = option
      })
   }
   gerarVendedores()

   function gerarDash() {
      var id_vendedor = $("#select_vendedor").val()
      historico(id_vendedor)

      axios.post('../../api2/controller.php', {
         action: "get-comissao-individual",
         values: [
            id_vendedor
         ]
      }).then(function(response) {
         estruturaDash = "";
         var c1
         var c2
         for (var i = 0; i < response.data.length; i++) {
            if (response.data[i].todosEnviosDeComissao == null) {
               todosEnviosDeComissao = 0
            } else {
               todosEnviosDeComissao = response.data[i].todosEnviosDeComissao
            }

            if (response.data[i].todosEnviosParaEmpresa == null) {
               todosEnviosParaEmpresa = 0
            } else {
               todosEnviosParaEmpresa = response.data[i].todosEnviosParaEmpresa
            }

            if (response.data[0].valoresHoteis == null) {
               valoresHoteis = 0
            } else {
               valoresHoteis = response.data[0].valoresHoteis
            }


            c1 = ((response.data[i].valorDeVenda - response.data[i].valorEpoca) - (todosEnviosDeComissao))
            c2 = ((response.data[i].valorDeVenda - todosEnviosParaEmpresa) + parseInt(valoresHoteis))
            estruturaDash += `
               <div class="row">
                        <div class="col-xl-6 col-md-6">
                           <div class="card prod-p-card card-red">
                              <div class="card-body">
                                 <div class="row align-items-center mb-30">
                                    <div class="col">
                                       <h6 class="mb-5 text-white">Comissão Remanescente</h6>
                                       <h3 class="mb-0 fw-700 text-white">R$` + c1 + `,00</h3>
                                    </div>
                                    <div class="col-auto">
                                       <i class="fa fa-money-bill-alt text-red f-18"></i>
                                    </div>
                                 </div>
                                 <p class="mb-0 text-white"><span class="label label-danger mr-10">%</span>Comissão que ainda não foi paga</p>
                              </div>
                           </div>
                        </div>

                        <div class="col-xl-6 col-md-6">
                           <div class="card prod-p-card card-green">
                              <div class="card-body">
                                 <div class="row align-items-center mb-30">
                                    <div class="col">
                                       <h6 class="mb-5 text-white">Comissão já paga</h6>
                                       <h3 class="mb-0 fw-700 text-white">R$` + todosEnviosDeComissao + `,00</h3>
                                    </div>
                                    <div class="col-auto">
                                       <i class="fas fa-dollar-sign text-green f-18"></i>
                                    </div>
                                 </div>
                                 <p class="mb-0 text-white"><span class="label label-success mr-10">%</span>Comissão já Paga</p>
                              </div>
                           </div>
                        </div>
                     
                     <div class="col-xl-6 col-md-6">
                           <div class="card prod-p-card card-blue">
                              <div class="card-body">
                                 <div class="row align-items-center mb-30">
                                    <div class="col">
                                       <h6 class="mb-5 text-white">Valor remanescente</h6>
                                       <h3 class="mb-0 fw-700 text-white">R$` + c2 + `,00</h3>
                                    </div>
                                    <div class="col-auto">
                                       <i class="fas fa-database text-blue f-18"></i>
                                    </div>
                                 </div>
                                 <p class="mb-0 text-white">Cálculo baseado em: <br> valor da passagem + comissão + hoteis</p>
                              </div>
                           </div>
                        </div>

                        <div class="col-xl-6 col-md-6">
                           <div class="card prod-p-card card-yellow">
                              <div class="card-body">
                                 <div class="row align-items-center mb-30">
                                    <div class="col">
                                       <h6 class="mb-5 text-white">Valor já entregue a empresa</h6>
                                       <h3 class="mb-0 fw-700 text-white">R$` + todosEnviosParaEmpresa + `,00</h3>
                                    </div>
                                    <div class="col-auto">
                                       <i class="fas fa-tags text-warning f-18"></i>
                                    </div>
                                 </div>
                                 <p class="mb-0 text-white">Valor entregue apenas por este vendedor</p>
                              </div>
                           </div>
                        </div>
                    
                     
                     </div>
                     
                     `
         }
         document.getElementById("dashComissao").innerHTML = estruturaDash
      })

   }


   function historico(id_vendedor) {
      axios.post('../../api2/controller.php', {
         action: "historico-individual",
         values: [
            id_vendedor
         ]
      }).then(function(response) {
         estruturaTabelaHistorico = "";
         tbody = ""
         cat = ""
         dinheiro = ""
         botao = ""
         estruturaTabelaHistorico += ` <h1>Historico de transações</h1>
                     <table class="table table-inverse">
                        <thead>
                           <tr>
                              <th>Quem Fez</th>
                              <th>Valor</th>
                              <th>Categoria</th>
                              <th>Dia e Hora</th>
                              <th>Ações</th>
                           </tr>
                        </thead>
                        <tbody id="carregar_tabela_transações">
                           
                        </tbody>
                     </table>`
         for (var i = 0; i < response.data.length; i++) {
            botao = `<button type="button" class="btn btn-danger" onclick="apagarTransacao(` + response.data[i].id_transacao + `)"><i class="ik ik-trash-2 f-16 text-white"></i>`;

            if (response.data[i].categoria == 1) {
               cat = `<span class="badge badge-pill badge-success mb-1">Pagamento de comissão</span>`
               dinheiro = ` <h6 class="fw-700">R$` + response.data[i].valor_enviado + `<i class="fas fa-level-up-alt text-green ml-10"></i></h6>`
            } else if (response.data[i].categoria == 2) {
               cat = `<span class="badge badge-pill badge-warning mb-1">Pagamento à empresa</span>`
               dinheiro = ` <h6 class="fw-700">R$` + response.data[i].valor_enviado + `<i class="fas fa-level-down-alt text-blue ml-10"></i></h6>`

            }

            tbody += `
            <tr>
               <td>` + response.data[i].nome + `</td>

               <td>` + dinheiro + `</td>
               
               <td>` + cat + `</td>

               <td>` + response.data[i].data_envio + `</td>

               <td>` + botao + `</td>
            </tr>`
         }
         document.getElementById("tabelaHitorico").innerHTML = estruturaTabelaHistorico
         document.getElementById("carregar_tabela_transações").innerHTML = tbody

      })
   }


   function transacao() {
      var responsavel = $("#fk_login_loja").val()
      var id_vendedor = $("#select_vendedor").val()
      var valor = $("#valor").val()
      var categoria = $("#categoria").val()

      if (valor == '' || categoria == 'ppp') {
         Swal.fire(
            'Erro',
            'Campos incorretos ou faltando valores',
            'error'
         );
      } else {

         // alert(responsavel + "|" + id_vendedor + "|" + valor + "|" + categoria)

         Swal.fire({
            title: 'Tem certeza disso ?',
            text: "Você esta prestes a fazer uma transação, deseja continuar ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim'
         }).then((result) => {
            if (result.isConfirmed) {
               axios.post('../../api2/controller.php', {
                  action: "transacao",
                  values: [
                     responsavel,
                     id_vendedor,
                     valor,
                     categoria
                  ]

               }).then(function(response) {
                  Swal.fire(
                     'Sucesso',
                     'Transação feita com sucesso !',
                     'success'
                  );
                  setTimeout(function() {
                     location.href = "pagarComissao.php"; // arrumar esse nome ai com acento
                  }, 1500);

               })
            }
         })

      }

   }


   function apagarTransacao(id) {


      Swal.fire({
         title: 'Tem certeza disso ?',
         text: "Você esta prestes apagar uma transação, deseja realmente continuar ?",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Sim'
      }).then((result) => {
         if (result.isConfirmed) {
            axios.post('../../api2/controller.php', {
               action: "apagar-transacao",
               values: [
                  id
               ]

            }).then(function(response) {
               Swal.fire(
                  'Sucesso',
                  'Transação excluida com sucesso !',
                  'success'
               );
               setTimeout(function() {
                  location.href = "pagarComissao.php"; // arrumar esse nome ai com acento
               }, 1500);

            })
         }
      })




   }


       // função que converte os inputs formatando com as casas hexasentesimais
       function k(i) {
        var v = i.value.replace(/\D/g, '');
        v = (v / 100).toFixed(2) + '';
        v = v.replace(".", ".");
        v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1.$2.$3,");
        v = v.replace(/(\d)(\d{3}),/g, "$1.$2,");

        i.value = v;
    }


</script>
<?php
BodyHtml::footer();
Messages::Mensagens();

?>