<?php declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CzechWordRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CzechWord extends AbstractWord implements CzechWordInterface
{
    /**
     * Inverse side.
     *
     * @ORM\OneToMany(targetEntity="Translation", mappedBy="czechWord", cascade={"remove"})
     * @var ArrayCollection
     */
    protected $translations;
}
