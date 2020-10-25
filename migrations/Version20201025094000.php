<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201025094000 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE run (id INT AUTO_INCREMENT NOT NULL, uid_id INT NOT NULL, type_id INT NOT NULL, datetime DATETIME NOT NULL, duration INT NOT NULL, distance INT NOT NULL, comment LONGTEXT DEFAULT NULL, INDEX IDX_5076A4C0534B549B (uid_id), INDEX IDX_5076A4C0C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE run_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE run ADD CONSTRAINT FK_5076A4C0534B549B FOREIGN KEY (uid_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE run ADD CONSTRAINT FK_5076A4C0C54C8C93 FOREIGN KEY (type_id) REFERENCES run_type (id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE run DROP FOREIGN KEY FK_5076A4C0C54C8C93');
        $this->addSql('DROP TABLE run');
        $this->addSql('DROP TABLE run_type');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
