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


namespace Galactium\Space\Seo\Metas;


class Canonical extends Meta
{
    protected $tag = 'link';

    protected $name = 'canonical';

    protected $property = 'rel';

    /**
     * Canonical constructor.
     * @param string $href
     */
    public function __construct(string $href)
    {
        parent::__construct($href, $this->name, $this->property, $this->tag);

    }


}