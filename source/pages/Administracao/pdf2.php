<?php

// use Dompdf\Dompdf;
// // use Dompdf\Options;
require __DIR__."../../../../vendor/autoload.php";



use Dompdf\Dompdf;
use Dompdf\Options;


// instanciando options
$options = new Options();
$options->setChroot(__DIR__);
$options->setIsRemoteEnabled(true);



// instanciando de dompdf
$dompdf = new Dompdf($options);


ob_start();

require __DIR__."/pdfpontoencontro.php";
$dompdf->load_html(ob_get_clean());




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
