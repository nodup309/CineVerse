<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250120154441 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'ajoute relations role';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE role_membre (role_id INT NOT NULL, membre_id INT NOT NULL, INDEX IDX_5D921A98D60322AC (role_id), INDEX IDX_5D921A986A99F74A (membre_id), PRIMARY KEY(role_id, membre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role_film (role_id INT NOT NULL, film_id INT NOT NULL, INDEX IDX_3CFBCCB6D60322AC (role_id), INDEX IDX_3CFBCCB6567F5183 (film_id), PRIMARY KEY(role_id, film_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE role_membre ADD CONSTRAINT FK_5D921A98D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_membre ADD CONSTRAINT FK_5D921A986A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_film ADD CONSTRAINT FK_3CFBCCB6D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_film ADD CONSTRAINT FK_3CFBCCB6567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE role_membre DROP FOREIGN KEY FK_5D921A98D60322AC');
        $this->addSql('ALTER TABLE role_membre DROP FOREIGN KEY FK_5D921A986A99F74A');
        $this->addSql('ALTER TABLE role_film DROP FOREIGN KEY FK_3CFBCCB6D60322AC');
        $this->addSql('ALTER TABLE role_film DROP FOREIGN KEY FK_3CFBCCB6567F5183');
        $this->addSql('DROP TABLE role_membre');
        $this->addSql('DROP TABLE role_film');
    }
}
