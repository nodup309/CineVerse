<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250204180435 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Création des tables Visionnage et Critique';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE critique (id INT AUTO_INCREMENT NOT NULL, visionnage_id INT NOT NULL, date DATE NOT NULL, commentaire VARCHAR(500) DEFAULT NULL, is_publique TINYINT(1) NOT NULL, INDEX IDX_1F950324ADC0FFF (visionnage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visionnage (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, film_id INT NOT NULL, date_visionnage DATE NOT NULL, note INT DEFAULT NULL, INDEX IDX_8EC40820A76ED395 (user_id), INDEX IDX_8EC40820567F5183 (film_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE critique ADD CONSTRAINT FK_1F950324ADC0FFF FOREIGN KEY (visionnage_id) REFERENCES visionnage (id)');
        $this->addSql('ALTER TABLE visionnage ADD CONSTRAINT FK_8EC40820A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE visionnage ADD CONSTRAINT FK_8EC40820567F5183 FOREIGN KEY (film_id) REFERENCES film (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE critique DROP FOREIGN KEY FK_1F950324ADC0FFF');
        $this->addSql('ALTER TABLE visionnage DROP FOREIGN KEY FK_8EC40820A76ED395');
        $this->addSql('ALTER TABLE visionnage DROP FOREIGN KEY FK_8EC40820567F5183');
        $this->addSql('DROP TABLE critique');
        $this->addSql('DROP TABLE visionnage');
    }
}
