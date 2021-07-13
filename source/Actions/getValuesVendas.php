<?php

@$allnomes = $_POST['allnomes']; // 
@$allemails = $_POST['allemails']; // 
@$alltelefone1 = $_POST['alltelefone1']; // 
@$alltelefone2 = $_POST['alltelefone2']; // 
@$allselects = $_POST['allselects'];
@$fk_login_loja = $_POST['fk_login_loja'];

$code = substr(md5(md5(time())), -8);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BycruptedPageOnDOm</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

     <!-- Sweetalert JS -->
     <script src="../../Plugins/Sweetalert/Js/sweetalert2.all.min.js"></script>

    <!-- Sweetalert CSS -->
    <script src="../../Plugins/Sweetalert/Css/sweetalert2.min.css"></script>


</head>
<body onload="jogaValorProaxios()">
    
<script>

function jogaValorProaxios(){
    var x1 = $("#valorFinalNomes").val(); // nomes
    var x2 = $("#valorfinalEmails").val(); // emails
    var x3 = $("#valorfinalTelefones1").val(); // telefones
    var x4 = $("#valorfinalTelefones2").val(); // || 
    var x5 = $("#codigoFamilia").val() // codigo familia
    var x6 = $("#fk_login_loja").val(); // fk da loja em questão 
    // var x5 = $("#valorfinalSelects").val() // selects

    enviaaxiosCadastroVenda(x1,x2,x3,x4,x5,x6)
                // arrayNomes
                // arrayEmails
                // arrayTelefones1
                // arrayTelefones2
                // codigoFamilia
                // fk_login_loja


}

</script>

<input type="text" id="valorFinalNomes" value="<?=$allnomes?>" placeholder="Nomes:"><br><br>
<input type="text" id="valorfinalEmails" value="<?=$allemails?>" placeholder="Emails:"><br><br>
<input type="text" id="valorfinalTelefones1" value="<?=$alltelefone1?>" placeholder="Telefones 1:"><br><br>
<input type="text" id="valorfinalTelefones2" value="<?=$alltelefone2?>" placeholder="Telefones 2:"><br><br>
<!-- <input type="text" id="valorfinalTelefones2" value="<?php // $alltelefone2?>" placeholder="Telefones 2:"><br><br> -->
<input type="text" id="codigoFamilia" value="<?=$code?>" placeholder="Code:"><br><br>

<input type="text" id="fk_login_loja" value="<?= $fk_login_loja?>" placeholder="fk_login_loja"><br><br>

<script src="../../plugins/axios/axios.js"></script>
        
<!-- <script src="../../Mains/personal_main.js"></script> -->






<script>

function enviaaxiosCadastroVenda(arrayNomes, arrayEmails, arrayTelefones1, arrayTelefones2, codigoFamilia,fk_login_loja){
  axios.post('../api2/controller.php', {
            action: "fazer-venda",
            values: [
                arrayNomes,
                arrayEmails,
                arrayTelefones1,
                arrayTelefones2,
                codigoFamilia,
                fk_login_loja
            ]
        }).then(function(response){
      Swal.fire(
      'Cadastrado !',
      'Venda feita com sucesso!',
      'success'
    );
    // setTimeout(function() {
    //   location.href = "CadastroTreinoCliente.php";
    // }, 1500);
        })
}

</script>





</body>
</html>