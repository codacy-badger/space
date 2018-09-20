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

namespace Galactium\Space\Di;


use Phalcon\Di\InjectionAwareInterface;
use Phalcon\Di\ServiceProviderInterface;

class Registrator implements InjectionAwareInterface
{
    /**
     * @var \Phalcon\DiInterface
     */
    protected $di;

    /**
     * @param ServiceProviderInterface[] $providers
     */
    public function registerProviders(array $providers)
    {
        foreach ($providers as $provider) {
            $this->di->register(new $provider);
        }
    }

    /**
     * @return \Phalcon\DiInterface
     */
    public function getDi(): \Phalcon\DiInterface
    {
        return $this->di;
    }

    /**
     * @param \Phalcon\DiInterface $di
     */
    public function setDi(\Phalcon\DiInterface $di)
    {
        $this->di = $di;
    }


}