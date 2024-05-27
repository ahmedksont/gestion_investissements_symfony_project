<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240516182727 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE convention CHANGE mat_id mat_id INT NOT NULL');
        $this->addSql('ALTER TABLE projet ADD picture_url VARCHAR(255) DEFAULT NULL, DROP pictureUrl');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE convention CHANGE mat_id mat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE projet ADD pictureUrl VARCHAR(255) NOT NULL, DROP picture_url');
    }
}
