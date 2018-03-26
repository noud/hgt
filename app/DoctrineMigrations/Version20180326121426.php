<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180326121426 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE failed_attempts DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE failed_attempts CHANGE username ip_address VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE failed_attempts ADD PRIMARY KEY (ip_address)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE failed_attempts DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE failed_attempts CHANGE ip_address username VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE failed_attempts ADD PRIMARY KEY (username)');
    }
}
