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

abstract class HttpException extends \RuntimeException implements HttpExceptionInterface
{
    /**
     * @var string
     */
    protected $message = 'HTTP Exception';

    /**
     * @var int
     */
    protected $statusCode;

    /**
     * @var \Phalcon\Http\Response\HeadersInterface
     */
    protected $headers;

    public function __construct(string $message = null, \Throwable $previous = null, HeadersInterface $headers = null, int $code = 0)
    {
        $this->headers = $headers;

        $message = $message ?? $this->message;

        parent::__construct($message, $code, $previous);
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     */
    public function setStatusCode(int $statusCode): void
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @return \Phalcon\Http\Response\HeadersInterface
     */
    public function getHeaders(): HeadersInterface
    {
        return $this->headers;
    }

    /**
     * @param \Phalcon\Http\Response\HeadersInterface $headers
     */
    public function setHeaders(HeadersInterface $headers): void
    {
        $this->headers = $headers;
    }

}