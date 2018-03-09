<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180309123131 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE page_widget DROP FOREIGN KEY FK_EA2FE8CEFBE885E2');
        $this->addSql('DROP TABLE page_widget');
        $this->addSql('DROP TABLE widget');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE page_widget (id INT AUTO_INCREMENT NOT NULL, page_id INT NOT NULL, widget_id INT NOT NULL, priority INT DEFAULT 900 NOT NULL, INDEX IDX_EA2FE8CEC4663E4 (page_id), INDEX IDX_EA2FE8CEFBE885E2 (widget_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE widget (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, partial VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, partial_data TEXT NOT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE page_widget ADD CONSTRAINT FK_EA2FE8CEC4663E4 FOREIGN KEY (page_id) REFERENCES page (id)');
        $this->addSql('ALTER TABLE page_widget ADD CONSTRAINT FK_EA2FE8CEFBE885E2 FOREIGN KEY (widget_id) REFERENCES widget (id)');
    }
}
