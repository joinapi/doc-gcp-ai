<?php

require 'vendor/autoload.php';
require 'src/Helpers.php';

use Illuminate\Support\Facades\Log;
use Joinapi\DocumentAI\DocumentAIService;
use Joinapi\DocumentAI\Facades\DocumentAI;
use Joinapi\DocumentAI\Handlers\CNHHandler;


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['document'])) {
    try {
        // Caminho do arquivo enviado
        $uploadedFile = $_FILES['document']['tmp_name'];

        // Ler o conteúdo do arquivo





        $service = new DocumentAIService(null);
        $response = $service->withProjectId('join-fpflow')
            ->processDocument($uploadedFile,'17085d700f352998');
        $doc = \Joinapi\DocumentAI\DocumentAIParser::parseFieldsWithRaw($response);
        $cnh = new CNHHandler;
        $cnh->handle($doc);


        // Exibir os dados extraídos
        echo '<pre>';
        print_r($response);
        echo '</pre>';

    } catch (Exception $e) {
        echo 'Erro ao processar o documento: ' . $e->getMessage();
    }
} else {

    //echo json_encode(config('documentai.types.CNH'));

    $cnh = new CNHHandler;
    echo $cnh->getEntityField('NUMERO_REGISTRO');


    // Formulário de upload
    echo '<form method="POST" enctype="multipart/form-data">';
    echo '<label for="document">Selecione um documento:</label>';
    echo '<input type="file" name="document" id="document" required>';
    echo '<button type="submit">Enviar</button>';
    echo '</form>';
}

