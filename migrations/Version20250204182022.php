<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250204182022 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creation des tables Liste et RangFilm';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE liste (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, is_publique TINYINT(1) NOT NULL, is_collaborative TINYINT(1) NOT NULL, is_aregarder TINYINT(1) NOT NULL, is_favori TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE liste_user (liste_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_ACC4169AE85441D8 (liste_id), INDEX IDX_ACC4169AA76ED395 (user_id), PRIMARY KEY(liste_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rang_film (id INT AUTO_INCREMENT NOT NULL, rang INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rang_film_film (rang_film_id INT NOT NULL, film_id INT NOT NULL, INDEX IDX_F8AEAC1392C727C5 (rang_film_id), INDEX IDX_F8AEAC13567F5183 (film_id), PRIMARY KEY(rang_film_id, film_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rang_film_liste (rang_film_id INT NOT NULL, liste_id INT NOT NULL, INDEX IDX_AD56C0DC92C727C5 (rang_film_id), INDEX IDX_AD56C0DCE85441D8 (liste_id), PRIMARY KEY(rang_film_id, liste_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE liste_user ADD CONSTRAINT FK_ACC4169AE85441D8 FOREIGN KEY (liste_id) REFERENCES liste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE liste_user ADD CONSTRAINT FK_ACC4169AA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rang_film_film ADD CONSTRAINT FK_F8AEAC1392C727C5 FOREIGN KEY (rang_film_id) REFERENCES rang_film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rang_film_film ADD CONSTRAINT FK_F8AEAC13567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rang_film_liste ADD CONSTRAINT FK_AD56C0DC92C727C5 FOREIGN KEY (rang_film_id) REFERENCES rang_film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rang_film_liste ADD CONSTRAINT FK_AD56C0DCE85441D8 FOREIGN KEY (liste_id) REFERENCES liste (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE liste_user DROP FOREIGN KEY FK_ACC4169AE85441D8');
        $this->addSql('ALTER TABLE liste_user DROP FOREIGN KEY FK_ACC4169AA76ED395');
        $this->addSql('ALTER TABLE rang_film_film DROP FOREIGN KEY FK_F8AEAC1392C727C5');
        $this->addSql('ALTER TABLE rang_film_film DROP FOREIGN KEY FK_F8AEAC13567F5183');
        $this->addSql('ALTER TABLE rang_film_liste DROP FOREIGN KEY FK_AD56C0DC92C727C5');
        $this->addSql('ALTER TABLE rang_film_liste DROP FOREIGN KEY FK_AD56C0DCE85441D8');
        $this->addSql('DROP TABLE liste');
        $this->addSql('DROP TABLE liste_user');
        $this->addSql('DROP TABLE rang_film');
        $this->addSql('DROP TABLE rang_film_film');
        $this->addSql('DROP TABLE rang_film_liste');
    }
}
