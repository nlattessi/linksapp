<?php

declare(strict_types=1);

namespace App\Entities;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="links")
 */
class Link
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private string $url;

    /**
     * @ORM\Column(type="string")
     */
    private string $title;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     */
    protected DateTime $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="links")
     */
    protected Category $category;

    public function assignCategory(Category $category): Link
    {
        $category->addLink($this);
        $this->category = $category;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): Link
    {
        $this->url = $url;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title ?? $this->url;
    }

    public function setTitle(string $title): Link
    {
        $this->title = $title;

        return $this;
    }

    public function setCreatedAt(DateTime $createdAt): Link
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }
}
