function getDestinos() {
    var fk_login_loja = $("#fk_login_loja").val()
    // alert(fk_login_loja)
    axios.post('../../api2/controller.php', {
        action: "get-destinos",
        values: [
            fk_login_loja
        ]
    })
        .then(function (response) {

            estrutura = "";
            option = "";
            for (var i = 0; i < response.data.length; i++) {


                estrutura += `
            <option onclick="" value="` + response.data[i].id_destino + `">` + response.data[i].nome_destino + `</option>
        `;

                option = `<option value="xyk">Selecione um destino</option>` + estrutura;
            }

            document.getElementById("select_destinos0").innerHTML = option;

        }).catch(err => console.log(err));
}

function getPasseios() {
    axios.post('../../api2/controller.php', {
        action: "passeiosVendedor",
        values: [

        ]
    })
        .then(function (response) {

            estrutura = "";
            option = "";
            for (var i = 0; i < response.data.length; i++) {


                estrutura += `
        <option onclick="" value="` + response.data[i].id_destino_fk + `">` + response.data[i].nome_destino + `</option>
    `;

                option = `<option value="xykk">Selecione um destino</option>` + estrutura;
            }

            document.getElementById("select_destinos0").innerHTML = option;

        })
}

var gb = ""
function gerarVenda() {
    var id_destino = $("#select_destinos0").val()
    var fk_login_loja = $("#fk_login_loja").val()
    // console.log(id_destino)

    if (id_destino == "xyk") {
        Swal.fire(
            'Erro',
            'Selecione um destino antes',
            'error'
        );


    } else {

        axios.post('../../api2/controller.php', {
            action: "passagens",
            values: [
                id_destino,
                fk_login_loja
            ]
        })
            .then(function (response) {

                estrutura = "";
                option = "";
                for (var i = 0; i < response.data.length; i++) {

                    // alert(response.data[i].nome);
                    estrutura += `
                   <option onclick="" value="`+ response.data[i].valor + `|` + response.data[i].id_passagem + `">` + response.data[i].nome_destino + " - Categoria:  " + response.data[i].nome_categoria + " Preço: " + response.data[i].valor + `</option> `;


                    gb = estrutura;

                    // option = `<option value="xyk">Selecione uma passagem para o responsavel</option>` + estrutura;
                }


                document.getElementById("select_passagens0").innerHTML = estrutura;
                document.getElementById("familia").innerHTML = '' // teste

            })

        // ==========================
        axios.post('../../api2/controller.php', {
            action: "hoteis",
            values: [
                fk_login_loja
            ]
        })
            .then(function (response) {

                estrutura = "";
                option = "";
                for (var i = 0; i < response.data.length; i++) {

                    // alert(response.data[i].nome);
                    estrutura += `
    <option onclick="" value="`+ response.data[i].id_hotel + `">` + response.data[i].nome_hotel + `</option>`;




                    option = `<option value="0xkcpj">Sem hotel para a familia</option>` + estrutura;
                }


                document.getElementById("select_hotel").innerHTML = option;
                // document.getElementById("familia").innerHTML = "" // testando

            })
        // ==========================



        var id_gambiarra = ""
        // Axios 2 disparado aqui 
        axios.post('../../api2/controller.php', {
            action: "veiculos",
            values: [
                id_destino,
                fk_login_loja

            ]
        }).then(function (response) {
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
                        response.data[i].id_veiculo,
                        response.data[i].id_veiculo,
                        response.data[i].id_veiculo,
                        response.data[i].id_veiculo,
                        response.data[i].id_veiculo,
                    ]
                }).then(function (response) {
                    for (var j = 0; j < response.data.length; j++) {
                        // alert(id_gambiarra)
                        estru += `<option value=" ` + response.data[j].idVeiculo + `|` + response.data[j].calculo + `">` + response.data[j].nomeVeiculo + " | Vagas Restantes: " + response.data[j].calculo + `</option>`
                        // options = `<option value="xykss">Selecione um Veiculo</option>` + estru;

                    }
                    // document.getElementById("select_veiculo").innerHTML = options;
                    // document.getElementById("select_veiculo").innerHTML = estru;

                    // var testesemfor = 


                })

                //fim do axios que coloquei dentro do outro 

            }

        })

        // Axios 3 disparado aqui
        readPonto()




    }// fim do laço else

}




function colocaOption() {
    var x = document.querySelectorAll('[name=select_passagens_familiares]');
    for (var j = 0; j <= x.length; j++) {
        x[j].innerHTML = gb;
    }
}

function gerarPassagensFamiliares() { // gera o escopo da informações e passagens dos vamiliares 


    var id_destino = $("#select_destinos0").val()
    var fk_login_loja = $("#fk_login_loja").val()
    var sizefamily = $("#sizefamily").val()


    if (id_destino != "xykk") {

        h3 = `<h3>Familiar` + v + `</h3>`
        estrutura = "";

        for (var v = 0; v < sizefamily; v++) {
            inputs = `<div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail3">Nome</label>
                            <input type="text" class="form-control" id="nome`+ (v + 1) + `" placeholder="Nome">
                        </div>
                    </div>

                    <div class="col-md-6">
                        
                        <div class="form-group">
                            <label for="exampleSelectGender">Passagem do Familiar</label>
                            <select name="select_passagens_familiares" onchange="valorEpocaFamiliares()" id="select_passagens`+ (v + 1) + `" class="form-control">
                    
                            </select>
                        </div>
   
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="exampleInputEmail3">Valor de venda</label>
                            <input type="text" onkeyup="k(this)" class="form-control" id="valor_venda`+ (v + 1) + `" placeholder="R$..">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail3">Rg familiar</label>
                        <input type="text" class="form-control" id="rg`+ (v + 1) + `" placeholder="Rg...">
                    </div>

                    </div>


                    <div class="form-group">
                    <input type="hidden" id="email`+ (v + 1) + `" value="---"><br>
                    <input type="hidden" id="telefoneA`+ (v + 1) + `" value="---"><br>
                    <input type="hidden" id="telefoneB`+ (v + 1) + `" value="---"><br>
                    <input type="hidden" id="valorepoca`+ (v + 1) + `" value=""><br>
                    <input type="hidden" id="rg`+ (v + 1) + `" value="---"><br>

                    </div>
                    </div>`

            estrutura += `<h3>Familiar ` + (v + 1) + `</h3>` + inputs




        }




        document.getElementById("familia").innerHTML = estrutura;
        colocaOption()

    } else if (sizefamily == "") {
        alert("Insira a quantidade de membros")
    } else {
        alert("selecione o destino primeiro")
    }

}


function verificarPassagens() {
    var verify = []

    while (verify.length > 0) { // limpa o array caso aja outro onclick ou chamada da função
        verify.pop();
    }

    var sizefamily = $("#sizefamily").val() // tamanho da familia

    for (var v = 0; v <= sizefamily; v++) {

        var vvenda = $("#valor_venda" + v).val()
        var id_passagem2 = $("#select_passagens" + v).val()
        var valor_na_epoca_verify = id_passagem2.split('|')

        if (parseFloat(vvenda) < valor_na_epoca_verify[0]) {
            verify.push("F")
        } else {
            verify.push("V")
        }


    }

    if (verify.indexOf("F") > -1) {

        return false;
    } else {
        return true;
    }



}



function jogaValues() { // função que desencadeia a maioria das outras funções

    if ($("#nome0").val() == "" || // esse if verifica se o vendedor digitou as informações do responsavel pela familia
        $("#email0").val() == "" ||
        $("#telefoneA0").val() == "" ||
        // $("#telefoneB0").val() == "" || // vai ficar assim pq o lorenzo quer que seja obrigatorio apenas 1 telefone e não mais 2
        $("#valor_entrada").val() == ""
    ) {
        Swal.fire(
            'Erro',
            'complete os dados',
            'error'
        );
    } else if ($("#select_hotel").val() != "0xkcpj" && $("#valor_hotel_familia").val() == '') {
        Swal.fire(
            'Erro',
            'hotel selecionado, digite um valor então',
            'error'
        );
    } else if ($("#select_hotel").val() != "0xkcpj" && $("#valor_hotel_familia").val() != '' && $("#n_apartamento").val() == '') {
        Swal.fire(
            'Erro',
            'hotel selecionado e um valor inseridos, agora digite o nº do apartamento(descrição)',
            'error'
        );

    } else if (!verificarPassagens()) {
        Swal.fire(
            'Opps !!',
            'Voce esta tentando vender alguma passagem por um preço menor que o da empresa',
            'error'
        );

    } else {

        var sizefamily = $("#sizefamily").val()

        nome = ""
        email = ""
        telefoneA = ""
        telefoneB = ""
        destinos = ""
        var id_destino_fk = $("#select_destinos0").val()
        // var select = $("#select_veiculo").val()
        // var retorno = select.split("|");
        var sizefamilyInteiro = parseInt(sizefamily, 10)
        var fk_login_loja = $("#fk_login_loja").val()
        // alert(retorno[1])
        tamanho = (sizefamily + 1)



        enviatabelaHotelFamilia()
        vaucher()
        ponto_encontro()
        // inforsEmail()


        for (var v = 0; v <= (sizefamily + 1); v++) {
            var id_passagem2 = $("#select_passagens" + v).val().split('|') // pega o valor na espoca[0] e o id da passagem[1] 
            var valor_venda = $("#valor_venda" + v).val()



            if ($("#nome" + v).val() == "" ||
                $("#email" + v).val() == "" ||
                $("#telefoneA" + v).val() == "" ||
                // $("#telefoneB" + v).val() == "" ||
                $("#rg" + v).val() == ""
            ) {
                Swal.fire(
                    'Erro',
                    'complete os dados',
                    'error'
                );
            } else {



                nome = $("#nome" + v).val()
                rg = $("#rg" + v).val()
                email = $("#email" + v).val()
                telefoneA = $("#telefoneA" + v).val()
                telefoneB = $("#telefoneB" + v).val()
                id_passagem = $("#select_passagens" + v).val() // pega as passagens de todas as pessoas (primeiro o responsavel depois os familiares, nessa ordem.)
                var id_vendedor = $("#id_vendedor").val() // pega o id do vendedor
                // var id_veiculo_fk = retorno[0]
                var id_codigo_familia = $("#id_codigo_familia").val()
                var data_para_viagem = $("#data_ir").val()
                // var aux_id_passagem = id_passagem.split("|");

                //  foi trocado pois agora, ele tem que enviar como 0(zero) para pegar um (sem veiculo na tabela) se não da erro 

                if (telefoneB == ''){
                    telefoneB = "----"
                }


                enviaaxiosCadastroVenda(nome, rg, email, telefoneA, telefoneB, id_destino_fk, 0, id_passagem2[1], id_vendedor, id_passagem2[0], valor_venda, id_codigo_familia, data_para_viagem, fk_login_loja)
                // tabelaVendas(id_passagem2[1], id_vendedor, id_passagem2[0], valor_venda, fk_login_loja)
                // enviatabelaHotelFamilia(id_hotel,id_codigo_familia,valor_hotel_familia)

            }




        }




    }




}



function enviaaxiosCadastroVenda(arrayNomes, rg, arrayEmails, arrayTelefones1, arrayTelefones2,
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
        // Swal.fire(
        //     'Cadastrado !',
        //     'Venda feita com sucesso!',
        //     'success'
        // );
        // setTimeout(function () {
        //     location.href = "fazerVenda.php";
        // }, 1500);
    })
}

function tabelaVendas(id_passagem_fk, id_vendedor_login_fk, valor_na_epoca, valorDeVenda, fk_login_vendas_loja) {
    axios.post('../../api2/controller.php', {
        action: "enviar-tabela-vendas",
        values: [
            id_passagem_fk,
            id_vendedor_login_fk,
            valor_na_epoca,
            valorDeVenda,
            fk_login_vendas_loja
        ]
    }).then(function (response) {

    })
}

function inforsEmail() {

    // alert($("#id_codigo_familia").val()) // ------------------------------------------------------------
    informacoes_gerais = []
    estrutura = "";
    axios.post('../../api2/controller.php', {
        action: "gerar-info-for-email",
        values: [
            $("#id_codigo_familia").val()
        ]
    }).then(function (response) {

        for (var i = 0; i < response.data.length; i++) {
            estrutura += `<tr>
            <td style="padding: 5px 10px 5px 0"
                width="80%" align="left">
                <p>`+ response.data[i].nome + `<br>rg: ` + response.data[i].rg + `<br>
                categoria:`+ response.data[i].categoriaPassagem + ` </p>
            </td>
            <td style="padding: 5px 0" width="20%"
                align="left">
                <p>R$`+ response.data[i].valor_de_venda + `,00</p>
            </td>
        </tr>
       `
        }



        axios.post('../../api2/controller.php', {
            action: "informacoesGerais",
            values: [
                $("#id_codigo_familia").val()
            ]
        }).then(function (response) {
            nome_hotel = response.data[0].nome_hotel_familia;
            valor_hotel_familia = response.data[0].valor_hotel_familia
            nome_agencia = response.data[0].nome_agencia
            dia_viagem = response.data[0].dia_viagem
            destino = response.data[0].nome_destino
            total = response.data[0].valor_total
            entrada = response.data[0].valor_entrada_familia
            restante = response.data[0].valor_restante_familia
            email = response.data[0].email_suporte_loja
            contato = response.data[0].numero_contato_loja
            email_cliente = response.data[0].email_cliente_responsavel
            apartamento = response.data[0].n_apartamento
            ponto_de_encontro = response.data[0].ponto_encontro
            cnpj = response.data[0].cnpj_loja
            endereco = response.data[0].endereco_loja
            site = response.data[0].website_loja
            sendEmail(estrutura, nome_hotel, valor_hotel_familia,
                nome_agencia, dia_viagem, destino, total, entrada, restante, email, contato, email_cliente, apartamento, ponto_de_encontro, cnpj, endereco, site)
        })





    })





}

// juro que fiz uma função mais bonita, deu erro e tive de fazer essa desgraça 


function enviatabelaHotelFamilia() {
    var id_destino_fk = $("#select_destinos0").val()
    var id_hotel_fk = $("#select_hotel").val()
    var id_vendedor = $("#id_vendedor").val()
    var id_codigo_familia_para_hotel = $("#id_codigo_familia").val()
    var valor_hotel_familia = $("#valor_hotel_familia").val()
    var n_apartamento = $("#n_apartamento").val()

    // alert(id_hotel_fk)

    axios.post('../../api2/controller.php', {
        action: "enviar-tabela-hotel_familia",
        values: [
            id_destino_fk,
            id_hotel_fk,
            id_vendedor,
            id_codigo_familia_para_hotel,
            n_apartamento,
            valor_hotel_familia
        ]
    }).then(function (response) {

        // console.log(response.data)

        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Aguarde....',
            showConfirmButton: false,
            timer: 1500
        })

        setTimeout(function () {
            inforsEmail() // essa função é um perigo na moral
            // location.href = "fazerVenda.php"; // não pode descomentar
        }, 1500);

    }).catch(err => console.log(err));
}

function vaucher() {

    axios.post('../../api2/controller.php', {
        action: "vaucher",
        values: [
            $("#id_vendedor").val(),
            $("#id_codigo_familia").val(),
            $("#valor_entrada").val(),
            $("#forma_pagamento_familia").val()

        ]
    })
}

function ponto_encontro() {
    axios.post('../../api2/controller.php', {
        action: "ponto_encontro",
        values: [
            $("#id_codigo_familia").val(),
            $("#select_destinos0").val(),
            $("#id_vendedor").val(),
            $("#select_ponto_encontro").val()
        ]
    })
}


// função para email em: main_email.js

function chamaVendas() {
    var id_destino = $("#destino_vendedor").val()
    var id_vendedor = $("#id_do_vendedor").val()
    // getMinhasVendas(id_destino,id_vendedor)
    pegarCodigoFamiliaVendedor(id_vendedor, id_destino)
}









function pegarCodigoFamiliaVendedor(id_vendedor, id_do_destino) {
    axios.post('../../api2/controller.php', {
        action: "codigo-vendedor-familias",
        values: [
            id_vendedor,
            id_do_destino

        ]
    }).then(function (response) {
        tableEstru = "";
        for (var i = 0; i < response.data.length; i++) {
            tbodyVendedor(id_do_destino, id_vendedor, response.data[i].cFamilia)

            tableEstru += `
           
<div class="card-body p-0 table-border-style">
   <div class="table-responsive">
      <table class="table table-inverse">
         <thead>
            <tr>
               <th>Nome</th>
               <th>Email</th>
               <th>Telefone 1</th>
               <th>Telefone 2</th>
               <th>Dia</th>
               <th>Nome Veiculo</th>
               <th>Valor da passagem</th>
               
               <th><button onclick="exluirFamilia('`+ response.data[i].cFamilia + `')" type="button" class="btn btn-outline-primary">Remover Familia</button>
               <button onclick="update('`+ response.data[i].cFamilia + `')" type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i></button>
               </th>
            </tr>
         </thead>
         <tbody id="carrega_tabela_familias`+ response.data[i].cFamilia + `">
         </tbody>
      </table>
      <th>
   </div>
</div>
            `;
        }
        document.getElementById("tables").innerHTML = tableEstru
    })
}


function exluirFamilia(codigoFamilia) {




    Swal.fire({
        title: 'Tem certeza disso ?',
        text: "Cancelando esta Venda",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            axios.post('../../api2/controller.php', {
                action: "cancelar-venda-familia",
                values: [
                    codigoFamilia
                ]

            }).then(function (response) {
                Swal.fire(
                    'Sucesso',
                    'Cancelado Com sucesso!',
                    'success'
                );
                setTimeout(function () {
                    location.href = "suasVendas.php";
                }, 1500);

            })
        }
    })






}


function tbodyVendedor(id_do_destino, id_vendedor, codigo_familia) {
    axios.post('../../api2/controller.php', {
        action: "minhas-vendas",
        values: [
            id_do_destino,
            id_vendedor,
            codigo_familia
        ]
    }).then(function (response) {
        estrutura_tbody = "";
        for (var i = 0; i < response.data.length; i++) {

            estrutura_tbody += `

        <tr>
            <td>` + response.data[i].nome + `</td>
            <td> `+ response.data[i].email + `  </td>
            <td> `+ response.data[i].telefone1 + `  </td>
            <td> `+ response.data[i].telefone2 + `  </td>
            <td> `+ response.data[i].dia + `  </td>
            <td> `+ response.data[i].nome_veiculo + `  </td>
            <td>R$`+ response.data[i].valor_na_epoca + ",00" + `</td>
          
        </tr>

`;

        }
        codigo = codigo_familia
        document.getElementById("carrega_tabela_familias" + codigo).innerHTML = estrutura_tbody;


    })
}

function Teste(a) {
    console.log(a)
}











function loadDestinos() {
    axios.post('../../api2/controller.php', {
        action: "get-destinos",
        values: [
            $("#fk_login_loja").val()
        ]
    }).then(function (response) {

        estrutura = "";
        option = "";
        for (var i = 0; i < response.data.length; i++) {


            estrutura += `
        <option onclick="" value="` + response.data[i].id_destino + `">` + response.data[i].nome_destino + `</option>
    `;

            option = `<option value="xyk">Selecione um destino</option>` + estrutura;
        }

        document.getElementById("destino_vendedor").innerHTML = option;

    })
}






function dashboardVendedor() {
    idLoja = $("#id_da_loja").val()
    idVendedor = $("#id_do_vendedor").val()
    axios.post('api2/controller.php', {
        action: "get-dash-vendedor",
        values: [
            idVendedor,
            idLoja
        ]
    }).then(function (response) {
        estrutura3 = ""
        for (var i = 0; i < response.data.length; i++) {
            estrutura3 += `
            <div class="container-fluid">
            <div class="row clearfix">
            <div class="col-lg-3 col-md-6 col-sm-12">
               <div class="widget">
                  <div class="widget-body">
                     <div class="d-flex justify-content-between align-items-center">
                        <div class="state">
                           <h6>Vendas Totais</h6>
                           <h2>`+ response.data[i].tVendasVendedor + `</h2>
                        </div>
                        <div class="icon">
                           <i class="ik ik-users"></i>
                        </div>
                     </div>
                     <small class="text-small mt-10 d-block">Total de Vendas</small>
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
                           <h6>Arrecadado</h6>
                           <h5>`+ "R$" + response.data[i].resumoVendedor + ",00" + `</h5>
                        </div>
                        <div class="icon">
                        <i class="ik ik-shopping-bag"></i>
                        </div>
                     </div>
                     <small class="text-small mt-10 d-block">Arrecadado</small>
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
                            <h6>Vendas de Hoje</h6>
                           <h2>`+ response.data[i].vendasDiaVendedor + `</h2>
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
                           <h6>Resumo do dia</h6>
                           <h4>`+ "R$" + response.data[i].resumoDiaVendedor + ",00" + `</h4>
                           
                        </div>
                        <div class="icon">
                           <i class="ik ik-shield"></i>
                        </div>
                     </div>
                     <small class="text-small mt-10 d-block">Resumo de Hoje</small>
                  </div>
                  <div class="progress progress-sm">
                     <div class="progress-bar bg-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                  </div>
               </div>
            </div>
            `
        }

        document.getElementById("dashboardVendedor").innerHTML = estrutura3
    })
}






function passeioMaisVendidoVendedor() {
    idLoja2 = $("#id_da_loja").val()
    idVendedor2 = $("#id_do_vendedor").val()
    axios.post('api2/controller.php', {
        action: "passeio-mais-vendido-vendedor",
        values: [
            idVendedor2,
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
                           <h5>Passeio mais Vendido por Você</h5>
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
                              <h5>`+ response.data[i].nome_destino + `</h5>
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
        document.getElementById("passseio_mais_vendido_vendedor").innerHTML = estrutura

    })
}


