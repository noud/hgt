<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180213131439 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product_category MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE product_category DROP FOREIGN KEY FK_CDFC73564584665A');
        $this->addSql('DROP INDEX IDX_CDFC73564584665A ON product_category');
        $this->addSql('ALTER TABLE product_category DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE product_category DROP id, CHANGE product_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC7356A76ED395 FOREIGN KEY (user_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_CDFC7356A76ED395 ON product_category (user_id)');
        $this->addSql('ALTER TABLE product_category ADD PRIMARY KEY (user_id, category_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product_category DROP FOREIGN KEY FK_CDFC7356A76ED395');
        $this->addSql('DROP INDEX IDX_CDFC7356A76ED395 ON product_category');
        $this->addSql('ALTER TABLE product_category DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE product_category ADD id INT AUTO_INCREMENT NOT NULL, CHANGE user_id product_id INT NOT NULL');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC73564584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_CDFC73564584665A ON product_category (product_id)');
        $this->addSql('ALTER TABLE product_category ADD PRIMARY KEY (id)');
    }
}
