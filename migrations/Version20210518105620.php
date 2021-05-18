<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210518105620 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE proposal ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE proposal ADD CONSTRAINT FK_BFE5947212469DE2 FOREIGN KEY (category_id) REFERENCES proposal_category (id)');
        $this->addSql('CREATE INDEX IDX_BFE5947212469DE2 ON proposal (category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE proposal DROP FOREIGN KEY FK_BFE5947212469DE2');
        $this->addSql('DROP INDEX IDX_BFE5947212469DE2 ON proposal');
        $this->addSql('ALTER TABLE proposal DROP category_id');
    }
}
