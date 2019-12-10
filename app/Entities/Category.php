<?php

declare(strict_types=1);

namespace App\Entities;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repositories\CategoryRepository")
 * @ORM\Table(name="categories")
 */
class Category
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
    protected string $name;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     */
    protected DateTime $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="Link", mappedBy="category", cascade={"remove"}))
     * @ORM\OrderBy({"title"="ASC"})
     * @var Link[] An ArrayCollection of Link objects.
     */
    protected $links;

    public function __construct()
    {
        $this->links = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Category
    {
        $this->name = $name;

        return $this;
    }

    public function setCreatedAt(DateTime $createdAt): Category
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function addLink(Link $link): Category
    {
        if ($this->links->contains($link)) {
            return $this;
        }

        $this->links[] = $link;

        return $this;
    }

    public function getLinks(): Collection
    {
        return $this->links;
    }
}