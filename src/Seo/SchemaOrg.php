<?php
/**
 * Galactium @ 2018
 * @author Grigoriy Ivanov
 */

namespace Galactium\Space\Seo;


use Phalcon\Di\Injectable;
use Spatie\SchemaOrg\Schema;
use Spatie\SchemaOrg\Type;
use function Galactium\Helpers\arrayHas;

class SchemaOrg extends Injectable
{
    /**
     * @var Type[]
     */
    protected $schemas = [];

    /**
     * @param string $name
     * @return Type
     */
    public function addTo(string $name)
    {
        if (arrayHas($this->schemas, $name)) {
            return $this->schemas[$name];
        }

        return $this->create($name);
    }

    /**
     * @param string $name
     * @param Type|null $type
     * @return mixed|Type
     */
    public function create(string $name, Type $type = null)
    {
        return $this->schemas[$name] = $type ?? call_user_func(Schema::class . "::$name");
    }

    /**
     * @param string $name
     */
    public function remove(string $name)
    {
        unset($this->schemas[$name]);
    }

    /**
     * @return $this
     */
    public function reset()
    {
        $this->schemas = [];
        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toScript();
    }

    /**
     * @return string
     */
    public function toScript(): string
    {
        $html = '';
        foreach ($this->schemas as $schema) {
            $html .= $schema->toScript();
        }
        return $html;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $result = [];
        foreach ($this->schemas as $schema) {
            $result[] = $schema->toArray();
        }
        return $result;
    }

}