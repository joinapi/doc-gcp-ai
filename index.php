<?php

require 'vendor/autoload.php';

use Illuminate\Support\Facades\Log;
use Joinapi\DocumentAI\DocumentAIService;


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['document'])) {
    try {
        // Caminho do arquivo enviado
        $uploadedFile = $_FILES['document']['tmp_name'];

        // Ler o conteúdo do arquivo



        $service = new DocumentAIService(null);
        $response = $service->withProjectId('join-fpflow')
            ->processDocumentAsParser($uploadedFile,'17085d700f352998');


        // Exibir os dados extraídos
        echo '<pre>';
        print_r($response);
        echo '</pre>';

    } catch (Exception $e) {
        echo 'Erro ao processar o documento: ' . $e->getMessage();
    }
} else {

    // Formulário de upload
    echo '<form method="POST" enctype="multipart/form-data">';
    echo '<label for="document">Selecione um documento:</label>';
    echo '<input type="file" name="document" id="document" required>';
    echo '<button type="submit">Enviar</button>';
    echo '</form>';
}