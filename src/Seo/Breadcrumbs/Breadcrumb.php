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

namespace Galactium\Space\Seo\Breadcrumbs;


class Breadcrumb implements \JsonSerializable
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $href;
    /**
     * @var bool
     */
    private $first = false;
    /**
     * @var bool
     */
    private $last = false;
    /**
     * @var array
     */
    private $attributes = [];

    /**
     * Breadcrumb constructor.
     * @param $name
     * @param $href
     * @param array $attributes
     * @param bool $first
     * @param bool $last
     */
    public function __construct($name, $href, array $attributes = [], $first = false, $last = false)
    {
        $this->name = $name;
        $this->href = $href;
        $this->last = $last;
        $this->attributes = $attributes;
    }

    /**
     * @return mixed|void
     */
    function jsonSerialize()
    {
        $this->toArray();
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'href' => $this->getHref(),
            'is_first' => $this->isFirst(),
            'is_last' => $this->isLast(),
            'attributes' => $this->getAttributes()
        ];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


    /**
     * @return string
     */
    public function getHref(): string
    {
        return $this->href;
    }


    /**
     * @return bool
     */
    public function isFirst(): bool
    {
        return $this->first;
    }

    /**
     * @param bool $first
     * @return Breadcrumb
     */
    public function setFirst(bool $first): Breadcrumb
    {
        $this->first = $first;
        return $this;
    }

    /**
     * @return bool
     */
    public function isLast(): bool
    {
        return $this->last;
    }

    /**
     * @param bool $last
     * @return Breadcrumb
     */
    public function setLast(bool $last): Breadcrumb
    {
        $this->last = $last;
        return $this;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     * @return Breadcrumb
     */
    public function setAttributes(array $attributes): Breadcrumb
    {
        $this->attributes = $attributes;
        return $this;
    }


}