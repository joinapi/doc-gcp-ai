<?php

namespace Joinapi\DocumentAI;

use Google\Cloud\DocumentAI\V1\Document;

class DocumentAIParser
{
    public const DOCUMENT_FIELD_ENTITY = 'entity';

    public const DOCUMENT_FIELD_DOCID = 'DOCID';

    public const DOCUMENT_FIELD_RAW = 'raw';
    protected array $documentData;

    /**
     * @param array $documentData
     */
    public function __construct(array $documentData)
    {
        $this->documentData = $documentData;

    }

    /**
     * @return array
     */
    public function getKeys(): array
    {
        return array_keys($this->documentData);

    }

    /**
     * @return array
     */
    public function getDocumentData(): array
    {
        return $this->documentData;
    }

    /**
     * @return array
     */
    public function getEntity(): array
    {
        return $this->documentData;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function getValue(string $key)
    {
        if( array_key_exists($key , $this->documentData) ){
            return $this->documentData[$key];
        }
        return null;

    }

    /**
     * @return string|null
     */
    public function getDocId(): ?string
    {
        return $this->getValue(self::DOCUMENT_FIELD_DOCID);

    }

    /**
     * @param array|string $ids
     * @return bool
     */
    public function hasDocId(array|string $ids ): bool
    {
        return !empty($ids) && in_array($this->getValue(self::DOCUMENT_FIELD_DOCID), $ids);
    }


    /**
     * @param Document|null $document
     * @return array
     */
    public static function parseFields(?Document $document ): array
    {
        $result = [];

        if( empty($document) ) {
            return $result;
        }

        $entities = $document->getEntities();

        if($entities){

            $tns = [];

            foreach ($entities as $entity){

                if( array_key_exists($entity->getType() , $tns)){
                    $tns[ $entity->getType() ] = $tns[$entity->getType()] . PHP_EOL . $entity->getMentionText();
                }else{
                    $tns[ $entity->getType() ] =  $entity->getMentionText() ;
                }

            }

            $result[self::DOCUMENT_FIELD_ENTITY] = $tns;
        }

        return $result;

    }

    /**
     * @throws DocumentAIException
     */
    public static function parse(?Document $document ):  DocumentAIParser
    {
        if (empty($document)){
            throw new DocumentAIException('Invalid document');
        }

        return new DocumentAIParser(self::parseFieldsWithRaw($document));

    }

    /**
     * @param Document|null $document
     * @return array
     */
    public static function parseFieldsWithRaw(?Document $document ):  array
    {
        if (empty($document)){
            return [];
        }
        $result = self::parseFields($document);
        $result[self::DOCUMENT_FIELD_RAW] = $document->getText();
        return $result;

    }

}