<?php declare(strict_types=1);

namespace App\Repository;

use Doctrine\DBAL\Connection;

class CountRepository
{
    private const KEY_CZECH_WORDS_COUNT = 'c_cw';
    private const KEY_RUSSIAN_WORDS_COUNT = 'c_rw';
    private const KEY_TRANSLATIONS_COUNT = 'c_t';
    private const KEY_TRANSLATION_EXAMPLES_COUNT = 'c_te';

    //-------------------------------------------------------------------------

    /** @var Connection */
    private $connection;

    /** @var bool */
    private $loaded = false;

    /** @var array */
    private $data = [];

    //-------------------------------------------------------------------------

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    //-------------------------------------------------------------------------

    public function countRussianWords(): int
    {
        $this->load();

        return $this->data[self::KEY_RUSSIAN_WORDS_COUNT];
    }

    public function countCzechWords(): int
    {
        $this->load();

        return $this->data[self::KEY_CZECH_WORDS_COUNT];
    }

    public function countTranslations(): int
    {
        $this->load();

        return $this->data[self::KEY_TRANSLATIONS_COUNT];
    }

    public function countTranslationExamples(): int
    {
        $this->load();

        return $this->data[self::KEY_TRANSLATION_EXAMPLES_COUNT];
    }

    //-------------------------------------------------------------------------

    private function hasLoaded(): bool
    {
        return $this->loaded;
    }

    private function load(): void
    {
        if ($this->hasLoaded()) {
            return;
        }

        $sql = "
            SELECT
              c_cw, c_rw, c_t, c_te
            FROM (
              (SELECT COUNT(id) AS c_cw FROM words WHERE words.language IN ('czech')) AS cw,
              (SELECT COUNT(id) AS c_rw FROM words WHERE words.language IN ('russian')) AS rw,
              (SELECT COUNT(id) AS c_t FROM translations) AS t,
              (SELECT COUNT(id) AS c_te FROM translation_examples) AS te
            );
        ";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        $this->data = $stmt->fetch();
        $this->loaded = true;
    }
}
