<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201201001341 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_590C1031824A17C ON experience');
        $this->addSql('DROP INDEX UNIQ_BFE594721824A17C ON proposal');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_590C1031824A17C ON experience (long_description)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BFE594721824A17C ON proposal (long_description)');
    }
}
