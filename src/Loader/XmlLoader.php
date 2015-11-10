<?php

namespace Blast\Config\Loader;

use Puli\Repository\Api\Resource\BodyResource;
use Puli\Repository\Api\Resource\FilesystemResource;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class XmlLoader extends AbstractLoader implements LoaderInterface
{
    /**
     * Clean up fragments due to converting SimpleXML to array
     * @param array $data
     * @return array
     */
    protected function cleanUp(array $data = []){
        $clean = [];
        foreach($data as $key => $value){
            $key = trim(strtolower($key));
            //cut all comment fragments
            if($key === 'comment') {
                continue;
            }

            //add attributes to root level of current data and remove @attributes array
            if($key === '@attributes'){
                $clean = array_merge_recursive($clean, $value);
                continue;
            }

            //if value is an array we run cleanUp recursive otherwise we add value as item
            $item = is_array($value) ? $this->cleanUp($value) : $value;

            //if child keys contain none numeric keys and current key is not numeric then add item with numeric key in
            //order to avoid inconsistent data structure
            if(!$this->assertNumericKeys($item) && !is_numeric($key)){
                $clean[$key][] = $item;
            }else{
                $clean[$key] = $item;
            }
        }

        return $clean;
    }
    
    /**
     * Assert that all keys are numeric
     * @param $item
     * @return mixed
     */
    protected function assertNumericKeys($item)
    {
        $keys = array_keys($item);

        foreach ($keys as $key) {
            if(!is_numeric($key)){
                return false;
            }
        }

        return true;
    }

    /**
     * Return valid extension for this transformer
     * @return string
     */
    public function getExtension()
    {
        return 'xml';
    }
    
    /**
     * Load config as Array from resource
     * @param FilesystemResource $resource
     * @return array
     */
    public function load(FilesystemResource $resource)
    {
        if(!$this->validateExtension($resource)){
            return false;
        }
        return $this->transform($resource);
    }

    /**
     * Transform XML into consistent array structure
     * @param FilesystemResource $resource
     * @return array
     */
    public function transform(FilesystemResource $resource){
        $xml = $resource->getBody();
        $xmlObject = simplexml_load_string($xml);
        $config = json_decode(json_encode($xmlObject), true);
        $config = $this->cleanUp($config);
        return $this->validateConfig($config) ? $config : [];
    }
}
