<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20180427151438 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE posts ADD title_in_russian VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE post_revisions ADD content_in_russian LONGTEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
    }
}
