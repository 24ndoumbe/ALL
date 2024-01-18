<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240118143057 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client ADD prenom_client VARCHAR(255) NOT NULL, ADD nom_client VARCHAR(255) NOT NULL, ADD mail_client VARCHAR(255) NOT NULL, ADD password_client VARCHAR(255) NOT NULL, ADD adresse_client VARCHAR(255) NOT NULL, ADD telephone_client INT NOT NULL, ADD nb_enfant_client INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP prenom_client, DROP nom_client, DROP mail_client, DROP password_client, DROP adresse_client, DROP telephone_client, DROP nb_enfant_client');
    }
}
