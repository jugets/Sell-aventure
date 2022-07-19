<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220719203419 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE destination (id INT AUTO_INCREMENT NOT NULL, country VARCHAR(80) NOT NULL, region VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE journey (id INT AUTO_INCREMENT NOT NULL, cyclist_id INT NOT NULL, duration INT NOT NULL, difficulty VARCHAR(25) NOT NULL, pictures LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_C816C6A27BFCCC26 (cyclist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE journey_destination (journey_id INT NOT NULL, destination_id INT NOT NULL, INDEX IDX_9405101FD5C9896F (journey_id), INDEX IDX_9405101F816C6140 (destination_id), PRIMARY KEY(journey_id, destination_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE step (id INT AUTO_INCREMENT NOT NULL, journey_id INT NOT NULL, start VARCHAR(255) NOT NULL, arrival VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_43B9FE3CD5C9896F (journey_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE journey ADD CONSTRAINT FK_C816C6A27BFCCC26 FOREIGN KEY (cyclist_id) REFERENCES cyclist (id)');
        $this->addSql('ALTER TABLE journey_destination ADD CONSTRAINT FK_9405101FD5C9896F FOREIGN KEY (journey_id) REFERENCES journey (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE journey_destination ADD CONSTRAINT FK_9405101F816C6140 FOREIGN KEY (destination_id) REFERENCES destination (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE step ADD CONSTRAINT FK_43B9FE3CD5C9896F FOREIGN KEY (journey_id) REFERENCES journey (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE journey_destination DROP FOREIGN KEY FK_9405101F816C6140');
        $this->addSql('ALTER TABLE journey_destination DROP FOREIGN KEY FK_9405101FD5C9896F');
        $this->addSql('ALTER TABLE step DROP FOREIGN KEY FK_43B9FE3CD5C9896F');
        $this->addSql('DROP TABLE destination');
        $this->addSql('DROP TABLE journey');
        $this->addSql('DROP TABLE journey_destination');
        $this->addSql('DROP TABLE step');
    }
}
