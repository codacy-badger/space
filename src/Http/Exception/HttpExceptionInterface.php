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

namespace Galactium\Space\Http\Exception;

use Phalcon\Http\Response\HeadersInterface;

interface HttpExceptionInterface
{
    /**
     * @return int
     */
    public function getStatusCode(): int;

    /**
     * @param int $statusCode
     */
    public function setStatusCode(int $statusCode): void;

    /**
     * @return \Phalcon\Http\Response\HeadersInterface
     */
    public function getHeaders(): HeadersInterface;

    /**
     * @param \Phalcon\Http\Response\HeadersInterface $headers
     */
    public function setHeaders(HeadersInterface $headers): void;
}