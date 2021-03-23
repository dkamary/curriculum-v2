<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210304120644 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE skill ADD slug VARCHAR(150) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5E3DE477989D9B62 ON skill (slug)');
        $this->addSql('ALTER TABLE user ADD avatar_path VARCHAR(255) DEFAULT NULL, ADD banner_path VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_5E3DE477989D9B62 ON skill');
        $this->addSql('ALTER TABLE skill DROP slug');
        $this->addSql('ALTER TABLE `user` DROP avatar_path, DROP banner_path');
    }
}
