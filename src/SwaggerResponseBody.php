<?php

namespace ByJG\Swagger;

use ByJG\Swagger\Exception\NotMatchedException;

class SwaggerResponseBody extends SwaggerBody
{
    /**
     * @param $body
     * @return bool
     * @throws \ByJG\Swagger\Exception\NotMatchedException
     * @throws \Exception
     */
    public function match($body)
    {
        if (!isset($this->structure['schema']) && !isset($this->structure['$ref'])) {
            if (!empty($body)) {
                throw new NotMatchedException("Expected empty body for " . $this->name);
            }
            return true;
        }

        $schema = $this->structure['schema'] ?? $this->structure;
        
        return $this->matchSchema($this->name, $schema, $body);
    }
}
