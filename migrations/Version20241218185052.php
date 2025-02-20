<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241218185052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fichier (id INT AUTO_INCREMENT NOT NULL, plan_id INT NOT NULL, nom_fichier VARCHAR(255) NOT NULL, INDEX IDX_9B76551FE899029B (plan_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        //$this->addSql('ALTER TABLE fichier ADD CONSTRAINT FK_9B76551FE899029B FOREIGN KEY (plan_id) REFERENCES plan (id)');
        //$this->addSql('ALTER TABLE plan DROP fichier');
        //$this->addSql('ALTER TABLE fichier DROP FOREIGN KEY FK_9B76551FE899029B');
        $this->addSql('ALTER TABLE fichier ADD CONSTRAINT FK_9B76551FE899029B FOREIGN KEY (plan_id) REFERENCES plan(id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plan DROP COLUMN IF EXISTS fichier');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fichier DROP FOREIGN KEY FK_9B76551FE899029B');
        $this->addSql('DROP TABLE fichier');
        $this->addSql('ALTER TABLE plan ADD fichier VARCHAR(255) DEFAULT NULL');
    }
}
