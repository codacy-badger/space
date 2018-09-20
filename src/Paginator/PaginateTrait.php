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

namespace Galactium\Space\Paginator;


use Phalcon\Mvc\Model\Query\BuilderInterface;
use Phalcon\Paginator\Adapter\QueryBuilder;

trait PaginateTrait
{
    /**
     * @param BuilderInterface $builder
     * @param int $limit
     * @param int $page
     * @return \stdClass
     */
    protected function paginate(BuilderInterface $builder, int $limit = 25, int $page = 1)
    {
        $paginator = new QueryBuilder([
            "builder" => $builder,
            "limit" => $limit,
            "page" => $page,
        ]);

        return $paginator->getPaginate();
    }


}