<?php declare(strict_types=1);

namespace App\Repository;

use Doctrine\DBAL\Connection;
use Psr\Log\LoggerInterface;

class CountRepository
{
    private const KEY_CZECH_WORDS_COUNT = 'c_cw';
    private const KEY_RUSSIAN_WORDS_COUNT = 'c_rw';
    private const KEY_TRANSLATIONS_COUNT = 'c_t';
    private const KEY_TRANSLATION_EXAMPLES_COUNT = 'c_te';

    //-------------------------------------------------------------------------

    private Connection $connection;

    private LoggerInterface $logger;

    private bool $loaded = false;

    /** @var array<string, string> */
    private array $data = [
        self::KEY_CZECH_WORDS_COUNT => '0',
        self::KEY_RUSSIAN_WORDS_COUNT => '0',
        self::KEY_TRANSLATIONS_COUNT => '0',
        self::KEY_TRANSLATION_EXAMPLES_COUNT => '0',
    ];

    //-------------------------------------------------------------------------

    public function __construct(Connection $connection, LoggerInterface $logger)
    {
        $this->connection = $connection;
        $this->logger = $logger;
    }

    //-------------------------------------------------------------------------

    public function countRussianWords(): int
    {
        $this->load();

        return (int) $this->data[self::KEY_RUSSIAN_WORDS_COUNT];
    }

    public function countCzechWords(): int
    {
        $this->load();

        return (int) $this->data[self::KEY_CZECH_WORDS_COUNT];
    }

    public function countTranslations(): int
    {
        $this->load();

        return (int) $this->data[self::KEY_TRANSLATIONS_COUNT];
    }

    public function countTranslationExamples(): int
    {
        $this->load();

        return (int) $this->data[self::KEY_TRANSLATION_EXAMPLES_COUNT];
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

        try {
            /** @var array<string, string> $result */
            $result = $this->connection->prepare($sql)->executeQuery()->fetchAssociative();

            $this->data = $result;
        } catch (\Doctrine\DBAL\Exception | \Doctrine\DBAL\Driver\Exception $exception) {
            $this->logger->error(
                'Failed to load counts.',
                [
                    'exception' => $exception,
                ]
            );
        }

        $this->loaded = true;
    }
}
