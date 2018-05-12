<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

final class Version20180512212838 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE users DROP password_recovery_key, DROP password_recovery_key_expire_dt, DROP locale');
    }

    public function down(Schema $schema): void
    {
    }
}
