<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181019082359 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_D592642C12469DE2');
        $this->addSql('CREATE TEMPORARY TABLE __temp__wallpaper AS SELECT id, category_id, filename, slug, width, height FROM wallpaper');
        $this->addSql('DROP TABLE wallpaper');
        $this->addSql('CREATE TABLE wallpaper (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, category_id INTEGER DEFAULT NULL, filename VARCHAR(255) NOT NULL COLLATE BINARY, slug VARCHAR(255) DEFAULT NULL COLLATE BINARY, width INTEGER NOT NULL, height INTEGER NOT NULL, file VARCHAR(255) NOT NULL, CONSTRAINT FK_D592642C12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO wallpaper (id, category_id, filename, slug, width, height) SELECT id, category_id, filename, slug, width, height FROM __temp__wallpaper');
        $this->addSql('DROP TABLE __temp__wallpaper');
        $this->addSql('CREATE INDEX IDX_D592642C12469DE2 ON wallpaper (category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_D592642C12469DE2');
        $this->addSql('CREATE TEMPORARY TABLE __temp__wallpaper AS SELECT id, category_id, filename, slug, width, height FROM wallpaper');
        $this->addSql('DROP TABLE wallpaper');
        $this->addSql('CREATE TABLE wallpaper (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, category_id INTEGER DEFAULT NULL, filename VARCHAR(255) NOT NULL, slug VARCHAR(255) DEFAULT NULL, width INTEGER NOT NULL, height INTEGER NOT NULL)');
        $this->addSql('INSERT INTO wallpaper (id, category_id, filename, slug, width, height) SELECT id, category_id, filename, slug, width, height FROM __temp__wallpaper');
        $this->addSql('DROP TABLE __temp__wallpaper');
        $this->addSql('CREATE INDEX IDX_D592642C12469DE2 ON wallpaper (category_id)');
    }
}
