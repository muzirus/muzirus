<?php declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RussianWordRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class RussianWord extends AbstractWord implements RussianWordInterface
{
    /**
     * Inverse side.
     *
     * @ORM\OneToMany(targetEntity="Translation", mappedBy="russianWord", cascade={"remove"})
     * @ORM\OrderBy({"positionInRussianWordDetail": "ASC"})
     * @var Collection<TranslationInterface>
     */
    protected Collection $translations;
}
