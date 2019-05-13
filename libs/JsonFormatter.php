<?php

use Monolog\Formatter\JsonFormatter as MonologJsonFormatter;

class JsonFormatter extends MonologJsonFormatter
{
    public function format(array $record)
    {
        $json_string = $this->toJson($this->normalize($record), true) . ($this->appendNewline ? "\n" : '');

        DataMap::formatter($json_string);

        return $json_string;
    }
}