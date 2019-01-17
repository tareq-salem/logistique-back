<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190117131714 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE offer ADD status_id INT NOT NULL, ADD offer_type_id INT NOT NULL, ADD contrat_type_id INT NOT NULL');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E6BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E64444A9A FOREIGN KEY (offer_type_id) REFERENCES offer_type (id)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E6C82DFE5 FOREIGN KEY (contrat_type_id) REFERENCES contract_type (id)');
        $this->addSql('CREATE INDEX IDX_29D6873E6BF700BD ON offer (status_id)');
        $this->addSql('CREATE INDEX IDX_29D6873E64444A9A ON offer (offer_type_id)');
        $this->addSql('CREATE INDEX IDX_29D6873E6C82DFE5 ON offer (contrat_type_id)');
        $this->addSql('ALTER TABLE country ADD created_at DATETIME NOT NULL, ADD modified_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE user ADD roles JSON NOT NULL, DROP created_at, DROP modified_at, CHANGE login login VARCHAR(180) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649AA08CB10 ON user (login)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE country DROP created_at, DROP modified_at');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E6BF700BD');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E64444A9A');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E6C82DFE5');
        $this->addSql('DROP INDEX IDX_29D6873E6BF700BD ON offer');
        $this->addSql('DROP INDEX IDX_29D6873E64444A9A ON offer');
        $this->addSql('DROP INDEX IDX_29D6873E6C82DFE5 ON offer');
        $this->addSql('ALTER TABLE offer DROP status_id, DROP offer_type_id, DROP contrat_type_id');
        $this->addSql('DROP INDEX UNIQ_8D93D649AA08CB10 ON user');
        $this->addSql('ALTER TABLE user ADD created_at DATETIME NOT NULL, ADD modified_at DATETIME NOT NULL, DROP roles, CHANGE login login VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
