<?php

// use Dompdf\Dompdf;
// // use Dompdf\Options;
require __DIR__."../../../../vendor/autoload.php";





// $dompdf = new Dompdf();






// $id_passeio = $_GET['id'];

// ob_start();

// include __DIR__."/passeios.php";
// $dompdf->load_html(ob_get_clean());


// $dompdf->setPaper("A4");
// $dompdf->render();
// $dompdf->stream("file.pdf",["Attachment"=>false]);


// use Dompdf\Dompdf;

// require __DIR__."../../../../vendor/autoload.php";

// $dom = $_GET['dom'];
// $dompdf = new Dompdf();
// $dompdf->load_html($dom);

// $id_passeio = $_GET['id'];

// // ob_start();

// // include __DIR__."/passeios.php";
// // $dompdf->load_html(ob_get_clean());


// $dompdf->setPaper("A4");
// $dompdf->render();
// $dompdf->stream("file.pdf",["Attachment"=>false]);

//Autoload do composer


use Dompdf\Dompdf;
use Dompdf\Options;


// instanciando options
$options = new Options();
$options->setChroot(__DIR__);
// $options->setIsRemoteEnabled(true);
$options->set('isRemoteEnabled', TRUE);
// $dompdf->set_base_path("http://localhost/Turismo/source/pages/Administracao/");

// instanciando de dompdf
$dompdf = new Dompdf($options);


ob_start();

require __DIR__."/passeios2.php";
$dompdf->load_html(ob_get_clean());

// carrega o html para dentro da pagina
// $dompdf->load_html('<b>Olá Mundo</b>');
// $dompdf->load_html_file(__DIR__.'/arquivo.html');



// pagina papel usado

// deitado
$dompdf->setPaper('A4','landscape');
// em pé
// $dompdf->setPaper('A4','portrait');

// Renderizar o arquivo pdf 
$dompdf->render();

// imprime o conteudo do arquivo pdf na tela 
header('Content-type: application/pdf');
echo $dompdf->output();






// Download
// $dompdf->stream('documento-teste.pdf');