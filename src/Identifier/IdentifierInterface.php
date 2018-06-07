<?php
/**
 * Galactium @ 2018
 * @author Grigoriy Ivanov
 */

namespace Galactium\Space\Identifier;

interface IdentifierInterface
{
    /**
     * @return string
     */
    public function getIdentifiable(): string;

    /**
     * @return string
     */
    public function key(): string;
}