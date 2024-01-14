<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231005143100 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE possede DROP FOREIGN KEY FK_3D0B150819EB6921');
        $this->addSql('ALTER TABLE possede DROP FOREIGN KEY FK_3D0B1508EB1C8260');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418FF5AB468');
        $this->addSql('ALTER TABLE pssede DROP FOREIGN KEY FK_F4D0BB078B2BEB1');
        $this->addSql('ALTER TABLE produits_fournisseur DROP FOREIGN KEY FK_AB4CD5BF670C757F');
        $this->addSql('ALTER TABLE produits_fournisseur DROP FOREIGN KEY FK_AB4CD5BFCD11A2CF');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE possede');
        $this->addSql('DROP TABLE etat_commande');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE pssede');
        $this->addSql('DROP TABLE produits_fournisseur');
        $this->addSql('DROP TABLE enfants');
        $this->addSql('DROP TABLE magazin');
        $this->addSql('ALTER TABLE commande CHANGE qte_commandee qte_commande INT NOT NULL');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8CE1086D8C');
        $this->addSql('DROP INDEX IDX_BE2DDF8CE1086D8C ON produits');
        $this->addSql('ALTER TABLE produits DROP fk_rayon_id, CHANGE prix_produit prix_produit INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, adresse VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, tel_client VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, dt_naissance DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE possede (id INT AUTO_INCREMENT NOT NULL, fk_commande_id INT DEFAULT NULL, client_id INT DEFAULT NULL, qte_commandee INT NOT NULL, INDEX IDX_3D0B1508EB1C8260 (fk_commande_id), INDEX IDX_3D0B150819EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE etat_commande (id INT AUTO_INCREMENT NOT NULL, libelle_etat VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, fk_produit_id INT DEFAULT NULL, libelle VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_14B78418FF5AB468 (fk_produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE pssede (id INT AUTO_INCREMENT NOT NULL, fk_client_id INT DEFAULT NULL, INDEX IDX_F4D0BB078B2BEB1 (fk_client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE produits_fournisseur (produits_id INT NOT NULL, fournisseur_id INT NOT NULL, INDEX IDX_AB4CD5BFCD11A2CF (produits_id), INDEX IDX_AB4CD5BF670C757F (fournisseur_id), PRIMARY KEY(produits_id, fournisseur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE enfants (id INT AUTO_INCREMENT NOT NULL, age_enfant INT NOT NULL, sport VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE magazin (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE possede ADD CONSTRAINT FK_3D0B150819EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE possede ADD CONSTRAINT FK_3D0B1508EB1C8260 FOREIGN KEY (fk_commande_id) REFERENCES commande (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418FF5AB468 FOREIGN KEY (fk_produit_id) REFERENCES produits (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE pssede ADD CONSTRAINT FK_F4D0BB078B2BEB1 FOREIGN KEY (fk_client_id) REFERENCES client (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE produits_fournisseur ADD CONSTRAINT FK_AB4CD5BF670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produits_fournisseur ADD CONSTRAINT FK_AB4CD5BFCD11A2CF FOREIGN KEY (produits_id) REFERENCES produits (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande CHANGE qte_commande qte_commandee INT NOT NULL');
        $this->addSql('ALTER TABLE produits ADD fk_rayon_id INT DEFAULT NULL, CHANGE prix_produit prix_produit VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8CE1086D8C FOREIGN KEY (fk_rayon_id) REFERENCES rayon (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_BE2DDF8CE1086D8C ON produits (fk_rayon_id)');
    }
}
