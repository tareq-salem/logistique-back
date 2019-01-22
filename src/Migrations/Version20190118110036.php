<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190118110036 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE location_offer (id INT AUTO_INCREMENT NOT NULL, location_id INT NOT NULL, offer_id INT NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_5F8AC21B64D218E (location_id), INDEX IDX_5F8AC21B53C674EE (offer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE location_offer ADD CONSTRAINT FK_5F8AC21B64D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE location_offer ADD CONSTRAINT FK_5F8AC21B53C674EE FOREIGN KEY (offer_id) REFERENCES offer (id)');
        $this->addSql('ALTER TABLE candidature ADD location_offer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE candidature ADD CONSTRAINT FK_E33BD3B88293560C FOREIGN KEY (location_offer_id) REFERENCES location_offer (id)');
        $this->addSql('CREATE INDEX IDX_E33BD3B88293560C ON candidature (location_offer_id)');
        $this->addSql('ALTER TABLE country ADD created_at DATETIME NOT NULL, ADD modified_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE offer ADD created_at DATETIME NOT NULL, ADD modified_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE user ADD roles JSON NOT NULL, DROP created_at, DROP modified_at, CHANGE login login VARCHAR(180) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649AA08CB10 ON user (login)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE candidature DROP FOREIGN KEY FK_E33BD3B88293560C');
        $this->addSql('DROP TABLE location_offer');
        $this->addSql('DROP INDEX IDX_E33BD3B88293560C ON candidature');
        $this->addSql('ALTER TABLE candidature DROP location_offer_id');
        $this->addSql('ALTER TABLE country DROP created_at, DROP modified_at');
        $this->addSql('ALTER TABLE offer DROP created_at, DROP modified_at');
        $this->addSql('DROP INDEX UNIQ_8D93D649AA08CB10 ON user');
        $this->addSql('ALTER TABLE user ADD created_at DATETIME NOT NULL, ADD modified_at DATETIME NOT NULL, DROP roles, CHANGE login login VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
