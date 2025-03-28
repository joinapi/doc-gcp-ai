<?php

namespace Joinapi\DocumentAI;

use Google\ApiCore\ApiException;
use Google\ApiCore\ValidationException;
use Google\Cloud\DocumentAI\V1\Client\DocumentProcessorServiceClient;
use Google\Cloud\DocumentAI\V1\Document;
use Google\Cloud\DocumentAI\V1\ProcessRequest;
use Google\Cloud\DocumentAI\V1\RawDocument;

class DocumentAIService
{
    protected $app;

    public const PROJECT_ID_CONFIG = 'joinapi.gcp.docai.project';

    public const PROJECT_CREDENTIALS_CONFIG = 'joinapi.gcp.docai.credentials';

    public const PROJECT_LOCATION_CONFIG = 'joinapi.gcp.docai.location';

    protected string $projectId;

    protected string $processor;

    protected string $location;

    protected DocumentProcessorServiceClient $client;

    public function __construct($app)
    {
        $this->app = $app;

        $this->client = new DocumentProcessorServiceClient();

        $this->location = 'us';


    }

    /**
     * @param $projectId
     * @return $this
     */
    public function withProjectId($projectId ): DocumentAIService
    {
        $this->projectId = $projectId;
        return $this;
    }

    /**
     * @param $processor
     * @return $this
     */
    public function withProcessor($processor ): DocumentAIService
    {
        $this->processor = $processor;
        return $this;
    }

    /**
     * @param $location
     * @return $this
     */
    public function withLocation($location ): DocumentAIService
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @param string $file_path
     * @param string $processor
     * @return DocumentAIParser
     * @throws ApiException
     * @throws DocumentAIException
     */
    public function processDocumentAsParser(string $file_path , string $processor  ): DocumentAIParser{

        $document = $this->processDocument( $file_path ,$processor);

        return DocumentAIParser::parse($document);

    }

    /**
     * @param string $file_path
     * @param string $processor
     * @return Document|null
     * @throws ApiException
     * @throws DocumentAIException
     */
    public function processDocument(string $file_path , string $processor ): ?Document
    {

        if( empty($file_path))
            throw new DocumentAIException("File path is empty");

        $handle = fopen($file_path, 'rb');
        $contents = fread($handle, filesize($file_path));
        fclose($handle);

        $rawDocument = new RawDocument([
            'content' => $contents,
            'mime_type' =>  'application/pdf',
        ]);

        $name = $this->client->processorName($this->projectId, $this->location, $processor);

        $response =  $this->client->processDocument(  ProcessRequest::build($name)->setRawDocument($rawDocument) );

        return $response->getDocument();

    }
}