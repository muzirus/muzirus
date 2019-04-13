<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190413194336 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE word_categories CHANGE title_in_russian title_in_russian VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
    }
}
