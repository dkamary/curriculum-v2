<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201130155157 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE applier (id INT UNSIGNED AUTO_INCREMENT NOT NULL, owner_id INT UNSIGNED NOT NULL, proposal_id INT UNSIGNED NOT NULL, apply_date DATETIME DEFAULT NULL, is_validate TINYINT(1) DEFAULT NULL, validate_date DATETIME DEFAULT NULL, INDEX IDX_D22A42C77E3C61F9 (owner_id), INDEX IDX_D22A42C7F4792058 (proposal_id), UNIQUE INDEX U_applier_owner_proposal (owner_id, proposal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asset (id INT UNSIGNED AUTO_INCREMENT NOT NULL, owner_id INT UNSIGNED DEFAULT NULL, asset_type_id SMALLINT UNSIGNED NOT NULL, title VARCHAR(255) DEFAULT NULL, path VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_2AF5A5CB548B0F (path), INDEX IDX_2AF5A5C7E3C61F9 (owner_id), INDEX IDX_2AF5A5CA6A2CDC5 (asset_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asset_type (id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL, mime VARCHAR(50) NOT NULL, extensions VARCHAR(255) DEFAULT NULL, name VARCHAR(150) NOT NULL, description VARCHAR(255) DEFAULT NULL, is_active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_68BA92E15E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company_type (id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, UNIQUE INDEX UNIQ_CFB34DC75E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contract_type (id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, is_active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_E4AB19415E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, alpha2 VARCHAR(2) NOT NULL, alpha3 VARCHAR(3) NOT NULL, UNIQUE INDEX UNIQ_5373C9665E237E06 (name), UNIQUE INDEX UNIQ_5373C966B762D672 (alpha2), UNIQUE INDEX UNIQ_5373C966C065E6E4 (alpha3), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experience (id INT UNSIGNED AUTO_INCREMENT NOT NULL, owner_id INT UNSIGNED NOT NULL, company VARCHAR(255) NOT NULL, start DATETIME NOT NULL, end DATETIME DEFAULT NULL, long_description LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_590C1031824A17C (long_description), INDEX IDX_590C1037E3C61F9 (owner_id), FULLTEXT INDEX IDX_experience_description (long_description), INDEX IDX_experience_start (start), INDEX IDX_experience_end (end), INDEX IDX_experience_start_end (start, end), INDEX IDX_experience_company (company), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experience_skill (id INT UNSIGNED AUTO_INCREMENT NOT NULL, experience_id INT UNSIGNED NOT NULL, skill_id SMALLINT UNSIGNED NOT NULL, INDEX IDX_3D6F986146E90E27 (experience_id), INDEX IDX_3D6F98615585C142 (skill_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language (id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL, icon_id INT UNSIGNED DEFAULT NULL, name VARCHAR(150) NOT NULL, alpha2 VARCHAR(2) NOT NULL, alpha3 VARCHAR(3) NOT NULL, is_active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_D4DB71B55E237E06 (name), UNIQUE INDEX UNIQ_D4DB71B5B762D672 (alpha2), UNIQUE INDEX UNIQ_D4DB71B5C065E6E4 (alpha3), INDEX IDX_D4DB71B554B9D732 (icon_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language_knowledge (id INT UNSIGNED AUTO_INCREMENT NOT NULL, owner_id INT UNSIGNED NOT NULL, level_id SMALLINT UNSIGNED NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_586755F77E3C61F9 (owner_id), INDEX IDX_586755F75FB14BA7 (level_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language_level (id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, UNIQUE INDEX UNIQ_E5B2C8425E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nationality (id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL, country_id SMALLINT UNSIGNED NOT NULL, name VARCHAR(150) NOT NULL, UNIQUE INDEX UNIQ_8AC58B705E237E06 (name), INDEX IDX_8AC58B70F92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE other (id INT UNSIGNED AUTO_INCREMENT NOT NULL, owner_id INT UNSIGNED NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_D95835207E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE other_skill (id INT UNSIGNED AUTO_INCREMENT NOT NULL, other_id INT UNSIGNED NOT NULL, skill_id SMALLINT UNSIGNED NOT NULL, level_id SMALLINT UNSIGNED NOT NULL, INDEX IDX_368913D9998D9879 (other_id), INDEX IDX_368913D95585C142 (skill_id), INDEX IDX_368913D95FB14BA7 (level_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proposal (id INT UNSIGNED AUTO_INCREMENT NOT NULL, owner_id INT UNSIGNED NOT NULL, featured_image_id INT UNSIGNED DEFAULT NULL, banner_image_id INT UNSIGNED DEFAULT NULL, long_description LONGTEXT NOT NULL, start DATETIME NOT NULL, end DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, is_active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_BFE594721824A17C (long_description), INDEX IDX_BFE594727E3C61F9 (owner_id), INDEX IDX_BFE594723569D950 (featured_image_id), INDEX IDX_BFE594723F9CEB4E (banner_image_id), FULLTEXT INDEX FT_proposal_long_description (long_description), INDEX IDX_proposal_start (start), INDEX IDX_proposal_end (end), INDEX IDX_proposal_start_end (start, end), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proposal_attachment (id INT UNSIGNED AUTO_INCREMENT NOT NULL, proposal_id INT UNSIGNED NOT NULL, asset_id INT UNSIGNED NOT NULL, comment VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_B6DEACD9474526C (comment), INDEX IDX_B6DEACDF4792058 (proposal_id), INDEX IDX_B6DEACD5DA1941 (asset_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proposal_favorite (id INT UNSIGNED AUTO_INCREMENT NOT NULL, owner_id INT UNSIGNED NOT NULL, proposal_id INT UNSIGNED NOT NULL, INDEX IDX_899EB2F17E3C61F9 (owner_id), INDEX IDX_899EB2F1F4792058 (proposal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill (id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL, category_id SMALLINT UNSIGNED DEFAULT NULL, name VARCHAR(150) NOT NULL, description VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_5E3DE4775E237E06 (name), INDEX IDX_5E3DE47712469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill_category (id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL, icon_id INT UNSIGNED DEFAULT NULL, banner_id INT UNSIGNED DEFAULT NULL, name VARCHAR(150) NOT NULL, description VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_44E474335E237E06 (name), INDEX IDX_44E4743354B9D732 (icon_id), INDEX IDX_44E47433684EC833 (banner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill_level (id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, UNIQUE INDEX UNIQ_BFC25F2F5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE training (id INT UNSIGNED AUTO_INCREMENT NOT NULL, owner_id INT UNSIGNED NOT NULL, school VARCHAR(255) NOT NULL, diploma VARCHAR(255) NOT NULL, note VARCHAR(512) DEFAULT NULL, start DATETIME NOT NULL, end DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_D5128A8F7E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT UNSIGNED AUTO_INCREMENT NOT NULL, user_type_id SMALLINT UNSIGNED DEFAULT NULL, company_type_id SMALLINT UNSIGNED DEFAULT NULL, naionaliy_id SMALLINT UNSIGNED DEFAULT NULL, country_id SMALLINT UNSIGNED DEFAULT NULL, language_id SMALLINT UNSIGNED DEFAULT NULL, avatar_id INT UNSIGNED DEFAULT NULL, banner_id INT UNSIGNED DEFAULT NULL, login VARCHAR(150) NOT NULL, email VARCHAR(150) NOT NULL, password VARCHAR(150) NOT NULL, gender SMALLINT DEFAULT NULL, firstname VARCHAR(150) NOT NULL, lastname VARCHAR(150) NOT NULL, birthdate DATE DEFAULT NULL, birthplace VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, zipcode VARCHAR(20) DEFAULT NULL, town VARCHAR(150) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, is_active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649AA08CB10 (login), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D6499D419299 (user_type_id), INDEX IDX_8D93D649E51E9644 (company_type_id), INDEX IDX_8D93D6499478DBF (naionaliy_id), INDEX IDX_8D93D649F92F3E70 (country_id), INDEX IDX_8D93D64982F1BAF4 (language_id), INDEX IDX_8D93D64986383B10 (avatar_id), INDEX IDX_8D93D649684EC833 (banner_id), INDEX IDX_user_login_password (login, password, is_active), INDEX IDX_user_email_password (email, password, is_active), INDEX IDX_user_login_email_password (login, email, password, is_active), INDEX IDX_user_email_login_password (email, login, password, is_active), INDEX IDX_user_login_email (login, email, is_active), INDEX IDX_user_email_login_ (email, login, is_active), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_attachment (id INT UNSIGNED AUTO_INCREMENT NOT NULL, owner_id INT UNSIGNED NOT NULL, asset_id INT UNSIGNED NOT NULL, comment VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_DE381F579474526C (comment), INDEX IDX_DE381F577E3C61F9 (owner_id), INDEX IDX_DE381F575DA1941 (asset_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_destination (id INT UNSIGNED AUTO_INCREMENT NOT NULL, owner_id INT UNSIGNED NOT NULL, country_id SMALLINT UNSIGNED NOT NULL, INDEX IDX_97DDF73F7E3C61F9 (owner_id), INDEX IDX_97DDF73FF92F3E70 (country_id), UNIQUE INDEX U_destination_user_country (owner_id, country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_favorite (id INT UNSIGNED AUTO_INCREMENT NOT NULL, owner_id INT UNSIGNED NOT NULL, favorite_user_id INT UNSIGNED NOT NULL, comment VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_88486AD99474526C (comment), INDEX IDX_88486AD97E3C61F9 (owner_id), INDEX IDX_88486AD9FA3A7DFB (favorite_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_motivation (id INT UNSIGNED AUTO_INCREMENT NOT NULL, owner_id INT UNSIGNED NOT NULL, contract_id SMALLINT UNSIGNED NOT NULL, presentation LONGTEXT DEFAULT NULL, INDEX IDX_4707B5017E3C61F9 (owner_id), INDEX IDX_4707B5012576E0FD (contract_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_stat (id INT UNSIGNED AUTO_INCREMENT NOT NULL, owner_id INT UNSIGNED NOT NULL, viewed INT UNSIGNED NOT NULL, searched INT UNSIGNED NOT NULL, last_connection DATETIME DEFAULT NULL, UNIQUE INDEX U_user_stat_owner (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_type (id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, description VARCHAR(255) DEFAULT NULL, is_active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_F65F1BE05E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE applier ADD CONSTRAINT FK_D22A42C77E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE applier ADD CONSTRAINT FK_D22A42C7F4792058 FOREIGN KEY (proposal_id) REFERENCES proposal (id)');
        $this->addSql('ALTER TABLE asset ADD CONSTRAINT FK_2AF5A5C7E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE asset ADD CONSTRAINT FK_2AF5A5CA6A2CDC5 FOREIGN KEY (asset_type_id) REFERENCES asset_type (id)');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C1037E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE experience_skill ADD CONSTRAINT FK_3D6F986146E90E27 FOREIGN KEY (experience_id) REFERENCES experience (id)');
        $this->addSql('ALTER TABLE experience_skill ADD CONSTRAINT FK_3D6F98615585C142 FOREIGN KEY (skill_id) REFERENCES skill (id)');
        $this->addSql('ALTER TABLE language ADD CONSTRAINT FK_D4DB71B554B9D732 FOREIGN KEY (icon_id) REFERENCES asset (id)');
        $this->addSql('ALTER TABLE language_knowledge ADD CONSTRAINT FK_586755F77E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE language_knowledge ADD CONSTRAINT FK_586755F75FB14BA7 FOREIGN KEY (level_id) REFERENCES language_level (id)');
        $this->addSql('ALTER TABLE nationality ADD CONSTRAINT FK_8AC58B70F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE other ADD CONSTRAINT FK_D95835207E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE other_skill ADD CONSTRAINT FK_368913D9998D9879 FOREIGN KEY (other_id) REFERENCES other (id)');
        $this->addSql('ALTER TABLE other_skill ADD CONSTRAINT FK_368913D95585C142 FOREIGN KEY (skill_id) REFERENCES skill (id)');
        $this->addSql('ALTER TABLE other_skill ADD CONSTRAINT FK_368913D95FB14BA7 FOREIGN KEY (level_id) REFERENCES skill_level (id)');
        $this->addSql('ALTER TABLE proposal ADD CONSTRAINT FK_BFE594727E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE proposal ADD CONSTRAINT FK_BFE594723569D950 FOREIGN KEY (featured_image_id) REFERENCES asset (id)');
        $this->addSql('ALTER TABLE proposal ADD CONSTRAINT FK_BFE594723F9CEB4E FOREIGN KEY (banner_image_id) REFERENCES asset (id)');
        $this->addSql('ALTER TABLE proposal_attachment ADD CONSTRAINT FK_B6DEACDF4792058 FOREIGN KEY (proposal_id) REFERENCES proposal (id)');
        $this->addSql('ALTER TABLE proposal_attachment ADD CONSTRAINT FK_B6DEACD5DA1941 FOREIGN KEY (asset_id) REFERENCES asset (id)');
        $this->addSql('ALTER TABLE proposal_favorite ADD CONSTRAINT FK_899EB2F17E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE proposal_favorite ADD CONSTRAINT FK_899EB2F1F4792058 FOREIGN KEY (proposal_id) REFERENCES proposal (id)');
        $this->addSql('ALTER TABLE skill ADD CONSTRAINT FK_5E3DE47712469DE2 FOREIGN KEY (category_id) REFERENCES skill_category (id)');
        $this->addSql('ALTER TABLE skill_category ADD CONSTRAINT FK_44E4743354B9D732 FOREIGN KEY (icon_id) REFERENCES asset (id)');
        $this->addSql('ALTER TABLE skill_category ADD CONSTRAINT FK_44E47433684EC833 FOREIGN KEY (banner_id) REFERENCES asset (id)');
        $this->addSql('ALTER TABLE training ADD CONSTRAINT FK_D5128A8F7E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D6499D419299 FOREIGN KEY (user_type_id) REFERENCES user_type (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649E51E9644 FOREIGN KEY (company_type_id) REFERENCES company_type (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D6499478DBF FOREIGN KEY (naionaliy_id) REFERENCES nationality (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D64982F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D64986383B10 FOREIGN KEY (avatar_id) REFERENCES asset (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649684EC833 FOREIGN KEY (banner_id) REFERENCES asset (id)');
        $this->addSql('ALTER TABLE user_attachment ADD CONSTRAINT FK_DE381F577E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE user_attachment ADD CONSTRAINT FK_DE381F575DA1941 FOREIGN KEY (asset_id) REFERENCES asset (id)');
        $this->addSql('ALTER TABLE user_destination ADD CONSTRAINT FK_97DDF73F7E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE user_destination ADD CONSTRAINT FK_97DDF73FF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE user_favorite ADD CONSTRAINT FK_88486AD97E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE user_favorite ADD CONSTRAINT FK_88486AD9FA3A7DFB FOREIGN KEY (favorite_user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE user_motivation ADD CONSTRAINT FK_4707B5017E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE user_motivation ADD CONSTRAINT FK_4707B5012576E0FD FOREIGN KEY (contract_id) REFERENCES contract_type (id)');
        $this->addSql('ALTER TABLE user_stat ADD CONSTRAINT FK_5A39B3E87E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE language DROP FOREIGN KEY FK_D4DB71B554B9D732');
        $this->addSql('ALTER TABLE proposal DROP FOREIGN KEY FK_BFE594723569D950');
        $this->addSql('ALTER TABLE proposal DROP FOREIGN KEY FK_BFE594723F9CEB4E');
        $this->addSql('ALTER TABLE proposal_attachment DROP FOREIGN KEY FK_B6DEACD5DA1941');
        $this->addSql('ALTER TABLE skill_category DROP FOREIGN KEY FK_44E4743354B9D732');
        $this->addSql('ALTER TABLE skill_category DROP FOREIGN KEY FK_44E47433684EC833');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D64986383B10');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649684EC833');
        $this->addSql('ALTER TABLE user_attachment DROP FOREIGN KEY FK_DE381F575DA1941');
        $this->addSql('ALTER TABLE asset DROP FOREIGN KEY FK_2AF5A5CA6A2CDC5');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649E51E9644');
        $this->addSql('ALTER TABLE user_motivation DROP FOREIGN KEY FK_4707B5012576E0FD');
        $this->addSql('ALTER TABLE nationality DROP FOREIGN KEY FK_8AC58B70F92F3E70');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649F92F3E70');
        $this->addSql('ALTER TABLE user_destination DROP FOREIGN KEY FK_97DDF73FF92F3E70');
        $this->addSql('ALTER TABLE experience_skill DROP FOREIGN KEY FK_3D6F986146E90E27');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D64982F1BAF4');
        $this->addSql('ALTER TABLE language_knowledge DROP FOREIGN KEY FK_586755F75FB14BA7');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6499478DBF');
        $this->addSql('ALTER TABLE other_skill DROP FOREIGN KEY FK_368913D9998D9879');
        $this->addSql('ALTER TABLE applier DROP FOREIGN KEY FK_D22A42C7F4792058');
        $this->addSql('ALTER TABLE proposal_attachment DROP FOREIGN KEY FK_B6DEACDF4792058');
        $this->addSql('ALTER TABLE proposal_favorite DROP FOREIGN KEY FK_899EB2F1F4792058');
        $this->addSql('ALTER TABLE experience_skill DROP FOREIGN KEY FK_3D6F98615585C142');
        $this->addSql('ALTER TABLE other_skill DROP FOREIGN KEY FK_368913D95585C142');
        $this->addSql('ALTER TABLE skill DROP FOREIGN KEY FK_5E3DE47712469DE2');
        $this->addSql('ALTER TABLE other_skill DROP FOREIGN KEY FK_368913D95FB14BA7');
        $this->addSql('ALTER TABLE applier DROP FOREIGN KEY FK_D22A42C77E3C61F9');
        $this->addSql('ALTER TABLE asset DROP FOREIGN KEY FK_2AF5A5C7E3C61F9');
        $this->addSql('ALTER TABLE experience DROP FOREIGN KEY FK_590C1037E3C61F9');
        $this->addSql('ALTER TABLE language_knowledge DROP FOREIGN KEY FK_586755F77E3C61F9');
        $this->addSql('ALTER TABLE other DROP FOREIGN KEY FK_D95835207E3C61F9');
        $this->addSql('ALTER TABLE proposal DROP FOREIGN KEY FK_BFE594727E3C61F9');
        $this->addSql('ALTER TABLE proposal_favorite DROP FOREIGN KEY FK_899EB2F17E3C61F9');
        $this->addSql('ALTER TABLE training DROP FOREIGN KEY FK_D5128A8F7E3C61F9');
        $this->addSql('ALTER TABLE user_attachment DROP FOREIGN KEY FK_DE381F577E3C61F9');
        $this->addSql('ALTER TABLE user_destination DROP FOREIGN KEY FK_97DDF73F7E3C61F9');
        $this->addSql('ALTER TABLE user_favorite DROP FOREIGN KEY FK_88486AD97E3C61F9');
        $this->addSql('ALTER TABLE user_favorite DROP FOREIGN KEY FK_88486AD9FA3A7DFB');
        $this->addSql('ALTER TABLE user_motivation DROP FOREIGN KEY FK_4707B5017E3C61F9');
        $this->addSql('ALTER TABLE user_stat DROP FOREIGN KEY FK_5A39B3E87E3C61F9');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6499D419299');
        $this->addSql('DROP TABLE applier');
        $this->addSql('DROP TABLE asset');
        $this->addSql('DROP TABLE asset_type');
        $this->addSql('DROP TABLE company_type');
        $this->addSql('DROP TABLE contract_type');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE experience');
        $this->addSql('DROP TABLE experience_skill');
        $this->addSql('DROP TABLE language');
        $this->addSql('DROP TABLE language_knowledge');
        $this->addSql('DROP TABLE language_level');
        $this->addSql('DROP TABLE nationality');
        $this->addSql('DROP TABLE other');
        $this->addSql('DROP TABLE other_skill');
        $this->addSql('DROP TABLE proposal');
        $this->addSql('DROP TABLE proposal_attachment');
        $this->addSql('DROP TABLE proposal_favorite');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE skill_category');
        $this->addSql('DROP TABLE skill_level');
        $this->addSql('DROP TABLE training');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE user_attachment');
        $this->addSql('DROP TABLE user_destination');
        $this->addSql('DROP TABLE user_favorite');
        $this->addSql('DROP TABLE user_motivation');
        $this->addSql('DROP TABLE user_stat');
        $this->addSql('DROP TABLE user_type');
    }
}
