<?php
/**
 * Galactium @ 2018
 * @author Grigoriy Ivanov
 */

namespace Galactium\Space\Identifier;


class Parser
{
    /**
     * @var array
     */
    protected $parsed = [];

    /**
     * @param  string $key
     * @return array
     */
    public function parse(string $key): array
    {
        if (isset($this->parsed[$key])) {
            return $this->parsed[$key];
        }

        $parsed = $this->parseSegments($key);

        return $this->parsed[$key] = $parsed;
    }

    /**
     * @param $key
     * @return array
     */
    protected function parseSegments(string $key): array
    {
        [$module, $segments] = explode('::', $key);

        $items = explode('.', $segments, 3);
        $params = [];
        if (count($items) > 2) {
            $params = explode('.', array_splice($items, -1)[0]);
        }
        return array_merge([$module], $items, [$params]);
    }


}