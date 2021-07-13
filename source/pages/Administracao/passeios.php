


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>GERANDO PDF</title>

  
    
  </head>
  <body>
    

   
<?php

$id_passeio = $_GET['id'];

echo "O valor de teste é ".$id_passeio;
?>

<input type="text" id="id_do_passeio_pdf" value="<?=$id_passeio?>">
<input type="text" id="select_passeios" value="<?=$id_passeio?>"> select passeios


<div id="dados">

    <div id="nome_passeio"></div>

    <div id="tabela"></div>

    <div id="infors"></div> 
    
</div>


<input type="button" value="imprimir" onclick="print()" >








<script>
function funcao_pdf(){


var pegar_dados = document.getElementById("dados").innerHTML
var janela = window.open('','','width=800,heigh=600')

var comporta = `

<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <h1>Hello, world!</h1>

    <!-- Optional JavaScript; choose one of the two! -->
    `+pegar_dados+`
    <!-- Option 1: Bootstrap Bundle with Popper -->
    
  </body>
</html>
`;




janela.document.write(comporta);
janela.document.close;
janela.print();
}
</script>


        <script src="../../../plugins/axios/axios.js"></script> 
        <script src="../../Mains/administrador_main.js"></script>

        
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <script>
            
            gerarCodigoFamilia()
            GerarPdf()

    function teste(){
      var teste = $("#infors").val()
      alert(teste)
      // document.write(teste);


    }

    teste()


        </script>
    
  </body>
</html>