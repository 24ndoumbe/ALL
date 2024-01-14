<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230926144446 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE possede (id INT AUTO_INCREMENT NOT NULL, fk_commande_id INT DEFAULT NULL, client_id INT DEFAULT NULL, qte_commandee INT NOT NULL, INDEX IDX_3D0B1508EB1C8260 (fk_commande_id), INDEX IDX_3D0B150819EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pssede (id INT AUTO_INCREMENT NOT NULL, fk_client_id INT DEFAULT NULL, INDEX IDX_F4D0BB078B2BEB1 (fk_client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE possede ADD CONSTRAINT FK_3D0B1508EB1C8260 FOREIGN KEY (fk_commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE possede ADD CONSTRAINT FK_3D0B150819EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE pssede ADD CONSTRAINT FK_F4D0BB078B2BEB1 FOREIGN KEY (fk_client_id) REFERENCES client (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE possede DROP FOREIGN KEY FK_3D0B1508EB1C8260');
        $this->addSql('ALTER TABLE possede DROP FOREIGN KEY FK_3D0B150819EB6921');
        $this->addSql('ALTER TABLE pssede DROP FOREIGN KEY FK_F4D0BB078B2BEB1');
        $this->addSql('DROP TABLE possede');
        $this->addSql('DROP TABLE pssede');
    }
}
