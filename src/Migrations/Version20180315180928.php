<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20180315180928 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('DROP TABLE translation_examples_approvals');
        $this->addSql('DROP TABLE translation_examples_refusals');
        $this->addSql('DROP TABLE translations_approvals');
        $this->addSql('DROP TABLE translations_refusals');
    }

    public function down(Schema $schema): void
    {
    }
}
