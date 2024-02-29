<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240229200239 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ajouter DROP FOREIGN KEY FK_AB384B5FF347EFB');
        $this->addSql('ALTER TABLE ajouter CHANGE panier_id panier_id INT NOT NULL');
        $this->addSql('ALTER TABLE ajouter ADD CONSTRAINT FK_AB384B5FF77D927C FOREIGN KEY (panier_id) REFERENCES panier (id)');
        $this->addSql('CREATE INDEX IDX_AB384B5FF77D927C ON ajouter (panier_id)');
        $this->addSql('DROP INDEX fk_ab384b5ff347efb ON ajouter');
        $this->addSql('CREATE INDEX IDX_AB384B5FF347EFB ON ajouter (produit_id)');
        $this->addSql('ALTER TABLE ajouter ADD CONSTRAINT FK_AB384B5FF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ajouter DROP FOREIGN KEY FK_AB384B5FF77D927C');
        $this->addSql('DROP INDEX IDX_AB384B5FF77D927C ON ajouter');
        $this->addSql('ALTER TABLE ajouter DROP FOREIGN KEY FK_AB384B5FF347EFB');
        $this->addSql('ALTER TABLE ajouter CHANGE panier_id panier_id INT DEFAULT NULL');
        $this->addSql('DROP INDEX idx_ab384b5ff347efb ON ajouter');
        $this->addSql('CREATE INDEX FK_AB384B5FF347EFB ON ajouter (produit_id)');
        $this->addSql('ALTER TABLE ajouter ADD CONSTRAINT FK_AB384B5FF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
    }
}
