<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210413010506 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE role DROP FOREIGN KEY FK_57698A6AA76ED395');
        $this->addSql('DROP INDEX IDX_57698A6AA76ED395 ON role');
        $this->addSql('ALTER TABLE role DROP user_id');
        $this->addSql('ALTER TABLE user ADD admins_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649FAA286C3 FOREIGN KEY (admins_id) REFERENCES `admin` (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649FAA286C3 ON user (admins_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE role ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE role ADD CONSTRAINT FK_57698A6AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_57698A6AA76ED395 ON role (user_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649FAA286C3');
        $this->addSql('DROP INDEX IDX_8D93D649FAA286C3 ON user');
        $this->addSql('ALTER TABLE user DROP admins_id');
    }
}
