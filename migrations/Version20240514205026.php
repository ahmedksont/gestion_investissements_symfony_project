<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240514205026 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE convention DROP FOREIGN KEY FK_8556657EDCA7C833');
        $this->addSql('DROP INDEX IDX_8556657EDCA7C833 ON convention');
        $this->addSql('ALTER TABLE convention DROP mat_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE convention ADD mat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE convention ADD CONSTRAINT FK_8556657EDCA7C833 FOREIGN KEY (mat_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8556657EDCA7C833 ON convention (mat_id)');
    }
}
