<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241218153220 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plan DROP FOREIGN KEY FK_DD5A5B7DA5E32D53');
        $this->addSql('DROP INDEX IDX_DD5A5B7DA5E32D53 ON plan');
        $this->addSql('ALTER TABLE plan ADD fichier VARCHAR(255) DEFAULT NULL, CHANGE numero_1_id numero1_id INT NOT NULL');
        $this->addSql('ALTER TABLE plan ADD CONSTRAINT FK_DD5A5B7D88EFC3B7 FOREIGN KEY (numero1_id) REFERENCES projet (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_DD5A5B7D88EFC3B7 ON plan (numero1_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plan DROP FOREIGN KEY FK_DD5A5B7D88EFC3B7');
        $this->addSql('DROP INDEX IDX_DD5A5B7D88EFC3B7 ON plan');
        $this->addSql('ALTER TABLE plan DROP fichier, CHANGE numero1_id numero_1_id INT NOT NULL');
        $this->addSql('ALTER TABLE plan ADD CONSTRAINT FK_DD5A5B7DA5E32D53 FOREIGN KEY (numero_1_id) REFERENCES projet (id)');
        $this->addSql('CREATE INDEX IDX_DD5A5B7DA5E32D53 ON plan (numero_1_id)');
    }
}
