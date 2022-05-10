<?php

namespace ByJG\Swagger;

use ByJG\Swagger\Exception\InvalidDefinitionException;
use ByJG\Swagger\Exception\RequiredArgumentNotFound;

class SwaggerRequestBody extends SwaggerBody
{
    /**
     * @param $body
     * @return bool
     * @throws \ByJG\Swagger\Exception\InvalidDefinitionException
     * @throws \ByJG\Swagger\Exception\NotMatchedException
     * @throws \ByJG\Swagger\Exception\RequiredArgumentNotFound
     * @throws \Exception
     */
    public function match($body)
    {
        foreach ($this->structure as $parameter) {
            if ($parameter['in'] === 'body') {
                if ($parameter['required'] === true && empty($body)) {
                    throw new RequiredArgumentNotFound('The body is required but it is empty');
                }
                return $this->matchSchema($this->name, $parameter['schema'], $body);
            }
        }

        if (!empty($body)) {
            throw new InvalidDefinitionException('Body is passed but there is no request body definition');
        }

        return false;
    }
}
