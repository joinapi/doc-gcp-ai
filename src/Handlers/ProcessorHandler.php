<?php

namespace Joinapi\DocumentAI\Handlers;

use Joinapi\DocumentAI\DocumentAIException;

interface ProcessorHandler
{
    /**
     * @param $data
     * @throws DocumentAIException
     */
    public function handle($data): void;

    public function getDocumentType();

    public function getDocument();

    public function getLabel();

    public function getField(string $field);

    public function getEntityField(string $field);

}