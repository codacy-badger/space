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

namespace Galactium\Space\Translation;

use Galactium\Space\Translation\Adapter\NestedArray;
use Galactium\Space\Translation\Loader\LoaderInterface;
use Phalcon\Di\Injectable;
use Phalcon\Translate\AdapterInterface;
use function Galactium\Helpers\arrayHas;

class Manager extends Injectable
{
    /**
     * @var \Phalcon\Translate\AdapterInterface
     */
    protected $adapter;

    /**
     * @var LoaderInterface
     */
    protected $loader;

    /**
     * @var string
     */
    protected $locale;

    /**
     * @var string
     */
    protected $fallback;

    /**
     * @var array
     */
    protected $resources = [];

    /**
     * Manager constructor.
     * @param LoaderInterface $loader
     * @param string $locale
     * @param string $fallback
     */
    public function __construct(LoaderInterface $loader, string $locale, string $fallback)
    {
        $this->loader = $loader;
        $this->locale = $locale;
        $this->fallback = $fallback;
    }

    /**
     * @param string|null $key
     * @return AdapterInterface
     * @throws Exception
     */
    public function getTranslation(string $key = null): AdapterInterface
    {
        $key = $key ?? $this->dispatcher->getModuleName();

        return new NestedArray(['content' => $this->loadMessages($key)]);
    }

    /**
     * @param string $key
     * @return array
     * @throws Exception
     */
    public function loadMessages(string $key): array
    {
        [$module, $group] = $this->parseKey($key);

        if ($group) {
            if (arrayHas($this->resources, [$module, $group]) === false) {
                $this->resources[$module][$group] = $this->loader->load($this->locale, $module, $group);
                return $this->resources[$module][$group];
            }
        } else {
            if (arrayHas($this->resources, [$module]) === false) {
                $this->resources[$module] = $this->loader->load($this->locale, $module, $group);
                return $this->resources[$module];
            }
        }
        return [];
    }

    /**
     * @param string $key
     * @return array
     * @throws Exception
     */
    protected function parseKey(string $key): array
    {
        $result = explode('::', $key);

        if (count($result) == 2) {
            return $result;
        } else {
            return [$key, null];
        }

        throw new Exception("Unexpected key: $key");
    }

    /**
     * @param array $keys
     * @return AdapterInterface
     * @throws Exception
     */
    public function getTranslations(array $keys): AdapterInterface
    {
        foreach ($keys as $key) {
            $this->loadMessages($key);
        }
        return new NestedArray(['content' => $this->resources]);
    }

    /**
     * @return AdapterInterface
     * @throws Exception
     */
    public function getLoadedTranslations(): AdapterInterface
    {
        return new NestedArray(['content' => $this->resources]);
    }

    /**
     * @param array $keys
     * @return Manager
     * @throws Exception
     */
    public function loadTranslations(array $keys): Manager
    {
        foreach ($keys as $key) {
            $this->loadTranslation($key);
        }
        return $this;
    }

    /**
     * @param string $key
     * @return Manager
     * @throws Exception
     */
    public function loadTranslation(string $key): Manager
    {
        $this->loadMessages($key);

        return $this;
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * @return string
     */
    public function getFallback(): string
    {
        return $this->fallback;
    }
}