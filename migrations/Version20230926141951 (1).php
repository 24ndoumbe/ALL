<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230926141951 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE produits_fournisseur (produits_id INT NOT NULL, fournisseur_id INT NOT NULL, INDEX IDX_AB4CD5BFCD11A2CF (produits_id), INDEX IDX_AB4CD5BF670C757F (fournisseur_id), PRIMARY KEY(produits_id, fournisseur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE produits_fournisseur ADD CONSTRAINT FK_AB4CD5BFCD11A2CF FOREIGN KEY (produits_id) REFERENCES produits (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produits_fournisseur ADD CONSTRAINT FK_AB4CD5BF670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE photo ADD fk_produit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418FF5AB468 FOREIGN KEY (fk_produit_id) REFERENCES produits (id)');
        $this->addSql('CREATE INDEX IDX_14B78418FF5AB468 ON photo (fk_produit_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produits_fournisseur DROP FOREIGN KEY FK_AB4CD5BFCD11A2CF');
        $this->addSql('ALTER TABLE produits_fournisseur DROP FOREIGN KEY FK_AB4CD5BF670C757F');
        $this->addSql('DROP TABLE produits_fournisseur');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418FF5AB468');
        $this->addSql('DROP INDEX IDX_14B78418FF5AB468 ON photo');
        $this->addSql('ALTER TABLE photo DROP fk_produit_id');
    }
}
