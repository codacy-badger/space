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

namespace Galactium\Space\Errors;


use Galactium\Space\Http\Exception\HttpExceptionInterface;
use Galactium\Space\Http\Json;
use Phalcon\Di\Injectable;
use Phalcon\Exception;
use Phalcon\Http\Response;
use Phalcon\Logger\AdapterInterface;
use Phalcon\Mvc\Model\MessageInterface;
use Phalcon\Mvc\Model\ValidationFailed;

class Manager extends Injectable
{
    /**
     * @param \Throwable $e
     * @return Response
     * @throws \Throwable
     */
    public function handle(\Throwable $e)
    {
        try {
            $this->report($e);
        } catch (Exception $exception) {
            throw $e;
        }

        $response = new Response();

        $response->setStatusCode(503);

        if ($this->isHttpException($e)) {
            $response->setStatusCode($e->getStatusCode())
                ->setHeaders($e->getHeaders());
        }

        if ($this->request->isAjax()) {
            $response->setJsonContent($this->prepareJsonResponse($e));
        } else {
            $response->setContent($this->prepareHtmlResponse($e));
        }

        return $response;
    }

    /**
     * @param \Throwable $e
     * @return $this
     */
    protected function report(\Throwable $e)
    {
        /**@var AdapterInterface $logger */

        $logger = $this->di->get('logger');

        $logger->error('{message}. File: {file} ({line})', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
        ]);

        return $this;
    }

    /**
     * @param \Throwable $e
     * @return bool
     */
    protected function isHttpException(\Throwable $e): bool
    {
        return $e instanceof HttpExceptionInterface;
    }

    /**
     * @param \Throwable $e
     * @return Json
     */
    protected function prepareJsonResponse(\Throwable $e): Json
    {
        $jsonResponse = new Json();
        if ($e instanceof ValidationFailed) {
            $convertedException = $this->convertValidationException($e);
        } else {
            $convertedException = $this->convertException($e);
        }

        $jsonResponse->setSuccess(false)
            ->setData($convertedException);

        return $jsonResponse;
    }

    /**
     * @param ValidationFailed $e
     * @return array
     */
    protected function convertValidationException(ValidationFailed $e)
    {
        return [
            'message' => 'Validation failed.',
            'errors' => array_map(function (MessageInterface $message) {
                return $message->getMessage();
            }, $e->getMessages())
        ];
    }

    /**
     * @param \Throwable $e
     * @return array
     */
    protected function convertException(\Throwable $e)
    {
        return [
            'message' => $e->getMessage(),
        ];
    }

    /**
     * @param \Throwable $e
     * @return string
     */
    protected function prepareHtmlResponse(\Throwable $e): string
    {
        if ($this->isHttpException($e)) {
            $this->view->start()->render('errors', 'error-' . $e->getStatusCode(), ['exception' => $e])->finish();
        } else {
            $this->view->start()->render('errors', 'error-503', ['exception' => $e])->finish();
        }
        return $this->view->getContent();
    }

}