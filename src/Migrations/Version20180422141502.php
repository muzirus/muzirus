<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20180422141502 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE translations ADD position_in_czech_word_detail INT DEFAULT 0 NOT NULL');
    }

    public function down(Schema $schema): void
    {
    }
}
