<?php
/**
 * Copyright (c) 2018. Grigoriy Ivanov
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 */

/**
 * Galactium @ 2018
 * @author Grigoriy Ivanov
 */

namespace Galactium\Space\Identifier;

use Phalcon\Di\Injectable;

class Manager extends Injectable
{
    /**
     * @var Parser
     */
    protected $parser;

    /**
     * Manager constructor.
     */
    public function __construct()
    {
        $this->parser = new Parser();
    }

    /**
     * Gets a GUID (Galactium Unique Identifier) from the model.
     * Format: module::namespace.class
     *
     * @param IdentifiableInterface $record
     * @return string
     */
    public function generate(IdentifiableInterface $record): string
    {
        return $record->identify();
    }

    /**
     * Parse a key and returns it as object
     *
     * @param string $key
     * @return IdentifierInterface
     */
    public function parse(string $key): IdentifierInterface
    {
        $args = $this->parser->parse($key);

        return new Identifier(...$args);
    }

}