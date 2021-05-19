<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210416162600 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE roles ADD admins_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE roles ADD CONSTRAINT FK_B63E2EC7FAA286C3 FOREIGN KEY (admins_id) REFERENCES `admin` (id)');
        $this->addSql('CREATE INDEX IDX_B63E2EC7FAA286C3 ON roles (admins_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE roles DROP FOREIGN KEY FK_B63E2EC7FAA286C3');
        $this->addSql('DROP INDEX IDX_B63E2EC7FAA286C3 ON roles');
        $this->addSql('ALTER TABLE roles DROP admins_id');
    }
}
