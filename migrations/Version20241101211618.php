<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241101211618 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE utilisateurs (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, mot_de_passe VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateurs_projet (utilisateurs_id INT NOT NULL, projet_id INT NOT NULL, INDEX IDX_7DF4FBA11E969C5 (utilisateurs_id), INDEX IDX_7DF4FBA1C18272 (projet_id), PRIMARY KEY(utilisateurs_id, projet_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE utilisateurs_projet ADD CONSTRAINT FK_7DF4FBA11E969C5 FOREIGN KEY (utilisateurs_id) REFERENCES utilisateurs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateurs_projet ADD CONSTRAINT FK_7DF4FBA1C18272 FOREIGN KEY (projet_id) REFERENCES projet (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateurs_projet DROP FOREIGN KEY FK_7DF4FBA11E969C5');
        $this->addSql('ALTER TABLE utilisateurs_projet DROP FOREIGN KEY FK_7DF4FBA1C18272');
        $this->addSql('DROP TABLE utilisateurs');
        $this->addSql('DROP TABLE utilisateurs_projet');
    }
}
