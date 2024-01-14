<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231114125813 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE produits_commande (produits_id INT NOT NULL, commande_id INT NOT NULL, INDEX IDX_91DC5EAFCD11A2CF (produits_id), INDEX IDX_91DC5EAF82EA2E54 (commande_id), PRIMARY KEY(produits_id, commande_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE produits_commande ADD CONSTRAINT FK_91DC5EAFCD11A2CF FOREIGN KEY (produits_id) REFERENCES produits (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produits_commande ADD CONSTRAINT FK_91DC5EAF82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produits_commande DROP FOREIGN KEY FK_91DC5EAFCD11A2CF');
        $this->addSql('ALTER TABLE produits_commande DROP FOREIGN KEY FK_91DC5EAF82EA2E54');
        $this->addSql('DROP TABLE produits_commande');
    }
}
