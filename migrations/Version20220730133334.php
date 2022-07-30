<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220730133334 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE perms (id INT AUTO_INCREMENT NOT NULL, nom TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE perms_partenaires (perms_id INT NOT NULL, partenaires_id INT NOT NULL, INDEX IDX_8BD88FE5D73E21DD (perms_id), INDEX IDX_8BD88FE538898CF5 (partenaires_id), PRIMARY KEY(perms_id, partenaires_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE perms_partenaires ADD CONSTRAINT FK_8BD88FE5D73E21DD FOREIGN KEY (perms_id) REFERENCES perms (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE perms_partenaires ADD CONSTRAINT FK_8BD88FE538898CF5 FOREIGN KEY (partenaires_id) REFERENCES partenaires (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE perms_partenaires DROP FOREIGN KEY FK_8BD88FE5D73E21DD');
        $this->addSql('DROP TABLE perms');
        $this->addSql('DROP TABLE perms_partenaires');
    }
}
