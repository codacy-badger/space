<?php
/**
 * Galactium @ 2018
 * @author Grigoriy Ivanov
 */

namespace Galactium\Space\Mvc\Model\Settings;


interface SettingsInterface
{
    /**
     * @return string
     */
    public function getContext(): string;

    /**
     * @param string $context
     * @return SettingsInterface
     */
    public function setContext(string $context): SettingsInterface;

    /**
     * @return string
     */
    public function getKey(): string;

    /**
     * @param string $key
     * @return SettingsInterface
     */
    public function setKey(string $key): SettingsInterface;

    /**
     * @return string
     */
    public function getValue(): string;

    /**
     * @param string $value
     * @return SettingsInterface
     */
    public function setValue(string $value): SettingsInterface;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     * @return SettingsInterface
     */
    public function setName(string $name): SettingsInterface;

    /**
     * @return string
     */
    public function getDescription(): string;

    /**
     * @param string $description
     * @return SettingsInterface
     */
    public function setDescription(string $description): SettingsInterface;

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @param string $type
     * @return SettingsInterface
     */
    public function setType(string $type): SettingsInterface;
}