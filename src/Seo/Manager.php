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

namespace Galactium\Space\Seo;


use Galactium\Space\Seo\Metas\Collection;
use Phalcon\Di\Injectable;

class Manager extends Injectable
{

    /**
     * @var Collection
     */
    protected $metas;

    /**
     * @var OpenGraph
     */
    protected $openGraph;

    /**
     * @var SchemaOrg
     */
    protected $schemaOrg;

    /**
     * @var \Galactium\Space\Seo\Breadcrumbs\Collection
     */
    protected $breadcrumbs;

    /**
     * Manager constructor.
     */
    public function __construct()
    {
        $this->metas = new Collection();
        $this->openGraph = new OpenGraph();
        $this->schemaOrg = new SchemaOrg();
        $this->breadcrumbs = new Breadcrumbs\Collection();
    }

    /**
     * @return Collection
     */
    public function metas(): Collection
    {
        return $this->metas;
    }

    /**
     * @return OpenGraph
     */
    public function openGraph(): OpenGraph
    {
        return $this->openGraph;
    }

    /**
     * @return SchemaOrg
     */
    public function schemaOrg(): SchemaOrg
    {
        return $this->schemaOrg;
    }

    /**
     * @return Breadcrumbs\Collection
     */
    public function breadcrumbs(): Breadcrumbs\Collection
    {
        return $this->breadcrumbs;
    }

}