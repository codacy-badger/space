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


namespace Galactium\Space\Support;


class BaseCollection implements \JsonSerializable, \ArrayAccess, \Countable, \Iterator
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * Json constructor.
     * @param array $data
     */
    public function __construct($data = [])
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->data;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     * @return BaseCollection
     */
    public function setData(array $data): BaseCollection
    {
        $this->data = $data;
        return $this;
    }

    public final function count()
    {
        return count($this->data);
    }

    public final function next()
    {
        next($this->data);
    }

    public final function key()
    {
        return key($this->data);
    }

    public final function rewind()
    {
        reset($this->data);
    }

    public function valid()
    {
        return key($this->data) !== null;
    }

    public function current()
    {
        return current($this->data);
    }

    public final function __get($key)
    {
        return $this->offsetGet($key);
    }

    public final function __set($key, $value)
    {
        $this->offsetSet($key, $value);
    }

    public final function offsetGet($offset)
    {
        return $this->data[$offset];
    }

    public final function offsetSet($offset, $value)
    {
        $this->data[$offset] = $value;
    }

    public final function __isset($key)
    {
        return $this->offsetExists($key);
    }

    public final function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    public final function __unset($key)
    {
        $this->offsetUnset($key);
    }

    public final function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }
}