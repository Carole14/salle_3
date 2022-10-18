<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220929161550 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE partners (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_EFEB5164A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partners_perms (partners_id INT NOT NULL, perms_id INT NOT NULL, INDEX IDX_C2CC8FBEBDE7F1C6 (partners_id), INDEX IDX_C2CC8FBED73E21DD (perms_id), PRIMARY KEY(partners_id, perms_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE partners ADD CONSTRAINT FK_EFEB5164A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE partners_perms ADD CONSTRAINT FK_C2CC8FBEBDE7F1C6 FOREIGN KEY (partners_id) REFERENCES partners (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partners_perms ADD CONSTRAINT FK_C2CC8FBED73E21DD FOREIGN KEY (perms_id) REFERENCES perms (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE structures ADD partners_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE structures ADD CONSTRAINT FK_5BBEC55ABDE7F1C6 FOREIGN KEY (partners_id) REFERENCES partners (id)');
        $this->addSql('CREATE INDEX IDX_5BBEC55ABDE7F1C6 ON structures (partners_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE partners_perms DROP FOREIGN KEY FK_C2CC8FBEBDE7F1C6');
        $this->addSql('ALTER TABLE structures DROP FOREIGN KEY FK_5BBEC55ABDE7F1C6');
        $this->addSql('DROP TABLE partners');
        $this->addSql('DROP TABLE partners_perms');
        $this->addSql('DROP INDEX IDX_5BBEC55ABDE7F1C6 ON structures');
        $this->addSql('ALTER TABLE structures DROP partners_id');
    }
}
