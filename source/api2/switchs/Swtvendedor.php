<?php

namespace Source\api2\switchs;

use Source\api2\classes\AdministradorClass;
use \Source\api2\classes\VendedorClass;

class Swtvendedor{
    public function switch($action, $value){
        switch($action){
            case"get-destinos":
                echo json_encode(VendedorClass::GetDestinos($value));
            break;

            case "passeiosVendedor":
                echo json_encode(VendedorClass::passeioVendedor($value));
            break;

            case "passagens":
                echo json_encode(VendedorClass::GetPassagens($value));
            break;

            case "veiculos":
                echo json_encode(VendedorClass::GetVeiculosVendedor($value));
            break;

            case "fazer-venda":
                echo json_encode(VendedorClass::Vender($value));
            break;

            case "acesso-veiculo":
                echo json_encode(VendedorClass::VeiculoFamilia($value));
            break;

            case "enviar-tabela-vendas":
                echo json_encode(VendedorClass::TabelaVendas($value));
            break;

            case "valor-epoca":
                echo json_encode(VendedorClass::ValorEpoca($value));
            break;

            case "minhas-vendas":
                echo json_encode(VendedorClass::GetMInhasVendas($value));
            break;

            case "get-dash-vendedor";
                echo json_encode(VendedorClass::getDashVendedor($value));
            break;

            case "passeio-mais-vendido-vendedor":
                echo json_encode(VendedorClass::getPasseioMaisVendidoVendedor($value));
            break;

            case "hoteis":
                echo json_encode(VendedorClass::getHoteis($value));
            break;

            case "enviar-tabela-hotel_familia":
                echo json_encode(VendedorClass::TabelaHotelFamilia($value));
            break;

            case "codigo-vendedor-familias":
                echo json_encode(VendedorClass::getCodVendFay($value));
            break;

            case "vaucher":
                echo json_encode(VendedorClass::insertVaucher($value));
            break;

            case "ponto_encontro":
                echo json_encode(VendedorClass::pontoEncontro($value));
            break;

            case "cancelar-venda-familia":
                echo json_encode(VendedorClass::cancelarVendaFamilia($value));
            break;

            case "passagem-familia":
                echo json_encode(VendedorClass::passagemFamilia($value));
            break;

            // esse puxa o ponto mas entra no nivel de acesso administrador
            case "read-ponto-encontro":
                echo json_encode(AdministradorClass::readPonto($value));
            break;

            case "get-name-hotel":
                echo json_encode(VendedorClass::getNameHotel($value));
            break;

            case "gerar-info-for-email":
                echo json_encode(VendedorClass::gerarInfoEmail($value));
            break;

            case "informacoesGerais":
                echo json_encode(VendedorClass::informacoesGerais($value));
            break;

            case "send-email":
                echo json_encode(VendedorClass::send($value));
            break;

        }
    }
}