<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180209214819 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD93645A92');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD93645A92 FOREIGN KEY (product_tax_group_id) REFERENCES product_tax_group (id)');
        $this->addSql('ALTER TABLE news CHANGE meta_decription meta_description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E09149959DC');
        $this->addSql('DROP INDEX IDX_81398E09149959DC ON customer');
        $this->addSql('ALTER TABLE customer CHANGE customer_tax_grup_id customer_tax_group_id INT NOT NULL');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E091018BBE0 FOREIGN KEY (customer_tax_group_id) REFERENCES customer_tax_group (id)');
        $this->addSql('CREATE INDEX IDX_81398E091018BBE0 ON customer (customer_tax_group_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E091018BBE0');
        $this->addSql('DROP INDEX IDX_81398E091018BBE0 ON customer');
        $this->addSql('ALTER TABLE customer CHANGE customer_tax_group_id customer_tax_grup_id INT NOT NULL');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09149959DC FOREIGN KEY (customer_tax_grup_id) REFERENCES customer_tax_group (id)');
        $this->addSql('CREATE INDEX IDX_81398E09149959DC ON customer (customer_tax_grup_id)');
        $this->addSql('ALTER TABLE news CHANGE meta_description meta_decription VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD93645A92');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD93645A92 FOREIGN KEY (product_tax_group_id) REFERENCES manufacturer (id)');
    }
}
