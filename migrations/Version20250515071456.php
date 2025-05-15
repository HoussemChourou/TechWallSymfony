<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250515071456 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE hobby (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE job (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE personne_hobby (personne_id INT NOT NULL, hobby_id INT NOT NULL, INDEX IDX_2D85E25EA21BD112 (personne_id), INDEX IDX_2D85E25E322B2123 (hobby_id), PRIMARY KEY(personne_id, hobby_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE profile (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) NOT NULL, rs VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE personne_hobby ADD CONSTRAINT FK_2D85E25EA21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE personne_hobby ADD CONSTRAINT FK_2D85E25E322B2123 FOREIGN KEY (hobby_id) REFERENCES hobby (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE personne ADD profile_id INT DEFAULT NULL, ADD job_id INT DEFAULT NULL, DROP job
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EFCCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EFBE04EA9 FOREIGN KEY (job_id) REFERENCES job (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_FCEC9EFCCFA12B8 ON personne (profile_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_FCEC9EFBE04EA9 ON personne (job_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EFBE04EA9
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EFCCFA12B8
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE personne_hobby DROP FOREIGN KEY FK_2D85E25EA21BD112
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE personne_hobby DROP FOREIGN KEY FK_2D85E25E322B2123
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE hobby
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE job
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE personne_hobby
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE profile
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_FCEC9EFCCFA12B8 ON personne
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_FCEC9EFBE04EA9 ON personne
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE personne ADD job VARCHAR(50) DEFAULT NULL, DROP profile_id, DROP job_id
        SQL);
    }
}
