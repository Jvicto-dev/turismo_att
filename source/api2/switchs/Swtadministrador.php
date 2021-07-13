<?php

namespace Source\api2\switchs;
use \Source\api2\classes\VendedorClass;
use \Source\api2\classes\AdministradorClass;

class Swtadministrador{
    public function switch($action, $value){
        switch($action){
            case"get-destinos":
                echo json_encode(VendedorClass::GetDestinos($value));
            break; 

            case "get-veiculos":
                echo json_encode(AdministradorClass::GetVeiculos($value));
            break; 

            case "acesso-veiculo":
                echo json_encode(VendedorClass::VeiculoFamilia($value));
            break;

            case "get-passeios-pdf":
                echo json_encode(AdministradorClass::passeioPdf($value));
            break;

            case "add-destino-veiculo":
                echo json_encode(AdministradorClass::AddDestinoVeiculo($value));
            break; 

            case "add-tabela-passeio":
                echo json_encode(AdministradorClass::insertPasseios($value));

            break;

            case "get-destinos-adm":
                echo json_encode(AdministradorClass::getDestinosAdm($value));
            break;

            case "info-passeios":
                echo json_encode(AdministradorClass::inforPasseios($value));
            break;

            case "finalizar-passeio":
                echo json_encode(AdministradorClass::finalizarPasseio($value));
            break;

            case "get-dash-admin";
                echo json_encode(AdministradorClass::getDashAdmin($value));
            break;

            case "passeio-mais-vendido":
                echo json_encode(AdministradorClass::passeioMaisVendido($value));
            break;

            case "membrosFamilia":
                echo json_encode(AdministradorClass::membrosFamilia($value));
            break;

            case "pegarCodigoFamilia":
                echo json_encode(AdministradorClass::pegarCodigoFamilia($value));
            break;

            case "valoresFinaisPdf":
                echo json_encode(AdministradorClass::getValoresFinaisPdf($value));
            break;

            case "dashboard":
                echo json_encode(AdministradorClass::getDash($value));
            break;

            case "allvendas":
                echo json_encode(AdministradorClass::allVendas($value));
            break;

            case "vendasvendedores":
                echo json_encode(AdministradorClass::vendasVendedores($value));
            break;

            case "veiculosDestinos":
                echo json_encode(AdministradorClass::getVeiculosDestinos($value));
            break;

            case "remover-veiculo-individual":
                echo json_encode(AdministradorClass::removerVeiculoIndividual($value));
            break;

            case 'get-cod-fa':
                echo json_encode(AdministradorClass::getCodFa($value));
            break;

            case 'familias-pessoas-adm':
                echo json_encode(AdministradorClass::familiasPessoasAdm($value));
            break;

            case 'cont-for-bus':
                echo json_encode(AdministradorClass::countSize($value));
            break;

            case 'add-veiculo-familias':
                echo json_encode(AdministradorClass::addVeiculoFamilia($value));
            break;

            case "pegar-veiculos":
                echo json_encode(AdministradorClass::pegarVeiculos($value));
            break;

            case "get-one-veiculo":
                echo json_encode(AdministradorClass::getOneVeiculo($value));
            break;

            case "trocar-veiculo":
                echo json_encode(AdministradorClass::trocarVeiculo($value));
            break;

            case "get-vendedores":
                echo json_encode(AdministradorClass::getVendedores($value));
            break;

            case "get-comissao-individual":
                echo json_encode(AdministradorClass::getComissaoIndividual($value));
            break;

            case "historico-individual":
                echo json_encode(AdministradorClass::getHistoricoIndividual($value));
            break;

            case "transacao":
                echo json_encode(AdministradorClass::transacao($value));
            break;

            case "apagar-transacao":
                echo json_encode(AdministradorClass::apagarTransacao($value));
            break;

            case "values-graph":
                echo json_encode(AdministradorClass::valuesGraph($value));
            break;

            case "values-graph-vendedor":
                echo json_encode(AdministradorClass::valuesGraphVendedor($value));
            break;

            case "tabela-vendas-pdia":
                echo json_encode(AdministradorClass::tabelaVendasPdia($value));
            break;

            case "grafico-geral-destino":
                echo json_encode(AdministradorClass::graficoGeralDestino($value));
            break;

            case "grafico-geral-vendedores";
                echo json_encode(AdministradorClass::graficoGeralVendedor($value));
            break;

            case "add_ponto":
                echo json_encode(AdministradorClass::addPonto($value));
            break;

            case "read-ponto-encontro":
                echo json_encode(AdministradorClass::readPonto($value));
            break;

            case "excluir-local":
                echo json_encode(AdministradorClass::excluirLocal($value));
            break;

            case "read-ponto-encontro-one":
                echo json_encode(AdministradorClass::readPontoOne($value));
            break;

            case "ponto-update":
                echo json_encode(AdministradorClass::pontoUpdate($value));
            break;  

            case "insert-guia-motorista":
                echo json_encode(AdministradorClass::insertGuiaEMotorista($value));
            break; 

            case "get-motorista-guia": 
                echo json_encode(AdministradorClass::getMotoristaGuia($value));
            break;

            case "deletar_responsavel":
                echo json_encode(AdministradorClass::deletarResponsavel($value));
            break;

            /* essa função chama apenas se há pessoas nos veiculo 
                ou seja, se não existir o id de um veiculo 
                para aquele destino e para aquela data ele não chama nada pq 
                a agencia não colocou ninguem ainda
            */
            case "chama-veiculos-de-passeio":
                echo json_encode(AdministradorClass::getVeiculosPasseio($value));
            break;

            case "read-destino-encontro-one":
                echo json_encode(AdministradorClass::chamaumdestino($value));
            break;
        }
    }
}