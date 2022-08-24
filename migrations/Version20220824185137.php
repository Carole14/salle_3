<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220824185137 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE partenaires DROP FOREIGN KEY FK_D230102E98DE13AC');
        $this->addSql('DROP INDEX IDX_D230102E98DE13AC ON partenaires');
        $this->addSql('ALTER TABLE partenaires DROP partenaire_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE partenaires ADD partenaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE partenaires ADD CONSTRAINT FK_D230102E98DE13AC FOREIGN KEY (partenaire_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D230102E98DE13AC ON partenaires (partenaire_id)');
    }
}
