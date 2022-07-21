<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220721094940 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cyclist (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, city VARCHAR(255) DEFAULT NULL, birthdate DATE DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_B001FF96F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE destination (id INT AUTO_INCREMENT NOT NULL, country_id INT NOT NULL, region VARCHAR(255) NOT NULL, INDEX IDX_3EC63EAAF92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE journey (id INT AUTO_INCREMENT NOT NULL, cyclist_id INT DEFAULT NULL, country_id INT NOT NULL, duration INT NOT NULL, difficulty VARCHAR(25) NOT NULL, pictures LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', name VARCHAR(255) NOT NULL, INDEX IDX_C816C6A27BFCCC26 (cyclist_id), INDEX IDX_C816C6A2F92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE journey_destination (journey_id INT NOT NULL, destination_id INT NOT NULL, INDEX IDX_9405101FD5C9896F (journey_id), INDEX IDX_9405101F816C6140 (destination_id), PRIMARY KEY(journey_id, destination_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE step (id INT AUTO_INCREMENT NOT NULL, journey_id INT NOT NULL, start VARCHAR(255) NOT NULL, arrival VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_43B9FE3CD5C9896F (journey_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE destination ADD CONSTRAINT FK_3EC63EAAF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE journey ADD CONSTRAINT FK_C816C6A27BFCCC26 FOREIGN KEY (cyclist_id) REFERENCES cyclist (id)');
        $this->addSql('ALTER TABLE journey ADD CONSTRAINT FK_C816C6A2F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE journey_destination ADD CONSTRAINT FK_9405101FD5C9896F FOREIGN KEY (journey_id) REFERENCES journey (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE journey_destination ADD CONSTRAINT FK_9405101F816C6140 FOREIGN KEY (destination_id) REFERENCES destination (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE step ADD CONSTRAINT FK_43B9FE3CD5C9896F FOREIGN KEY (journey_id) REFERENCES journey (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE destination DROP FOREIGN KEY FK_3EC63EAAF92F3E70');
        $this->addSql('ALTER TABLE journey DROP FOREIGN KEY FK_C816C6A2F92F3E70');
        $this->addSql('ALTER TABLE journey DROP FOREIGN KEY FK_C816C6A27BFCCC26');
        $this->addSql('ALTER TABLE journey_destination DROP FOREIGN KEY FK_9405101F816C6140');
        $this->addSql('ALTER TABLE journey_destination DROP FOREIGN KEY FK_9405101FD5C9896F');
        $this->addSql('ALTER TABLE step DROP FOREIGN KEY FK_43B9FE3CD5C9896F');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE cyclist');
        $this->addSql('DROP TABLE destination');
        $this->addSql('DROP TABLE journey');
        $this->addSql('DROP TABLE journey_destination');
        $this->addSql('DROP TABLE step');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
