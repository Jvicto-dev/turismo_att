function load_tabela_main() {
    $('#table').DataTable({
        lengthMenu: [
            [10, 20, 50, -1],
            [10, 20, 50, "Todos"]
        ],
        "bJQueryUI": true,
        "oLanguage": {
            "sProcessing": "Processando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "Não foram encontrados resultados",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando de 0 até 0 de 0 registros",
            "sInfoFiltered": "",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "Primeiro",
                "sPrevious": "Anterior",
                "sNext": "Seguinte",
                "sLast": "Último"
            }
        }
    });
}




function getDestinos() {
    axios.post('../../api2/controller.php', {
        action: "get-destinos",
        values: [
            $("#fk_login_loja").val()
        ]
    })
        .then(function (response) {

            estrutura = "";
            option = "";
            for (var i = 0; i < response.data.length; i++) {

                // alert(response.data[i].nome);
                estrutura += `
            <option onclick="" value="` + response.data[i].id_destino + `">` + response.data[i].nome_destino + `</option>
        `;

                option = `<option value="xykk">Selecione um destino</option>` + estrutura;
            }

            document.getElementById("select_destinos0").innerHTML = option;

        })
}


function getVeiculos() {
    axios.post('../../api2/controller.php', {
        action: "get-veiculos",
        values: [

        ]
    })
        .then(function (response) {

            estrutura = "";
            option = "";
            for (var i = 0; i < response.data.length; i++) {



                if (response.data[i].disponivel == "NAO") {
                    option = ` <option disabled value="` + response.data[i].id_veiculo + `">` + response.data[i].nome_veiculo + ` | Capacidade:` + response.data[i].capacidade + ` - INDISPONIVEL` + `</option> `;

                } else {
                    option = ` <option value="` + response.data[i].id_veiculo + `">` + response.data[i].nome_veiculo + ` | Capacidade:` + response.data[i].capacidade + `  - DISPONIVEL` + `</option> `;

                }
                estrutura += option

                // option = `<option value="xyk">Selecione um Veiculo</option>` + estrutura;
            }

            document.getElementById("veiculos").innerHTML = estrutura;

        })
}

function cadastroDestinoVeiculo() {

    var destino = $("#select_destinos0").val()
    var veiculos = $("#veiculos").val()


    if (destino == "xykk") {
        Swal.fire(
            'Erro',
            'Informações faltando',
            'error'
        );

    } else {
        tablePasseio(destino)

        // axios.post('../../api2/controller.php', {
        //     action: "add-destino-veiculo",
        //     values: [
        //         destino,
        //         veiculos
        //     ]
        // })
        // .then(function(response) {
        //     Swal.fire(
        //         'Sucesso',
        //         'Veiculo(s) Adicionado(s) ao destino',
        //         'success'
        //      );
        //     //  setTimeout(function() {
        //     //     location.href = "Passeio.php";
        //     //   }, 1500);
        // })

    }
}


function tablePasseio(id_destino_fk) {
    axios.post('../../api2/controller.php', {
        action: "add-tabela-passeio",
        values: [
            id_destino_fk,
            $("#fk_login_loja").val(),
            $("#mes").val()
        ]
    })
}



function chama_treino() {
    axios.post('../../api2/controller.php', {
        action: "get-familias-all",
        values: [

        ]
    })
        .then(function (response) {
            id = "";
            estrutura2 = "";
            for (var i = 0; i < response.data.length; i++) {
                // id += response.data[i].id_treino;
                // get_sub_treinos(response.data[i].id_treino);
                // alert(response.data[i].id_treino);


                estrutura2 += `
    <table class="table table-hover" id="aTable">
        <thead>
            <tr>
                <th><span class="badge badge-pill badge-dark mb-1">`+ response.data[i].nome + `</span></th>
                <th>Séries</th>
                <th>Repetições</th>
                <th>Carga</th>
            </tr>
        </thead>
        <tbody id="carrega_sub_treinos`+ response.data[i].id_treino + `">
        </tbody>
        
    </table>
        `;

            }

            document.getElementById("div_table").innerHTML = estrutura2;

        })
}



function getPasseio() {
    axios.post('../../api2/controller.php', {
        action: "get-destinos-adm",
        values: [

        ]
    }).then(function (response) {
        estrutura = ""

        for (var i = 0; i < response.data.length; i++) {
            // alert(response.data[i].nome_destino)

            estrutura += `
        <div id="comporta`+ response.data[i].id_destino + `"></div>
        `

            // gerarPasseios(response.data[i].id_destino, response.data[i].nome_destino )


        }

        // document.getElementById("div_passeio").innerHTML = estrutura
    })
}



function gerarPasseios(id_destino, nome_destino) {
    axios.post('../../api2/controller.php', {
        action: "get-passeios",
        values: [
            id_destino,
            id_destino,
            id_destino,
            id_destino,
            id_destino
        ]
    }).then(function (response) {
        estrutura = ""
        for (var i = 0; i < response.data.length; i++) {
            estrutura += `
        <div class="row clearfix">
                                    <div class="col-lg-8 col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3>`+ nome_destino + `</h3>
                                                <div class="card-header-right">
                                                    <ul class="list-unstyled card-option" style="width: 90px;">
                                                        <li><i class="ik ik-chevron-left action-toggle ik-chevron-right"></i></li>
                                                        <li><i class="ik minimize-card ik-minus"></i></li>
                                                        <li><i class="ik ik-x close-card"></i></li>    
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-body feeds-widget">
                                                <div class="feed-item">
                                                    <a href="#">
                                                        <div class="feeds-left"><i class="ik ik-user text-success"></i></div>
                                                        <div class="feeds-body">
                                                            <h4 class="title text-primary">Familias <small class="float-right text-muted">Today</small></h4>
                                                            <small>`+ response.data[i].qFamilias + `</small>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="feed-item">
                                                    <a href="#">
                                                        <div class="feeds-left"><i class="ik ik-thumbs-up text-primary"></i></div>
                                                        <div class="feeds-body">
                                                            <h4 class="title text-success">Veiculos Para o Passeio <small class="float-right text-muted">10:45</small></h4>
                                                            <small>`+ response.data[i].qVeiculos + ` veiculos Confirmados para o passeio</small>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="feed-item">
                                                    <a href="#">
                                                        <div class="feeds-left"><i class="ik ik-alert-circle text-warning"></i></div>
                                                        <div class="feeds-body">
                                                            <h4 class="title text-warning">Total de pessoas <small class="float-right text-muted">10:50</small></h4>
                                                            <small>`+ response.data[i].qPessoas + ` pessoas no total da viagem</small>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="feed-item">
                                                    <a href="#">
                                                        <div class="feeds-left"><i class="ik ik-check-circle text-danger"></i></div>
                                                        <div class="feeds-body">
                                                            <h4 class="title text-danger">Capacidade dos veiculos <small class="float-right text-muted">11:05</small></h4>
                                                            <small>`+ response.data[i].cVeiculos + ` lugares - capacidade total dos veiculos</small>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="feed-item">
                                                    <a href="">
                                                        <div class="feeds-left"><i class="ik ik-dollar-sign text-success"></i></i></div>
                                                        <div class="feeds-body">
                                                            <h4 class="title text-success"> Valor Arrecadado ate agora com a viagem <small class="float-right text-muted"></small></h4>
                                                            <small>R$`+ response.data[i].vViagem + `,00 reais</small>
                                                        </div>
                                                    </a>
                                                </div>
        
                                               
                                               
                                            </div>
                                        </div>
        
                                    </div>
        
                                    <div class="col-lg-4 col-md-12">
                                        <!-- Barra lateral -->
                                        <div class="card sale-card">
                                            <div class="card-header">
                                                <h3>Summary</h3>
                                            </div>
                                            <div class="card-block text-center">
                                                <!-- <div style="display:inline;width:60px;height:60px;"><canvas width="60" height="60"></canvas><input type="text" class="dial" value="35" data-width="60" data-height="60" data-fgcolor="#42a5f5" data-angleoffset="-125" data-anglearc="250" data-thickness=".25" data-displayinput="false" style="display: none; width: 0px; visibility: hidden;"></div> -->
                                                <p class="mb-10 text-left">Capacidade dos Veiculos <span class="float-right">99%</span></p>
                                                <div class="progress mb-20">
                                                    <div class="progress-bar bg-c-blue" style="width:99%"></div>
                                                </div>
                                                <p class="mb-10 text-left">Food <span class="float-right">30%</span></p>
                                                <div class="progress mb-20">
                                                    <div class="progress-bar bg-c-blue" style="width:30%"></div>
                                                </div>
                                                <div class="text-center">
                                                <button type="button" class="btn btn-danger" style="height: 100px;" onclick="finalizaPasseio(`+ id_destino + `)"><i class="ik ik-info"></i> <h4>  Finalizar Viagem  </h4>  </button>

                                                <div class="card-body template-demo">
                                                <button type="button" class="btn btn-info btn-block" onclick="editarPasseio(`+ id_destino + `)" >Editar</button>
                                                 </div>

                                                 <div class="card-body template-demo">
                                                 <button type="button" class="btn btn-info btn-block" onclick="addVeiculosPasseioExistente(`+ id_destino + `)" >Adicionar mais veiculos</button>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
        
                                    </div>
        
        
                                   
        
                                    
        </div>
        `
        }
        document.getElementById("comporta" + id_destino).innerHTML = estrutura
    })


}




// mudar o nome para editarPasseioRemoverVeiculo
function editarPasseio(id) {
    location.href = "editarPasseio.php?id=" + id;
}

function addVeiculosPasseioExistente(id) {
    location.href = "AddVeicPassExist.php?idDestino=" + id;
}

function updateVeiculoDestino() {


    axios.post('../../api2/controller.php', {
        action: "veiculosDestinos",
        values: [
            $("#id_do_passeio").val()
        ]
    }).then(function (response) {
        estrutura = ""
        botao = ""
        for (var i = 0; i < response.data.length; i++) {
            botao = `<button type="button" class="btn btn-danger" onclick="removerVeiculo(` + response.data[i].id_veiculo + `)">Remover</button>`;
            estrutura += `
        <tr>
            <td>` + response.data[i].nome_veiculo + `</td>
            <td>`+ response.data[i].disponivel + `</td>
            <td>`+ botao + `</td>
        </tr>`;
        }

        document.getElementById("veiculos_passeio").innerHTML = estrutura;

    })
}

function removerVeiculo(id) {
    Swal.fire({
        title: 'Tem certeza disso ?',
        text: "O veiculo sera removido desse destino, antes, certifique-se de que não há pessoas no veiculo !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim Remover'
    }).then((result) => {
        if (result.isConfirmed) {
            axios.post('../../api2/controller.php', {
                action: "remover-veiculo-individual",
                values: [
                    id
                ]

            }).then(function (response) {
                Swal.fire(
                    'Sucesso',
                    'Passeio finalizado com sucesso!',
                    'success'
                );
                setTimeout(function () {
                    location.href = "Passeio.php";
                }, 1500);

            })
        }
    })
}


function finalizaPasseio(id) {
    Swal.fire({
        title: 'Tem certeza disso ?',
        text: "Você não poderá reverter isso!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim Finalizar Viagem!'
    }).then((result) => {
        if (result.isConfirmed) {
            axios.post('../../api2/controller.php', {
                action: "finalizar-passeio",
                values: [
                    id
                ]

            }).then(function (response) {
                Swal.fire(
                    'Sucesso',
                    'Passeio finalizado com sucesso!',
                    'success'
                );
                setTimeout(function () {
                    location.href = "Passeio.php";
                }, 1500);

            })
        }
    })
}



function dashboardIndex() {
    idLoja = $("#id_da_loja").val()
    idVendedor = $("#id_do_vendedor").val()

    axios.post('api2/controller.php', {
        action: "get-dash-admin",
        values: [
            idLoja
        ]
    }).then(function (response) {
        estrutura = ""
        for (var i = 0; i < response.data.length; i++) {
            estrutura += `
            <div class="container-fluid">
            <div class="row clearfix">
            <div class="col-lg-3 col-md-6 col-sm-12">
               <div class="widget">
                  <div class="widget-body">
                     <div class="d-flex justify-content-between align-items-center">
                        <div class="state">
                           <h6>Vendedores</h6>
                           <h2>`+ response.data[i].nVendedores + `</h2>
                        </div>
                        <div class="icon">
                           <i class="ik ik-users"></i>
                        </div>
                     </div>
                     <small class="text-small mt-10 d-block">Total de Vendedores</small>
                  </div>
                  <div class="progress progress-sm">
                     <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                  </div>
               </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
               <div class="widget">
                  <div class="widget-body">
                     <div class="d-flex justify-content-between align-items-center">
                        <div class="state">
                           <h6>Vendas do dia</h6>
                           <h2>`+ response.data[i].vendasDia + `</h2>
                        </div>
                        <div class="icon">
                        <i class="ik ik-shopping-bag"></i>
                        </div>
                     </div>
                     <small class="text-small mt-10 d-block">Vendas do dia</small>
                  </div>
                  <div class="progress progress-sm">
                     <div class="progress-bar bg-success" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                  </div>
               </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
               <div class="widget">
                  <div class="widget-body">
                     <div class="d-flex justify-content-between align-items-center">
                        <div class="state">
                           <h6>Resumo do dia</h6>
                           <h4>R$ `+ response.data[i].resumoDia + ` ,00</h4>
                        </div>
                        <div class="icon">
                        <i class="ik ik-dollar-sign"></i>
                        </div>
                     </div>
                     <small class="text-small mt-10 d-block">Resumo das vendas do dia</small>
                  </div>
                  <div class="progress progress-sm">
                     <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                  </div>
               </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
               <div class="widget">
                  <div class="widget-body">
                     <div class="d-flex justify-content-between align-items-center">
                        <div class="state">
                           <h6>Administradores</h6>
                           <h2>`+ response.data[i].nAdmins + `</h2>
                        </div>
                        <div class="icon">
                           <i class="ik ik-shield"></i>
                        </div>
                     </div>
                     <small class="text-small mt-10 d-block">Total de Funcionarios</small>
                  </div>
                  <div class="progress progress-sm">
                     <div class="progress-bar bg-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                  </div>
               </div>
            </div>
            <!--  <div class="col-xl-12">
               <div class="card proj-progress-card">
                   <div class="card-block">
                       <div class="row">
                           <div class="col-xl-4 col-md-6">
                               <h6>Diagnostico do banco de dados</h6>
                               <h5 class="mb-30 fw-700">532Gb<span class="text-green ml-10">+1.69%</span></h5>
                               <div class="progress">
                                   <div class="progress-bar bg-red" style="width:25%"></div>
                               </div>
                           </div>
                           <div class="col-xl-4 col-md-6">
                               <h6>Presenças computadas</h6>
                               <h5 class="mb-30 fw-700">122.480<span class="text-red ml-10">+15</span></h5>
                               <div class="progress">
                                   <div class="progress-bar bg-blue" style="width:65%"></div>
                               </div>
                           </div>
                           <div class="col-xl-4 col-md-6">
                               <h6>Assuntos por Disciplina</h6>
                               <h5 class="mb-30 fw-700">89%<span class="text-green ml-10">+0.99%</span></h5>
                               <div class="progress">
                                   <div class="progress-bar bg-green" style="width:85%"></div>
                               </div>
                           </div>
                           
                       </div>
                   </div>
               </div>
               </div> -->
            <!-- começo do diagnostico do -->
            
            <div class="container-fluid">
               <div class="row clearfix">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="widget bg-primary">
                                                <div class="widget-body">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="state">
                                                            <h6>Destinos</h6>
                                                            <h2>`+ response.data[i].nDestinos + `</h2>
                                                        </div>
                                                        <div class="icon">
                                                          <i class="ik ik-map"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="widget bg-success">
                                                <div class="widget-body">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="state">
                                                            <h6>Veiculos</h6>
                                                            <h2>`+ response.data[i].nVeiculos + `</h2>
                                                        </div>
                                                        <div class="icon">
                                                           <i class="ik ik-truck"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        
                                    </div>
            </div>
            
            <!-- fim do diagnostico do  -->
            
            `
        }

        document.getElementById("dashboard").innerHTML = estrutura
    })
}


function passeioMaisVendido() {
    idLoja2 = $("#id_da_loja").val()
    axios.post('api2/controller.php', {
        action: "passeio-mais-vendido",
        values: [
            idLoja2
        ]
    }).then(function (response) {
        estrutura = ""
        for (var i = 0; i < response.data.length; i++) {
            // alert(i)
            estrutura += `
            <div class="container-fluid">
            <div class="page-header">
               <div class="row align-items-end">
                  <div class="col-lg-8">
                     <div class="page-header-title">
                        <i class="ik ik-star bg-blue"></i>
                        <div class="d-inline">
                           <h5>Passeio mais Vendido</h5>
                           <span>Passeio com o maior numero de vendas</span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- inicio progesso turmas -->
            
         
         
         
            <div class="container-fluid">
               <div class="card-group mb-4">
                  <div class="card">
                     <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                           <div class="state">
                              <h6>`+ response.data[i].nome_destino + `</h6>
                              <h3 class="text-success">`+ response.data[i].conta + `</h3>
                              <p class="card-subtitle text-muted fw-500">Total de vendas</p>
                           </div>
                           <div class="state">
                              <h6>Valor Arrecadado</h6>
                              <h3 class="text-success">R$`+ response.data[i].valorArrecadado + ",00" + `</h3>
                              <p class="card-subtitle text-muted fw-500">Total Arrecadado</p>
                           </div>
                           <div class="icon"><i class="ik ik-dollar-sign"></i></div>
                        </div>
                        <div class="progress mt-3 mb-1" style="height: 6px;">
                           <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                           </div>
                        </div>
                        <div class="text-muted f12">
                           <!-- <span>Presentes 44/45</span> -->
                           <!-- <span class="float-right">99%</span> -->
                        </div>
                     </div>
                  </div>
                  <!-- <div class="card"></div> -->
               </div>
         
         
         
         
               
               
               
            </div>
            <!-- fim progesso turmas -->
         
         
          </div>
         
         
         
         
         </div>
         </div>

            `
        }
        document.getElementById("passseio_mais_vendido").innerHTML = estrutura

    })
}



function destinoPdf() {
    axios.post('../../api2/controller.php', {
        action: "get-passeios-pdf",
        values: [

        ]
    })
        .then(function (response) {

            estrutura = "";
            option = "";
            for (var i = 0; i < response.data.length; i++) {

                // alert(response.data[i].nome);
                estrutura += `
        <option onclick="" value="` + response.data[i].id_destino_fk + `">` + response.data[i].nome_destino + `</option>
    `;

                option = `<option value="xykk">Selecione um destino</option>` + estrutura;
            }

            document.getElementById("select_passeios").innerHTML = option;

        })
}



function pdfInfors() {
    var id = $("#select_destinos0").val()
    var data_passeio = $("#data_ir").val()
    var id_veiculo = $("#veiculos_passeio").val()

    if (id == 'xykk' || data_passeio == '' || id_veiculo == 'zzhyu456') {
        Swal.fire(
            'Erro',
            'Selecione uma Data, um Destino e um Veiculo <br> caso o veiculo não apareça verifique se há pessoas no veiculo para prosseguir',
            'error'
        );
    } else {
        location.href = "pdf.php?idDestino=" + id + "&" + "dataPasseio=" + data_passeio + "&" + "id_veiculo=" + id_veiculo;

    }

}

function pdfInforsPontoEncontro() {

    var id = $("#select_destinos0").val()
    var data_passeio = $("#data_ir").val()
    if (id == 'xykk' || data_passeio == '') {
        Swal.fire(
            'Erro',
            'Selecione uma Data e um destino',
            'error'
        );
    } else {

        location.href = "pdf2.php?idDestino=" + id + "&" + "dataPasseio=" + data_passeio;

    }
}




// essa função desencadeia as td das tabelas 
// basicamente cria outras tabelas tambem 
function gerarCodigoFamilia() {
    var id = document.getElementById("id_do_passeio_pdf").value

    // alert(id)
    axios.post('../../api2/controller.php', {
        action: "pegarCodigoFamilia",
        values: [
            id
        ]
    }).then(function (response) {
        estrutura = ""
        estrutura2 = ""
        for (var i = 0; i < response.data.length; i++) {
            idToPdf(response.data[i].id_destino_fk, response.data[i].codigoDasFamilia)
            valoresFinais(response.data[i].id_destino_fk, response.data[i].codigoDasFamilia)
            estrutura2 += `
            <table class="table table-hover" id="aTable">
                <thead>
                    <tr>
                        
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone 1</th>
                        <th>Telefone 2</th>
                        <th>Valor da passagem</th>
                    </tr>
                </thead>
                <tbody id="carrega_tabela_familias`+ response.data[i].codigoDasFamilia + `">
                </tbody>
                
            </table>

            <div id="divValores`+ response.data[i].codigoDasFamilia + `">
            
            </div>

                `;
        }

        document.getElementById("infors").innerHTML = estrutura2
        // $("#infors").val(estrutura2)
        // $("#infors").val("ola")
    })
}



function idToPdf(id_destino_fk, codigo_familia_fk) {
    axios.post('../../api2/controller.php', {
        action: "membrosFamilia",
        values: [
            id_destino_fk,
            codigo_familia_fk
        ]
    }).then(function (response) {
        estrutura_tabela = ""
        for (var i = 0; i < response.data.length; i++) {

            estrutura_tabela += `
          
            <tr>
                <td>` + response.data[i].nome + `</td>
                
                <td> `+ response.data[i].email + `  </td>

                <td> `+ response.data[i].telefone1 + `  </td>

                <td> `+ response.data[i].telefone2 + `  </td>
                <td>R$`+ response.data[i].valor_na_epoca + ",00" + `</td>
            </tr>
            </tbody>
                `;


        }
        codigo = codigo_familia_fk
        document.getElementById("carrega_tabela_familias" + codigo).innerHTML = estrutura_tabela
    })


}

function valoresFinais(id_destino_fk_final, codigo_familia_fk_final) {
    axios.post('../../api2/controller.php', {
        action: "valoresFinaisPdf",
        values: [
            id_destino_fk_final,
            codigo_familia_fk_final
        ]
    }).then(function (response) {
        estruturaValoresFinais = ""
        for (var i = 0; i < response.data.length; i++) {
            estruturaValoresFinais += `
            VALOR TOTAL DAS PASSAGENS: R$`+ response.data[i].valorPassagens + `,00 <br> 
            NOME DO HOTEL: `+ response.data[i].nome_hotel + `<br> 
            VALOR DO HOTEL: R$`+ response.data[i].valor + `,00  <br>
            VALOR FINAL DA FAMILIA: R$`+ response.data[i].valorTotalFamilia + `,00
            `
        }
        codigo2 = codigo_familia_fk_final
        document.getElementById("divValores" + codigo2).innerHTML = estruturaValoresFinais
    })
}



// function GerarPdf(id_do_passeio_pdf, id_codigo_familia){
//     var id = document.getElementById("id_do_passeio_pdf").value
//     axios.post('../../api2/controller.php', {
//         action: "gerarPdf",
//         values: [
//             id_do_passeio_pdf,
//             id_codigo_familia
//         ]
//     }).then(function(response) {
//         estrutura = ""
//         for (var i = 0; i < response.data.length; i++) {
//             estrutura += `<h1>`+response.data[i].codigo_familia+`</h1>`+`<br>`;
//         }
//         document.getElementById("infors").innerHTML = estrutura
//     })
// }





function dashboard() {

    axios.post('../../api2/controller.php', {
        action: "dashboard",
        values: [
            $("#fk_login_loja").val()
        ]
    }).then(function (response) {
        vendas = ""
        arrecadado = ""
        for (var i = 0; i < response.data.length; i++) {
            vendas += response.data[i].totalVendas
            arrecadado += response.data[i].arrecadado
        }

        document.getElementById("vendas").innerHTML = vendas + " Vendas"

        document.getElementById("arrecadado").innerHTML = "R$" + arrecadado + ",00"
    })
}



function todasVendas() {

    axios.post('../../api2/controller.php', {
        action: "allvendas",
        values: [
            $("#fk_login_loja").val()
        ]
    }).then(function (response) {
        estrutura = ""
        for (var i = 0; i < response.data.length; i++) {
            // alert(i)
            estrutura += `
            
            <!-- inicio progesso turmas -->
            
         
         
         
            <div class="container-fluid">
               <div class="card-group mb-4">
                  <div class="card">
                     <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                           <div class="state">
                              <h6>`+ response.data[i].nome_destino + `</h6>
                              <h3 class="text-success">`+ response.data[i].conta + `</h3>
                              <p class="card-subtitle text-muted fw-500">Total de vendas</p>
                           </div>
                           <div class="state">
                              <h6>Valor Arrecadado</h6>
                              <h3 class="text-success">R$`+ response.data[i].valorArrecadado + ",00" + `</h3>
                              <p class="card-subtitle text-muted fw-500">Total Arrecadado</p>
                           </div>
                           <div class="icon"><i class="ik ik-dollar-sign"></i></div>
                        </div>
                        <div class="progress mt-3 mb-1" style="height: 6px;">
                           <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                           </div>
                        </div>
                        <div class="text-muted f12">
                           <!-- <span>Presentes 44/45</span> -->
                           <!-- <span class="float-right">99%</span> -->
                        </div>
                     </div>
                  </div>
                  <!-- <div class="card"></div> -->
               </div>
         
         
         
         
               
               
               
            </div>
            <!-- fim progesso turmas -->
         
         
          </div>
         
         
         
         
         </div>
         </div>

            `
        }
        document.getElementById("passeiosAll").innerHTML = estrutura

    })
}



function vendasVendedores() {
    axios.post('../../api2/controller.php', {
        action: "vendasvendedores",
        values: [
            $("#fk_login_loja").val()
        ]
    }).then(function (response) {
        estrutura = ""
        for (var i = 0; i < response.data.length; i++) {

            estrutura += `
        <tr>
            <td>` + response.data[i].nome + `</td>
            <td>`+ response.data[i].total_passagens_vendidas + `</td>
            <td>R$`+ response.data[i].valor_total_passagens + `,00</td>
        </tr>`;
        }

        document.getElementById("vendedores").innerHTML = estrutura;

    })
}