<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20180422135122 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('UPDATE translations SET position = 0 WHERE position < 0');
    }

    public function down(Schema $schema): void
    {
    }
}
