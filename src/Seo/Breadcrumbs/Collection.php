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


use Galactium\Space\Support\BaseCollection;

class Collection extends BaseCollection
{
    /**
     * @var Breadcrumb[]
     */
    protected $data = [];

    /**
     * @param string $name
     * @param string $href
     * @param array $attributes
     */
    public function push(string $name, string $href, $attributes = [])
    {
        $this->data[] = new Breadcrumb($name, $href, $attributes);
    }

    /**
     * @return array
     */
    public function get(): array
    {
        $data = $this->build();
        return $data;
    }

    /**
     * @return Breadcrumb[]
     */
    protected function build()
    {
        $breadcrumbs = $this->breadcrumbs;
        if ($breadcrumbs) {
            $breadcrumbs[0]->setFirst(true);
            $breadcrumbs[count($breadcrumbs) - 1]->setLast(true);
        }
        return $breadcrumbs;
    }

}