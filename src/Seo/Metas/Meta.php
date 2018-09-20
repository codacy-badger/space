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


namespace Galactium\Space\Seo\Metas;


use Phalcon\Tag;

class Meta implements MetaInterface
{
    /**
     *
     * @var string
     */
    protected $prefix = '';
    /**
     *
     * @var string
     */
    protected $property = 'name';
    /**
     *
     * @var string
     */
    protected $name = '';
    /**
     *
     * @var string
     */
    protected $tag = 'meta';
    /**
     *
     * @var string|null
     */
    protected $content;

    /**
     * Meta constructor.
     * @param string $prefix
     * @param string $property
     * @param string $name
     * @param string $content
     */
    public function __construct(?string $content, string $name, string $property = 'name', string $tag = 'meta', string $prefix = '')
    {
        $this->prefix = $prefix;
        $this->property = $property;
        $this->setName($name)
            ->setContent($content);

    }

    /**
     * @return string
     */
    public function key(): string
    {
        return $this->getName();
    }

    /**
     * @return string
     */
    public function getName($prefix = true): string
    {
        if ($prefix) {
            return strip_tags($this->prefix . $this->name);
        }
        return strip_tags($this->name);
    }

    /**
     * @param string $name
     * @return Meta
     */
    public function setName(string $name): Meta
    {
        $this->name = trim(strip_tags($name));
        return $this;
    }

    /**
     * @return string
     */
    public function getPrefix(): string
    {
        return $this->prefix;
    }

    /**
     * @param string $prefix
     * @return Meta
     */
    public function setPrefix(string $prefix): Meta
    {
        $this->prefix = $prefix;
        return $this;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        if ($this->isLink()) {
            return Tag::tagHtml($this->getTag(), [$this->getName() => $this->getProperty(), 'href' => $this->getContent()]);
        }
        if (is_null($this->content)) {
            return '';
        }
        return Tag::tagHtml($this->getTag(), [$this->getName() => $this->getProperty(), 'content' => $this->getContent()]);

    }

    public function isLink(): bool
    {
        return in_array($this->getName(), [
            'alternate', 'archives', 'author', 'canonical', 'first', 'help', 'icon', 'index', 'last',
            'license', 'next', 'nofollow', 'noreferrer', 'pingback', 'prefetch', 'prev', 'publisher'
        ]);
    }

    /**
     * @return string
     */
    public function getTag(): string
    {
        return $this->tag;
    }

    /**
     * @param string $tag
     * @return Meta
     */
    public function setTag(string $tag): Meta
    {
        $this->tag = $tag;
        return $this;
    }

    /**
     * @return string
     */
    public function getProperty(): string
    {
        return $this->property;
    }

    /**
     * @param string $property
     * @return Meta
     */
    public function setProperty(string $property): Meta
    {
        $this->property = $property;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param null|string $content
     * @return Meta
     */
    public function setContent(?string $content): Meta
    {
        $this->content = strip_tags($content);
        return $this;
    }

}