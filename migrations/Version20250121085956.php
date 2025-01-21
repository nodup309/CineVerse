<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Entity\Genre;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250121085956 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'ajout uuid dans la table genre et insertion des données';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE genre ADD uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE film MODIFY COLUMN id INT AUTO_INCREMENT');
        $this->addSql('ALTER TABLE genre MODIFY COLUMN id INT AUTO_INCREMENT');
        $this->addSql('ALTER TABLE membre MODIFY COLUMN id INT AUTO_INCREMENT');
        $this->addSql('ALTER TABLE role MODIFY COLUMN id INT AUTO_INCREMENT');
        $this->addSql('ALTER TABLE user MODIFY COLUMN id INT AUTO_INCREMENT');

        $this->addSql("
            INSERT INTO genre (uuid, libelle, description) VALUES 
            ('" . Genre::ACTION . "', 'action', 'Succession de scènes spectaculaires (courses-poursuites, fusillades, explosions) centrées sur un conflit résolu de manière violente, généralement par la mort des ennemis du héros'),
            ('" . Genre::ANIMATION_3D . "', 'animation 3D', 'Technique d\'animation par ordinateur permettant de créer et d\'animer des objets ou personnages dans un univers en trois dimensions'),
            ('" . Genre::AVENTURE . "', 'aventure', 'Mettant en scène un héros fictif ou non, ce genre se distingue par des actions extraordinaires, des décors marquants, des invraisemblances assumées et un dépaysement souvent hors du temps'),
            ('" . Genre::BIOPIC . "', 'biopic', 'Film dont le scénario s\'inspire de la vie d\'un personnage célèbre, avec une attention particulière portée à l\'époque et aux figures historiques qui l\'entourent'),
            ('" . Genre::CASSE . "', 'casse', 'Aussi appelé film de braquage, ce genre tourne autour d\'un groupe planifiant et exécutant un vol complexe'),
            ('" . Genre::CATASTROPHE . "', 'catastrophe', 'Film à suspense mettant en scène une catastrophe naturelle ou technologique et explorant ses conséquences sur les personnages'),
            ('" . Genre::COMEDIE . "', 'comédie', 'Un genre destiné à faire rire ou sourire grâce à des situations, dialogues, personnages ou effets humoristiques'),
            ('" . Genre::DESSIN_ANIME . "', 'dessin animé', 'Animation d\'illustrations créées à la main ou numériquement, image par image'),
            ('" . Genre::DOCUMENTAIRE . "', 'documentaire', 'Œuvre qui explore et présente des faits réels, des événements ou des sujets variés, souvent dans une démarche pédagogique ou informative'),
            ('" . Genre::DRAME . "', 'drame', 'Récit intense abordant des conflits humains, sociaux ou psychologiques, avec un ton grave et émouvant'),
            ('" . Genre::FANTASY . "', 'fantasy', 'Histoire située dans un monde imaginaire, souvent empreint d\'une esthétique médiévale'),
            ('" . Genre::GUERRE . "', 'guerre', ' Film centré sur un conflit armé, qu\'il soit terrestre, naval ou aérien, mettant en lumière les combats, les stratégies militaires et leurs impacts sur les individus et les sociétés'),
            ('" . Genre::HISTORIQUE . "', 'historique', 'Film ancré dans une période précise du passé, mettant en avant les événements, les personnages et le contexte de l\'époque, avec un souci de reconstitution fidèle ou interprétative'),
            ('" . Genre::HORREUR . "', 'horreur', 'Conçu pour susciter peur, angoisse ou dégoût chez le spectateur, ce genre joue sur les instincts primaires'),
            ('" . Genre::MERVEILLEUX . "', 'merveilleux', 'Genre plongeant directement dans un univers surnaturel où des éléments magiques et extraordinaires sont acceptés comme naturels, sans remettre en question leur existence'),
            ('" . Genre::MUSICAL . "', 'musical', 'Les chansons et parfois les danses s\'intègrent au récit, contribuant à l\'intrigue ou développant les personnages'),
            ('" . Genre::PEPLUM . "', 'peplum', 'Films évoquant des événements ou aventures se déroulant dans l\'Antiquité, souvent spectaculaires'),
            ('" . Genre::POLICIER . "', 'policier', 'Plongée dans le milieu du crime ou de la police, souvent autour d\'enquêtes et de mystères à résoudre'),
            ('" . Genre::ROMANCE . "', 'romance', 'Histoires centrées sur l\'amour et les émotions passionnelles, mettant en avant les relations entre les personnages'),
            ('" . Genre::SCIENCE_FICTION . "', 'science-fiction', 'Exploration d\'univers futuristes ou hypothétiques, basés sur des avancées scientifiques et technologiques imaginées'),
            ('" . Genre::STOP_MOTION . "', 'stop-motion', 'Technique d\'animation où des objets ou personnages sont déplacés image par image pour créer une illusion de mouvement'),
            ('" . Genre::SUPER_HEROS . "', 'super-héros', 'Des individus dotés de pouvoirs extraordinaires se battant pour protéger la population ou sauver le monde'),
            ('" . Genre::THRILLER . "', 'thriller', 'Récits jouant sur le suspense et la tension pour captiver et tenir le spectateur en haleine jusqu\'au dénouement'),
            ('" . Genre::WESTERN . "', 'western', 'Histoires situées dans le Far West, illustrant les affrontements et l\'exploration de ces terres mythiques');
        ");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE genre DROP uuid');
    }
}
