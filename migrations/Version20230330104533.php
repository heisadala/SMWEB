<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230330104533 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX `primary` ON lego_table');
        $this->addSql('ALTER TABLE lego_table CHANGE Price price NUMERIC(5, 2) DEFAULT NULL, CHANGE Ref reference INT NOT NULL');
        $this->addSql('ALTER TABLE lego_table ADD PRIMARY KEY (reference)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX `PRIMARY` ON lego_table');
        $this->addSql('ALTER TABLE lego_table CHANGE price Price NUMERIC(6, 2) DEFAULT NULL, CHANGE reference Ref INT NOT NULL');
        $this->addSql('ALTER TABLE lego_table ADD PRIMARY KEY (Ref)');
    }
}
