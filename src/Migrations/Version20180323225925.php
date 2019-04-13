<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20180323225925 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('
            ALTER TABLE words 
            ADD language_note_type INT DEFAULT 0 NOT NULL, 
            CHANGE language_note_gender language_note_gender INT DEFAULT 0 NOT NULL,
            CHANGE status_light status_light INT DEFAULT 0 NOT NULL
        ');
    }

    public function down(Schema $schema): void
    {
    }
}
