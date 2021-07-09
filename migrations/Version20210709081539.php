<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210709081539 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article CHANGE statut statut TINYINT(1) NOT NULL, CHANGE prix prix DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE categorie CHANGE statut statut TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE souscategorie CHANGE statut statut TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article CHANGE statut statut TINYINT(1) DEFAULT NULL, CHANGE prix prix INT NOT NULL');
        $this->addSql('ALTER TABLE categorie CHANGE statut statut TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE souscategorie CHANGE statut statut TINYINT(1) DEFAULT NULL');
    }
}
