<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20180419213224 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $posts = $this->connection->fetchAll('SELECT id, content FROM posts');

        foreach ($posts as $post) {
            $this->addSql(
                'INSERT INTO post_revisions (post_id, content) VALUES (:post_id, :content)',
                [
                    'post_id' => $post['id'],
                    'content' => $post['content'],
                ]
            );
        }
    }

    public function down(Schema $schema): void
    {
    }
}
