<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210325131511 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE proposal_skill (id INT AUTO_INCREMENT NOT NULL, proposal_id INT UNSIGNED NOT NULL, skill_id SMALLINT UNSIGNED NOT NULL, level_id SMALLINT UNSIGNED DEFAULT NULL, INDEX IDX_99CA2DD6F4792058 (proposal_id), INDEX IDX_99CA2DD65585C142 (skill_id), INDEX IDX_99CA2DD65FB14BA7 (level_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE proposal_skill ADD CONSTRAINT FK_99CA2DD6F4792058 FOREIGN KEY (proposal_id) REFERENCES proposal (id)');
        $this->addSql('ALTER TABLE proposal_skill ADD CONSTRAINT FK_99CA2DD65585C142 FOREIGN KEY (skill_id) REFERENCES skill (id)');
        $this->addSql('ALTER TABLE proposal_skill ADD CONSTRAINT FK_99CA2DD65FB14BA7 FOREIGN KEY (level_id) REFERENCES skill_level (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE proposal_skill');
    }
}
