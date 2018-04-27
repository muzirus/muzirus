<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20180427160103 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql("UPDATE posts SET slug = 'index' WHERE slug = 'http-www-muzirus-cz-cs'");
    }

    public function down(Schema $schema): void
    {
    }
}
