<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210518105513 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE proposal_category (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, name VARCHAR(150) NOT NULL, slug VARCHAR(150) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, long_description LONGTEXT DEFAULT NULL, is_active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_E71725E95E237E06 (name), UNIQUE INDEX UNIQ_E71725E9989D9B62 (slug), INDEX IDX_E71725E9727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE proposal_category ADD CONSTRAINT FK_E71725E9727ACA70 FOREIGN KEY (parent_id) REFERENCES proposal_category (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE proposal_category DROP FOREIGN KEY FK_E71725E9727ACA70');
        $this->addSql('DROP TABLE proposal_category');
    }
}
