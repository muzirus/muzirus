<?php declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
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
     * @ORM\OrderBy({"positionInCzechWordDetail": "ASC"})
     * @var Collection<TranslationInterface>
     */
    protected Collection $translations;
}
