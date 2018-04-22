<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20180422150058 extends AbstractMigration
{
    private const TYPE = 2;
    private const CATEGORY_ID = 21;

    public function up(Schema $schema): void
    {
        $words = $this->connection->fetchAll(
            'SELECT id FROM words WHERE language_note_type = :type',
            [
                'type' => self::TYPE,
            ]
        );

        foreach ($words as $word) {
            $count = $this->connection->fetchColumn(
                'SELECT COUNT(*) FROM words_categories WHERE category_id = :category_id AND word_id = :word_id',
                [
                    'category_id' => self::CATEGORY_ID,
                    'word_id' => $word['id'],
                ]
            );

            if ($count > 0) {
                continue;
            }

            $this->addSql(
                'INSERT INTO words_categories (word_id, category_id) VALUES (:word_id, :category_id)',
                [
                    'category_id' => self::CATEGORY_ID,
                    'word_id' => $word['id'],
                ]
            );
        }
    }

    public function down(Schema $schema): void
    {
    }
}
