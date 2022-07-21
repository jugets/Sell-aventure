<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220721103137 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE journey_destination DROP FOREIGN KEY FK_9405101F816C6140');
        $this->addSql('DROP TABLE destination');
        $this->addSql('DROP TABLE journey_destination');
        $this->addSql('ALTER TABLE journey ADD regions LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', CHANGE country_id country_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE destination (id INT AUTO_INCREMENT NOT NULL, country_id INT NOT NULL, region VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_3EC63EAAF92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE journey_destination (journey_id INT NOT NULL, destination_id INT NOT NULL, INDEX IDX_9405101F816C6140 (destination_id), INDEX IDX_9405101FD5C9896F (journey_id), PRIMARY KEY(journey_id, destination_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE destination ADD CONSTRAINT FK_3EC63EAAF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE journey_destination ADD CONSTRAINT FK_9405101F816C6140 FOREIGN KEY (destination_id) REFERENCES destination (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE journey_destination ADD CONSTRAINT FK_9405101FD5C9896F FOREIGN KEY (journey_id) REFERENCES journey (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE journey DROP regions, CHANGE country_id country_id INT NOT NULL');
    }
}
