<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220929163908 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE perms_partenaires DROP FOREIGN KEY FK_8BD88FE538898CF5');
        $this->addSql('ALTER TABLE structures DROP FOREIGN KEY FK_5BBEC55A98DE13AC');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64998DE13AC');
        $this->addSql('DROP TABLE partenaires');
        $this->addSql('DROP TABLE perms_partenaires');
        $this->addSql('DROP INDEX IDX_5BBEC55A98DE13AC ON structures');
        $this->addSql('ALTER TABLE structures DROP partenaire_id');
        $this->addSql('DROP INDEX UNIQ_8D93D64998DE13AC ON user');
        $this->addSql('ALTER TABLE user DROP partenaire_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE partenaires (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE perms_partenaires (perms_id INT NOT NULL, partenaires_id INT NOT NULL, INDEX IDX_8BD88FE5D73E21DD (perms_id), INDEX IDX_8BD88FE538898CF5 (partenaires_id), PRIMARY KEY(perms_id, partenaires_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE perms_partenaires ADD CONSTRAINT FK_8BD88FE538898CF5 FOREIGN KEY (partenaires_id) REFERENCES partenaires (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE perms_partenaires ADD CONSTRAINT FK_8BD88FE5D73E21DD FOREIGN KEY (perms_id) REFERENCES perms (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE structures ADD partenaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE structures ADD CONSTRAINT FK_5BBEC55A98DE13AC FOREIGN KEY (partenaire_id) REFERENCES partenaires (id)');
        $this->addSql('CREATE INDEX IDX_5BBEC55A98DE13AC ON structures (partenaire_id)');
        $this->addSql('ALTER TABLE user ADD partenaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64998DE13AC FOREIGN KEY (partenaire_id) REFERENCES partenaires (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64998DE13AC ON user (partenaire_id)');
    }
}
