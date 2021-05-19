<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210422040932 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidats DROP FOREIGN KEY FK_3C663B15D60322AC');
        $this->addSql('DROP INDEX IDX_3C663B15D60322AC ON candidats');
        $this->addSql('ALTER TABLE candidats DROP role_id');
        $this->addSql('ALTER TABLE electeur DROP FOREIGN KEY FK_719667F0D60322AC');
        $this->addSql('DROP INDEX IDX_719667F0D60322AC ON electeur');
        $this->addSql('ALTER TABLE electeur DROP role_id');
        $this->addSql('ALTER TABLE roles DROP FOREIGN KEY FK_B63E2EC7A76ED395');
        $this->addSql('ALTER TABLE roles DROP FOREIGN KEY FK_B63E2EC7FAA286C3');
        $this->addSql('DROP INDEX IDX_B63E2EC7A76ED395 ON roles');
        $this->addSql('DROP INDEX IDX_B63E2EC7FAA286C3 ON roles');
        $this->addSql('ALTER TABLE roles DROP admins_id, DROP user_id');
        $this->addSql('ALTER TABLE user ADD admins_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649FAA286C3 FOREIGN KEY (admins_id) REFERENCES `admin` (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649FAA286C3 ON user (admins_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidats ADD role_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE candidats ADD CONSTRAINT FK_3C663B15D60322AC FOREIGN KEY (role_id) REFERENCES roles (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_3C663B15D60322AC ON candidats (role_id)');
        $this->addSql('ALTER TABLE electeur ADD role_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE electeur ADD CONSTRAINT FK_719667F0D60322AC FOREIGN KEY (role_id) REFERENCES roles (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_719667F0D60322AC ON electeur (role_id)');
        $this->addSql('ALTER TABLE roles ADD admins_id INT DEFAULT NULL, ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE roles ADD CONSTRAINT FK_B63E2EC7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE roles ADD CONSTRAINT FK_B63E2EC7FAA286C3 FOREIGN KEY (admins_id) REFERENCES `admin` (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_B63E2EC7A76ED395 ON roles (user_id)');
        $this->addSql('CREATE INDEX IDX_B63E2EC7FAA286C3 ON roles (admins_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649FAA286C3');
        $this->addSql('DROP INDEX IDX_8D93D649FAA286C3 ON user');
        $this->addSql('ALTER TABLE user DROP admins_id');
    }
}
