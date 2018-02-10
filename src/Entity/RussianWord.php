<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RussianWordRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class RussianWord extends AbstractWord implements RussianWordInterface
{
    /**
     * Inverse side.
     * @ORM\OneToMany(targetEntity="Translation", mappedBy="russianWord", cascade={"remove"})
     * @var ArrayCollection
     */
    protected $translations;
}
