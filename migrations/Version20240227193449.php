<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240227193449 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ajouter ADD produit_id INT DEFAULT NULL, ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ajouter ADD CONSTRAINT FK_AB384B5FF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE ajouter ADD CONSTRAINT FK_AB384B5FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_AB384B5FF347EFB ON ajouter (produit_id)');
        $this->addSql('CREATE INDEX IDX_AB384B5FA76ED395 ON ajouter (user_id)');
        $this->addSql('ALTER TABLE panier DROP INDEX IDX_24CC0DF2A76ED395, ADD UNIQUE INDEX UNIQ_24CC0DF2A76ED395 (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ajouter DROP FOREIGN KEY FK_AB384B5FF347EFB');
        $this->addSql('ALTER TABLE ajouter DROP FOREIGN KEY FK_AB384B5FA76ED395');
        $this->addSql('DROP INDEX IDX_AB384B5FF347EFB ON ajouter');
        $this->addSql('DROP INDEX IDX_AB384B5FA76ED395 ON ajouter');
        $this->addSql('ALTER TABLE ajouter DROP produit_id, DROP user_id');
        $this->addSql('ALTER TABLE panier DROP INDEX UNIQ_24CC0DF2A76ED395, ADD INDEX IDX_24CC0DF2A76ED395 (user_id)');
    }
}
