<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240227164435 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ajouter DROP FOREIGN KEY FK_AB384B5FF347EFB');
        $this->addSql('ALTER TABLE ajouter DROP FOREIGN KEY FK_AB384B5F77482E5B');
        $this->addSql('DROP INDEX IDX_AB384B5FF347EFB ON ajouter');
        $this->addSql('DROP INDEX IDX_AB384B5F77482E5B ON ajouter');
        $this->addSql('ALTER TABLE ajouter ADD article_id INT DEFAULT NULL, ADD panier_id INT DEFAULT NULL, DROP produit_id, DROP id_panier_id, DROP quantite');
        $this->addSql('ALTER TABLE ajouter ADD CONSTRAINT FK_AB384B5F7294869C FOREIGN KEY (article_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE ajouter ADD CONSTRAINT FK_AB384B5FF77D927C FOREIGN KEY (panier_id) REFERENCES panier (id)');
        $this->addSql('CREATE INDEX IDX_AB384B5F7294869C ON ajouter (article_id)');
        $this->addSql('CREATE INDEX IDX_AB384B5FF77D927C ON ajouter (panier_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ajouter DROP FOREIGN KEY FK_AB384B5F7294869C');
        $this->addSql('ALTER TABLE ajouter DROP FOREIGN KEY FK_AB384B5FF77D927C');
        $this->addSql('DROP INDEX IDX_AB384B5F7294869C ON ajouter');
        $this->addSql('DROP INDEX IDX_AB384B5FF77D927C ON ajouter');
        $this->addSql('ALTER TABLE ajouter ADD produit_id INT DEFAULT NULL, ADD id_panier_id INT DEFAULT NULL, ADD quantite INT NOT NULL, DROP article_id, DROP panier_id');
        $this->addSql('ALTER TABLE ajouter ADD CONSTRAINT FK_AB384B5FF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE ajouter ADD CONSTRAINT FK_AB384B5F77482E5B FOREIGN KEY (id_panier_id) REFERENCES panier (id)');
        $this->addSql('CREATE INDEX IDX_AB384B5FF347EFB ON ajouter (produit_id)');
        $this->addSql('CREATE INDEX IDX_AB384B5F77482E5B ON ajouter (id_panier_id)');
    }
}
