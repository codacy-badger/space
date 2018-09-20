<?php
/**
 * Galactium @ 2018
 * @author Grigoriy Ivanov
 */

namespace Galactium\Space\Seo;

class OpenGraph
{
    /**
     * OpenGraph prefix
     */
    protected $og_prefix = 'og:';

    /**
     * @var string
     */
    protected $type = '';

    /**
     * @var string
     */
    protected $title = '';

    /**
     * @var string
     */
    protected $url = '';

    /**
     * @var string|null
     */
    protected $description = '';
    /**
     * @var string|null
     */
    protected $image;

    /**
     * @var array
     */
    protected $properties = [];

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return OpenGraph
     */
    public function setType(string $type): OpenGraph
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return OpenGraph
     */
    public function setTitle(string $title): OpenGraph
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return OpenGraph
     */
    public function setUrl(string $url): OpenGraph
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param null|string $description
     * @return OpenGraph
     */
    public function setDescription(?string $description): OpenGraph
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param null|string $image
     * @return OpenGraph
     */
    public function setImage(?string $image): OpenGraph
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return array
     */
    public function getProperties(): array
    {
        return $this->properties;
    }

    /**
     * @param array $properties
     * @return OpenGraph
     */
    public function setProperties(array $properties): OpenGraph
    {
        $this->properties = $properties;
        return $this;
    }

    public function if($condition, $callback)
    {
        if ($condition) {
            $callback($this);
        }

        return $this;
    }

}