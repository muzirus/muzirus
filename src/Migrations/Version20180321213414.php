<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20180321213414 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        try {
            $this->connection->beginTransaction();

            $this->addSql('CREATE TABLE log_entries (id INT AUTO_INCREMENT NOT NULL, user_id BIGINT DEFAULT NULL, russian_word_id BIGINT DEFAULT NULL, czech_word_id BIGINT DEFAULT NULL, category_id BIGINT DEFAULT NULL, source_id BIGINT DEFAULT NULL, source_type_id BIGINT DEFAULT NULL, translation_id BIGINT DEFAULT NULL, translation_example_id BIGINT DEFAULT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_15358B52A76ED395 (user_id), INDEX IDX_15358B52300F16E0 (russian_word_id), INDEX IDX_15358B527CE542AB (czech_word_id), INDEX IDX_15358B5212469DE2 (category_id), INDEX IDX_15358B52953C1C61 (source_id), INDEX IDX_15358B528C9334FB (source_type_id), INDEX IDX_15358B529CAA2B25 (translation_id), INDEX IDX_15358B52D18F76D1 (translation_example_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
            $this->addSql('ALTER TABLE log_entries ADD CONSTRAINT FK_15358B52A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE SET NULL');
            $this->addSql('ALTER TABLE log_entries ADD CONSTRAINT FK_15358B52300F16E0 FOREIGN KEY (russian_word_id) REFERENCES words (id) ON DELETE CASCADE');
            $this->addSql('ALTER TABLE log_entries ADD CONSTRAINT FK_15358B527CE542AB FOREIGN KEY (czech_word_id) REFERENCES words (id) ON DELETE CASCADE');
            $this->addSql('ALTER TABLE log_entries ADD CONSTRAINT FK_15358B5212469DE2 FOREIGN KEY (category_id) REFERENCES word_categories (id) ON DELETE CASCADE');
            $this->addSql('ALTER TABLE log_entries ADD CONSTRAINT FK_15358B52953C1C61 FOREIGN KEY (source_id) REFERENCES sources (id) ON DELETE CASCADE');
            $this->addSql('ALTER TABLE log_entries ADD CONSTRAINT FK_15358B528C9334FB FOREIGN KEY (source_type_id) REFERENCES source_types (id) ON DELETE CASCADE');
            $this->addSql('ALTER TABLE log_entries ADD CONSTRAINT FK_15358B529CAA2B25 FOREIGN KEY (translation_id) REFERENCES translations (id) ON DELETE CASCADE');
            $this->addSql('ALTER TABLE log_entries ADD CONSTRAINT FK_15358B52D18F76D1 FOREIGN KEY (translation_example_id) REFERENCES translation_examples (id) ON DELETE CASCADE');

            $this->connection->commit();
        } catch (\Throwable $exception) {
            $this->connection->rollBack();
            throw $exception;
        }
    }

    public function down(Schema $schema): void
    {
    }
}
