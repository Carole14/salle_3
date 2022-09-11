<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220730134109 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE structures (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, mot_de_passe VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE structures_perms (structures_id INT NOT NULL, perms_id INT NOT NULL, INDEX IDX_E6BEC1EF9D3ED38D (structures_id), INDEX IDX_E6BEC1EFD73E21DD (perms_id), PRIMARY KEY(structures_id, perms_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE structures_perms ADD CONSTRAINT FK_E6BEC1EF9D3ED38D FOREIGN KEY (structures_id) REFERENCES structures (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE structures_perms ADD CONSTRAINT FK_E6BEC1EFD73E21DD FOREIGN KEY (perms_id) REFERENCES perms (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE structures_perms DROP FOREIGN KEY FK_E6BEC1EF9D3ED38D');
        $this->addSql('DROP TABLE structures');
        $this->addSql('DROP TABLE structures_perms');
    }
}
