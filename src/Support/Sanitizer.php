<?php
/**
 * Galactium @ 2018
 * @author Grigoriy Ivanov
 */


namespace Galactium\Space\Support;


use function Galactium\Helpers\arrayGet;
use function Galactium\Helpers\arraySet;

class Sanitizer
{
    /**
     * @var \Phalcon\FilterInterface
     */
    protected $filter;

    /**
     * Sanitizer constructor.
     * @param \Phalcon\FilterInterface $filter
     */
    public function __construct(\Phalcon\FilterInterface $filter)
    {
        $this->filter = $filter;
    }

    /**
     * @param $data
     * @param $rules
     * @return mixed
     */
    public function sanitize($data, $rules)
    {
        $sanitized = $data;

        foreach ($this->parseRules($rules) as $field => $filters) {
            $value = arrayGet($data, $field);
            var_dump($this->filter->sanitize($value, $filters));
            arraySet($sanitized, $field, $this->filter->sanitize($value, $filters));
        }
        return $sanitized;
    }

    /**
     * @param array $rules
     * @return array
     * ['customer' => 'striptags:escape:trim'] to ['customer' => ['triptags','escape','trim']
     */
    protected function parseRules(array $rules)
    {
        $parsed = [];
        foreach ($rules as $filed => $rule) {
            $parsed[$filed] = explode(':', $rule);
        }
        return $parsed;
    }


}