<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20180415134105 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('DROP DATABASE;');
    }

    public function down(Schema $schema): void
    {
    }
}
