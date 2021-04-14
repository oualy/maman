<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210401224002 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `admin` (id INT AUTO_INCREMENT NOT NULL, role_id INT DEFAULT NULL, nom_admin VARCHAR(255) NOT NULL, prenom_admin VARCHAR(255) NOT NULL, code INT NOT NULL, INDEX IDX_880E0D76D60322AC (role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidats (id INT AUTO_INCREMENT NOT NULL, role_id INT DEFAULT NULL, prenom_candidat VARCHAR(255) NOT NULL, nom_candidat VARCHAR(255) NOT NULL, nom_parti VARCHAR(255) NOT NULL, classe VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, INDEX IDX_3C663B15D60322AC (role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE electeur (id INT AUTO_INCREMENT NOT NULL, role_id INT DEFAULT NULL, nom_electeur VARCHAR(255) NOT NULL, prenom_electeur VARCHAR(255) NOT NULL, code INT NOT NULL, classe VARCHAR(255) NOT NULL, INDEX IDX_719667F0D60322AC (role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `admin` ADD CONSTRAINT FK_880E0D76D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE candidats ADD CONSTRAINT FK_3C663B15D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE electeur ADD CONSTRAINT FK_719667F0D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `admin` DROP FOREIGN KEY FK_880E0D76D60322AC');
        $this->addSql('ALTER TABLE candidats DROP FOREIGN KEY FK_3C663B15D60322AC');
        $this->addSql('ALTER TABLE electeur DROP FOREIGN KEY FK_719667F0D60322AC');
        $this->addSql('DROP TABLE `admin`');
        $this->addSql('DROP TABLE candidats');
        $this->addSql('DROP TABLE electeur');
        $this->addSql('DROP TABLE role');
    }
}
