<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180403150150 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE customer_product DROP FOREIGN KEY FK_CF97A01333077A23');
        $this->addSql('DROP INDEX IDX_CF97A01333077A23 ON customer_product');
        $this->addSql('ALTER TABLE customer_product CHANGE unit_of_measure_id_id unit_of_measure_id INT NOT NULL');
        $this->addSql('ALTER TABLE customer_product ADD CONSTRAINT FK_CF97A013DA4E2C90 FOREIGN KEY (unit_of_measure_id) REFERENCES unit_of_measure (id)');
        $this->addSql('CREATE INDEX IDX_CF97A013DA4E2C90 ON customer_product (unit_of_measure_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE customer_product DROP FOREIGN KEY FK_CF97A013DA4E2C90');
        $this->addSql('DROP INDEX IDX_CF97A013DA4E2C90 ON customer_product');
        $this->addSql('ALTER TABLE customer_product CHANGE unit_of_measure_id unit_of_measure_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE customer_product ADD CONSTRAINT FK_CF97A01333077A23 FOREIGN KEY (unit_of_measure_id_id) REFERENCES unit_of_measure (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_CF97A01333077A23 ON customer_product (unit_of_measure_id_id)');
    }
}
