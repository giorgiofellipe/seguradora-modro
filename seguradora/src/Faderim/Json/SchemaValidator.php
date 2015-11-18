<?php

namespace Faderim\Json;

/**
 * Description of SchemaValidator
 *
 * @author ricardo
 */
class SchemaValidator
{

    public function getValidator($data, $namespace)
    {
        $file = \Faderim\File\FileUtils::findDirNamespace($namespace);
        $fileName = $file . '.json';
        $uri = 'file://' . $fileName;
        $retriever = new \JsonSchema\Uri\UriRetriever;
        $schema = $retriever->retrieve($uri);
        $validator = new \JsonSchema\Validator();
        $validator->check($data, $schema);
        return $validator;
    }

}
