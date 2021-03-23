<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210209124224 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE proposal ADD slug VARCHAR(150) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BFE59472989D9B62 ON proposal (slug)');
        $this->addSql('ALTER TABLE skill_category ADD slug VARCHAR(150) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_44E47433989D9B62 ON skill_category (slug)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_BFE59472989D9B62 ON proposal');
        $this->addSql('ALTER TABLE proposal DROP slug');
        $this->addSql('DROP INDEX UNIQ_44E47433989D9B62 ON skill_category');
        $this->addSql('ALTER TABLE skill_category DROP slug');
    }
}
