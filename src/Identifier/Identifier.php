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


use function Galactium\Space\Helpers\camelize;

class Identifier implements IdentifierInterface
{
    /**
     * @var string
     */
    protected $module;
    /**
     * @var string
     */
    protected $namespace;
    /**
     * @var string
     */
    protected $class;
    /**
     * @var array
     */
    protected $params = [];

    /**
     * Identifier constructor.
     * @param string $module
     * @param string $namespace
     * @param string $class
     * @param array $params
     */
    public function __construct(string $module, string $namespace, string $class, array $params = [])
    {
        $this->module = $module;
        $this->namespace = $namespace;
        $this->class = $class;
        $this->params = $params;
    }

    /**
     * @return string
     */
    public function getModule(): string
    {
        return $this->module;
    }

    /**
     * @return string
     */
    public function getNamespace(): string
    {
        return $this->namespace;
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * Gets a model class based on a Module and a Table
     *
     * @return string
     */
    public function getIdentifiable(): string
    {
        return 'Galactium\Modules\\' . camelize($this->module) . '\\' . camelize($this->namespace) . '\\' . camelize($this->class);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->key();
    }

    /**
     * Returns a key
     *
     * @return string
     */
    public function key(): string
    {
        return sprintf('%s::%s.%s.%s', $this->module, $this->namespace, $this->class, implode('.', $this->params));
    }
}