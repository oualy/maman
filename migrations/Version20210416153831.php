<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210416153831 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `admin` DROP FOREIGN KEY FK_880E0D76D60322AC');
        $this->addSql('ALTER TABLE candidats DROP FOREIGN KEY FK_3C663B15D60322AC');
        $this->addSql('ALTER TABLE electeur DROP FOREIGN KEY FK_719667F0D60322AC');
        $this->addSql('CREATE TABLE roles (id INT AUTO_INCREMENT NOT NULL, nom_role VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP INDEX IDX_880E0D76D60322AC ON `admin`');
        $this->addSql('ALTER TABLE `admin` DROP role_id');
        $this->addSql('DROP INDEX IDX_3C663B15D60322AC ON candidats');
        $this->addSql('ALTER TABLE candidats DROP role_id');
        $this->addSql('DROP INDEX IDX_719667F0D60322AC ON electeur');
        $this->addSql('ALTER TABLE electeur DROP role_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6498D0EB82');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649FAA286C3');
        $this->addSql('DROP INDEX IDX_8D93D6498D0EB82 ON user');
        $this->addSql('DROP INDEX IDX_8D93D649FAA286C3 ON user');
        $this->addSql('ALTER TABLE user DROP admins_id, DROP candidat_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, nom_role VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE roles');
        $this->addSql('ALTER TABLE `admin` ADD role_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `admin` ADD CONSTRAINT FK_880E0D76D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_880E0D76D60322AC ON `admin` (role_id)');
        $this->addSql('ALTER TABLE candidats ADD role_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE candidats ADD CONSTRAINT FK_3C663B15D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_3C663B15D60322AC ON candidats (role_id)');
        $this->addSql('ALTER TABLE electeur ADD role_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE electeur ADD CONSTRAINT FK_719667F0D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_719667F0D60322AC ON electeur (role_id)');
        $this->addSql('ALTER TABLE user ADD admins_id INT DEFAULT NULL, ADD candidat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6498D0EB82 FOREIGN KEY (candidat_id) REFERENCES candidats (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649FAA286C3 FOREIGN KEY (admins_id) REFERENCES `admin` (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_8D93D6498D0EB82 ON user (candidat_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649FAA286C3 ON user (admins_id)');
    }
}
