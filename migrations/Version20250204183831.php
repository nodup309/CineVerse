<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250204183831 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creation des tables Badge et UserBadge';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE badge (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, quota INT NOT NULL, type VARCHAR(255) NOT NULL, is_secret TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_badge (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, is_obtenu TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_badge ADD badge_id INT NOT NULL, ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_badge ADD CONSTRAINT FK_1C32B345F7A2C2FC FOREIGN KEY (badge_id) REFERENCES badge (id)');
        $this->addSql('ALTER TABLE user_badge ADD CONSTRAINT FK_1C32B345A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_1C32B345F7A2C2FC ON user_badge (badge_id)');
        $this->addSql('CREATE INDEX IDX_1C32B345A76ED395 ON user_badge (user_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE badge');
        $this->addSql('DROP TABLE user_badge');
        $this->addSql('ALTER TABLE user_badge DROP FOREIGN KEY FK_1C32B345F7A2C2FC');
        $this->addSql('ALTER TABLE user_badge DROP FOREIGN KEY FK_1C32B345A76ED395');
        $this->addSql('DROP INDEX IDX_1C32B345F7A2C2FC ON user_badge');
        $this->addSql('DROP INDEX IDX_1C32B345A76ED395 ON user_badge');
        $this->addSql('ALTER TABLE user_badge DROP badge_id, DROP user_id');
    }
}
