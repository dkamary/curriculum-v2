<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201130171111 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE language_level ADD score SMALLINT UNSIGNED NOT NULL, ADD rank SMALLINT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE skill_level ADD score SMALLINT UNSIGNED NOT NULL, ADD rank SMALLINT UNSIGNED NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE language_level DROP score, DROP rank');
        $this->addSql('ALTER TABLE skill_level DROP score, DROP rank');
    }
}
