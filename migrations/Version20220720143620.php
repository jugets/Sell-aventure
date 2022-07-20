<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220720143620 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cyclist ADD roles JSON NOT NULL, CHANGE username username VARCHAR(180) NOT NULL, CHANGE email email VARCHAR(255) NOT NULL, CHANGE password password VARCHAR(255) NOT NULL, CHANGE country country VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B001FF96F85E0677 ON cyclist (username)');
        $this->addSql('ALTER TABLE journey CHANGE cyclist_id cyclist_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_B001FF96F85E0677 ON cyclist');
        $this->addSql('ALTER TABLE cyclist DROP roles, CHANGE username username VARCHAR(80) NOT NULL, CHANGE password password VARCHAR(80) NOT NULL, CHANGE email email VARCHAR(80) NOT NULL, CHANGE country country VARCHAR(80) NOT NULL');
        $this->addSql('ALTER TABLE journey CHANGE cyclist_id cyclist_id INT NOT NULL');
    }
}
