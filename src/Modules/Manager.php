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
 * Galactium @ 2017
 * @author Grigoriy Ivanov
 */

namespace Galactium\Space\Modules;

use Phalcon\Di\InjectionAwareInterface;
use Phalcon\DiInterface;


class Manager implements InjectionAwareInterface
{
    /**
     * @var DiInterface
     */
    protected $di;

    /**
     * @var array
     */
    private $modules;

    /**
     * @param array $modules
     * @return $this
     */
    public function register(array $modules)
    {
        $this->modules = $modules;

        foreach ($this->modules as $module) {
            $this->di->register(new $module['provider']);
        }

        return $this;
    }

    /**
     * @return DiInterface
     */
    public function getDi()
    {
        return $this->di;
    }

    /**
     * @param DiInterface $di
     */
    public function setDi(DiInterface $di)
    {
        $this->di = $di;
    }

    /**
     * @return array
     */
    public function getModules()
    {
        return $this->modules;
    }


}