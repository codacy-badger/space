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

namespace Galactium\Space\Settings;


use Phalcon\Config;
use Phalcon\Di\InjectionAwareInterface;
use Phalcon\Mvc\Model\ResultsetInterface;
use function Galactium\Space\Helpers\container;

class Manager implements InjectionAwareInterface, ManagerInterface
{
    /**
     * @var \Phalcon\DiInterface
     */
    protected $_dependencyInjector;

    /**
     * @param \Phalcon\DiInterface $dependencyInjector
     */
    public function setDI(\Phalcon\DiInterface $dependencyInjector)
    {
        $this->_dependencyInjector = $dependencyInjector;
    }

    /**
     * @return \Phalcon\DiInterface
     */
    public function getDI()
    {
        return $this->_dependencyInjector;
    }

    /**
     * @param string $model
     * @param string $context
     * @param string $key
     * @param null $default
     * @return bool|string
     */
    public function getByContextAndKey(string $model, string $context, string $key, $default = null)
    {
        $setting = $this->find($model, $context, $key)->getFirst();
        if (!$setting) {
            return $default ?? false;
        }
        return $setting->getValue() ?? $default;
    }

    /**
     * @param string $model
     * @param string $context
     * @param string $key
     * @return ResultsetInterface
     */
    protected function find(string $model, string $context, string $key = null): ResultsetInterface
    {
        /**
         * @var \Phalcon\Mvc\Model\ManagerInterface $modelsManager
         */
        $modelsManager = container('modelsManager');
        $query = $modelsManager
            ->createBuilder()
            ->from(['Settings' => $model])
            ->where('context = :context:', ['context' => $context]);

        if ($key) {
            $query = $query->andWhere('key = :key:', ['key' => $key]);
        }

        return $query->getQuery()->execute();
    }

    /**
     * @param string $model
     * @param string $context
     * @return Config
     */
    public function getAllByContext(string $model, string $context): Config
    {
        $settings = $this->find($model, $context);

        $data = [];
        foreach ($settings as $setting) {
            $data[$setting->getKey()] = $setting->getValue();
        }
        return new Config($data);
    }

    /**
     * @param $model
     * @return Config
     */
    public function getAll($model): Config
    {
        $modelsManager = $this->_dependencyInjector->getShared('modelsManager');
        $settings = $modelsManager
            ->createBuilder()
            ->from(['Settings' => $model])
            ->getQuery()->execute();

        $data = [];
        foreach ($settings as $setting) {
            $data[$setting->getContext()][$setting->getKey()] = $setting->getValue();
        }

        return new Config($data);

    }

    /**
     * @param \Phalcon\Mvc\ModelInterface $model
     * @param $context
     * @param $key
     * @param $value
     * @return bool
     */
    public function save($model, $context, $key, $value)
    {
        $model::query()
            ->where('context = :context:', ['context' => $context])
            ->andWhere('key = :key:', ['key' => $key])
            ->execute()
            ->getFirst();

        return $model->setValue($value)->save();
    }


}