<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210705090801 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adressefacturation (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, rue VARCHAR(255) NOT NULL, codepostal VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, INDEX IDX_1BBDD13519EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE adresselivraison (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, rue VARCHAR(255) NOT NULL, codepostal VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, INDEX IDX_E8D24A1519EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, souscategorie_id INT NOT NULL, panier_id INT DEFAULT NULL, image VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, couleur VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, statut TINYINT(1) DEFAULT NULL, stock INT DEFAULT NULL, prix INT NOT NULL, slug VARCHAR(255) DEFAULT NULL, promotion TINYINT(1) DEFAULT NULL, INDEX IDX_23A0E66A27126E0 (souscategorie_id), INDEX IDX_23A0E66F77D927C (panier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, statut TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(30) NOT NULL, prenom VARCHAR(30) NOT NULL, phone VARCHAR(14) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, panier_id INT DEFAULT NULL, client_id INT DEFAULT NULL, dateheure DATETIME NOT NULL, montant INT NOT NULL, UNIQUE INDEX UNIQ_6EEAA67DF77D927C (panier_id), INDEX IDX_6EEAA67D19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, article_id INT DEFAULT NULL, contenu LONGTEXT DEFAULT NULL, dateheure DATETIME NOT NULL, INDEX IDX_67F068BC19EB6921 (client_id), INDEX IDX_67F068BC7294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, objet VARCHAR(255) NOT NULL, contenu LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE panier (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, quantite INT NOT NULL, UNIQUE INDEX UNIQ_24CC0DF219EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE souscategorie (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, nom VARCHAR(255) NOT NULL, statut TINYINT(1) DEFAULT NULL, INDEX IDX_6FF3A701BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D64919EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adressefacturation ADD CONSTRAINT FK_1BBDD13519EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE adresselivraison ADD CONSTRAINT FK_E8D24A1519EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66A27126E0 FOREIGN KEY (souscategorie_id) REFERENCES souscategorie (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66F77D927C FOREIGN KEY (panier_id) REFERENCES panier (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DF77D927C FOREIGN KEY (panier_id) REFERENCES panier (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF219EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE souscategorie ADD CONSTRAINT FK_6FF3A701BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64919EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC7294869C');
        $this->addSql('ALTER TABLE souscategorie DROP FOREIGN KEY FK_6FF3A701BCF5E72D');
        $this->addSql('ALTER TABLE adressefacturation DROP FOREIGN KEY FK_1BBDD13519EB6921');
        $this->addSql('ALTER TABLE adresselivraison DROP FOREIGN KEY FK_E8D24A1519EB6921');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D19EB6921');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC19EB6921');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF219EB6921');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64919EB6921');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66F77D927C');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DF77D927C');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66A27126E0');
        $this->addSql('DROP TABLE adressefacturation');
        $this->addSql('DROP TABLE adresselivraison');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE panier');
        $this->addSql('DROP TABLE souscategorie');
        $this->addSql('DROP TABLE user');
    }
}
