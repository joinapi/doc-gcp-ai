<?php

namespace Joinapi\DocumentAI\Handlers;

abstract class BaseProcessorHandler implements ProcessorHandler
{
    protected array $config;

    protected static $DOCUMENT_TYPE;

    public function __construct()
    {
        $this->config = config('documentai.types.CNH');

    }

    public function getDocumentType()
    {
        return static::$DOCUMENT_TYPE;
    }

    public function getDocument()
    {
        return $this->config['document'];
    }
    public function getLabel()
    {
        return $this->config['label'];
    }

    public function handle($data): void
    {
        echo count($data);

    }

    public function getField(string $field)
    {
        return data_get($this->config, 'fields.' . $field);
    }
    public function getEntityField(string $field)
    {
        return data_get($this->config, 'processor.fields.' . $field);
    }


}