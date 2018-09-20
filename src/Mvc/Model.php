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
 * Galactium @ 2016
 * @author Grigoriy Ivanov
 */

namespace Galactium\Space\Mvc;

use function Galactium\Space\Helpers\camelize;

abstract class Model extends \Phalcon\Mvc\Model
{
    const DELETED = 1;

    const NOT_DELETED = 0;

    const ACTIVE = 1;

    const NOT_ACTIVE = 0;

    /**
     * @var array
     */
    protected $append = [];

    /**
     * @param array|null $columns
     * @return array
     */
    public function toArray($columns = null)
    {
        $data = array_merge(parent::toArray($columns), $this->getAppends());

        return $data;
    }

    /**
     * @return array
     */
    protected function getAppends(): array
    {
        $appends = [];

        foreach ($this->append as $append) {
            $appends[$append] = $this->{'get' . camelize($append)}();
        }
        return $appends;
    }

    /**
     * @param null $parameters
     * @return \Phalcon\Mvc\Model\ResultsetInterface|$this[]|void
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * @param null $parameters
     * @return \Phalcon\Mvc\Model|$this|void
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}