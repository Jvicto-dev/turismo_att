<?php

namespace Source\api2;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;

class Email
{

    /**
     * muito chato pra enviar o email pq tem 
     * que achar as credencias de smtp dos
     * servidores, porta e os caralho a 4
     * só consegui depois que entrei por um servidor... 
     * wtf man... mas deu bom no final 
     */

    //credenciais ao smtp
    const HOST = 'turismo.serverredtag.com';
    const USER = 'turismoemail@turismo.serverredtag.com';
    const PASS = 'pRv=k2d[=lE+';
    const SECURE = 'ssl';
    const PORT = 465;
    const CHARSET = 'UTF-8';

    //dados do remetente
    const FROM_EMAIL = 'turismoemail@turismo.serverredtag.com';
    const FROM_NAME = 'SISTEMA DE TURISMO';

    // mensagem de erro do envio
    private $error;

    // metodo responsavel por retornar o erro
    public function getError()
    {
        return $this->error;
    }

    // metodo responsavel por enviar um email
    public function sendEmail($adresses, $subject, $body, $atachments = [], $ccs = [], $bccs = [])
    {
        // Limpar a mensagem de erro
        $this->error = '';

        //Instancia de PHPMailer
        $obMail = new PHPMailer(true);

        try {

            // CREDENCIAIS DE ACESSO AO SMTP
            $obMail->isSMTP(true);
            $obMail->Host = self::HOST;
            $obMail->SMTPAuth = true;
            $obMail->Username = self::USER;
            $obMail->Password = self::PASS;
            $obMail->SMTPSecure = self::SECURE;
            $obMail->Port = self::PORT;
            $obMail->CharSet = self::CHARSET;

            //REMETENTE
            $obMail->setFrom(self::FROM_EMAIL, self::FROM_NAME);

            // DESTINATARIOS
            $adresses = is_array($adresses) ? $adresses : [$adresses];
            foreach ($adresses as $adress) {
                $obMail->addAddress($adress);
            }

            // ANEXOS
            $atachments = is_array($atachments) ? $atachments : [$atachments];
            foreach ($atachments as $atachment) {
                $obMail->addAttachment($atachment);
            }

            // CC
            $ccs = is_array($ccs) ? $ccs : [$ccs];
            foreach ($ccs as $cc) {
                $obMail->addCC($cc);
            }

            // BCC
            $bccs = is_array($bccs) ? $bccs : [$bccs];
            foreach ($bccs as $bcc) {
                $obMail->addBCC($bcc);
            }

            //CONTEUDO DO EMAIL
            $obMail->isHTML(true);
            $obMail->Subject = $subject;
            $obMail->Body = $body;

            // ENVIA O E-MAIL
            return $obMail->send();

        } catch (PHPMailerException $e) {
            $this->error = $e->getMessage();
            return false;
        }
    }
}
