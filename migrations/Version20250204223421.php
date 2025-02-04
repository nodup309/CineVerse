<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250204223421 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creation des tables Ami et Preference';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ami (id INT AUTO_INCREMENT NOT NULL, user_demandeur_id INT NOT NULL, user_receveur_id INT NOT NULL, date_demande DATE NOT NULL, statut_demande VARCHAR(255) NOT NULL, INDEX IDX_5269B413156A925B (user_demandeur_id), INDEX IDX_5269B413107C2FB3 (user_receveur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE preference (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE preference_user (preference_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_FA648E65D81022C0 (preference_id), INDEX IDX_FA648E65A76ED395 (user_id), PRIMARY KEY(preference_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE preference_genre (preference_id INT NOT NULL, genre_id INT NOT NULL, INDEX IDX_B1FFA843D81022C0 (preference_id), INDEX IDX_B1FFA8434296D31F (genre_id), PRIMARY KEY(preference_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE preference_membre (preference_id INT NOT NULL, membre_id INT NOT NULL, INDEX IDX_AA353EB6D81022C0 (preference_id), INDEX IDX_AA353EB66A99F74A (membre_id), PRIMARY KEY(preference_id, membre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ami ADD CONSTRAINT FK_5269B413156A925B FOREIGN KEY (user_demandeur_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE ami ADD CONSTRAINT FK_5269B413107C2FB3 FOREIGN KEY (user_receveur_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE preference_user ADD CONSTRAINT FK_FA648E65D81022C0 FOREIGN KEY (preference_id) REFERENCES preference (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE preference_user ADD CONSTRAINT FK_FA648E65A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE preference_genre ADD CONSTRAINT FK_B1FFA843D81022C0 FOREIGN KEY (preference_id) REFERENCES preference (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE preference_genre ADD CONSTRAINT FK_B1FFA8434296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE preference_membre ADD CONSTRAINT FK_AA353EB6D81022C0 FOREIGN KEY (preference_id) REFERENCES preference (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE preference_membre ADD CONSTRAINT FK_AA353EB66A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ami DROP FOREIGN KEY FK_5269B413156A925B');
        $this->addSql('ALTER TABLE ami DROP FOREIGN KEY FK_5269B413107C2FB3');
        $this->addSql('ALTER TABLE preference_user DROP FOREIGN KEY FK_FA648E65D81022C0');
        $this->addSql('ALTER TABLE preference_user DROP FOREIGN KEY FK_FA648E65A76ED395');
        $this->addSql('ALTER TABLE preference_genre DROP FOREIGN KEY FK_B1FFA843D81022C0');
        $this->addSql('ALTER TABLE preference_genre DROP FOREIGN KEY FK_B1FFA8434296D31F');
        $this->addSql('ALTER TABLE preference_membre DROP FOREIGN KEY FK_AA353EB6D81022C0');
        $this->addSql('ALTER TABLE preference_membre DROP FOREIGN KEY FK_AA353EB66A99F74A');
        $this->addSql('DROP TABLE ami');
        $this->addSql('DROP TABLE preference');
        $this->addSql('DROP TABLE preference_user');
        $this->addSql('DROP TABLE preference_genre');
        $this->addSql('DROP TABLE preference_membre');
    }
}
