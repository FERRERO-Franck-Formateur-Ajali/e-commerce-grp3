<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210716084941 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E6651E8871B');
        $this->addSql('DROP INDEX IDX_23A0E6651E8871B ON article');
        $this->addSql('ALTER TABLE article DROP favoris_id');
        $this->addSql('ALTER TABLE favoris ADD article_id INT NOT NULL');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_8933C4327294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('CREATE INDEX IDX_8933C4327294869C ON favoris (article_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD favoris_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E6651E8871B FOREIGN KEY (favoris_id) REFERENCES favoris (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_23A0E6651E8871B ON article (favoris_id)');
        $this->addSql('ALTER TABLE favoris DROP FOREIGN KEY FK_8933C4327294869C');
        $this->addSql('DROP INDEX IDX_8933C4327294869C ON favoris');
        $this->addSql('ALTER TABLE favoris DROP article_id');
    }
}
