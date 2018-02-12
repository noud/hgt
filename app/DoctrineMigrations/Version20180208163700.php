<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180208163700 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cart ADD customer_id INT NOT NULL');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B79395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_BA388B79395C3F3 ON cart (customer_id)');
        $this->addSql('ALTER TABLE cart_product ADD cart_id INT NOT NULL, ADD product_id INT NOT NULL, ADD unit_of_measure_id INT NOT NULL');
        $this->addSql('ALTER TABLE cart_product ADD CONSTRAINT FK_2890CCAA1AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cart_product ADD CONSTRAINT FK_2890CCAA4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cart_product ADD CONSTRAINT FK_2890CCAADA4E2C90 FOREIGN KEY (unit_of_measure_id) REFERENCES unit_of_measure (id)');
        $this->addSql('CREATE INDEX IDX_2890CCAA1AD5CDBF ON cart_product (cart_id)');
        $this->addSql('CREATE INDEX IDX_2890CCAA4584665A ON cart_product (product_id)');
        $this->addSql('CREATE INDEX IDX_2890CCAADA4E2C90 ON cart_product (unit_of_measure_id)');
        $this->addSql('ALTER TABLE category ADD parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1727ACA70 FOREIGN KEY (parent_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_64C19C1727ACA70 ON category (parent_id)');
        $this->addSql('ALTER TABLE customer ADD customer_price_group_id INT DEFAULT NULL, ADD customer_group_id INT DEFAULT NULL, ADD customer_tax_grup_id INT NOT NULL, ADD customer_discount_group_id INT DEFAULT NULL, ADD selection_code_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E0958FD69A FOREIGN KEY (customer_price_group_id) REFERENCES customer_price_group (id)');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09D2919A68 FOREIGN KEY (customer_group_id) REFERENCES customer_group (id)');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09149959DC FOREIGN KEY (customer_tax_grup_id) REFERENCES customer_tax_group (id)');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E0980430CC5 FOREIGN KEY (customer_discount_group_id) REFERENCES customer_discount_group (id)');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E098F7D58F6 FOREIGN KEY (selection_code_id) REFERENCES selection_code (id)');
        $this->addSql('CREATE INDEX IDX_81398E0958FD69A ON customer (customer_price_group_id)');
        $this->addSql('CREATE INDEX IDX_81398E09D2919A68 ON customer (customer_group_id)');
        $this->addSql('CREATE INDEX IDX_81398E09149959DC ON customer (customer_tax_grup_id)');
        $this->addSql('CREATE INDEX IDX_81398E0980430CC5 ON customer (customer_discount_group_id)');
        $this->addSql('CREATE INDEX IDX_81398E098F7D58F6 ON customer (selection_code_id)');
        $this->addSql('ALTER TABLE customer_order ADD customer_group_id INT NOT NULL');
        $this->addSql('ALTER TABLE customer_order ADD CONSTRAINT FK_3B1CE6A3D2919A68 FOREIGN KEY (customer_group_id) REFERENCES customer_group (id)');
        $this->addSql('CREATE INDEX IDX_3B1CE6A3D2919A68 ON customer_order (customer_group_id)');
        $this->addSql('ALTER TABLE customer_order_line ADD customer_order_id INT NOT NULL, ADD product_id INT DEFAULT NULL, ADD unit_of_measure_id INT NOT NULL');
        $this->addSql('ALTER TABLE customer_order_line ADD CONSTRAINT FK_612C8A63A15A2E17 FOREIGN KEY (customer_order_id) REFERENCES customer_order (id)');
        $this->addSql('ALTER TABLE customer_order_line ADD CONSTRAINT FK_612C8A634584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE customer_order_line ADD CONSTRAINT FK_612C8A63DA4E2C90 FOREIGN KEY (unit_of_measure_id) REFERENCES unit_of_measure (id)');
        $this->addSql('CREATE INDEX IDX_612C8A63A15A2E17 ON customer_order_line (customer_order_id)');
        $this->addSql('CREATE INDEX IDX_612C8A634584665A ON customer_order_line (product_id)');
        $this->addSql('CREATE INDEX IDX_612C8A63DA4E2C90 ON customer_order_line (unit_of_measure_id)');
        $this->addSql('ALTER TABLE customer_product ADD customer_group_id INT NOT NULL, ADD product_id INT NOT NULL, ADD unit_of_measure_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE customer_product ADD CONSTRAINT FK_CF97A013D2919A68 FOREIGN KEY (customer_group_id) REFERENCES customer_group (id)');
        $this->addSql('ALTER TABLE customer_product ADD CONSTRAINT FK_CF97A0134584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE customer_product ADD CONSTRAINT FK_CF97A01333077A23 FOREIGN KEY (unit_of_measure_id_id) REFERENCES unit_of_measure (id)');
        $this->addSql('CREATE INDEX IDX_CF97A013D2919A68 ON customer_product (customer_group_id)');
        $this->addSql('CREATE INDEX IDX_CF97A0134584665A ON customer_product (product_id)');
        $this->addSql('CREATE INDEX IDX_CF97A01333077A23 ON customer_product (unit_of_measure_id_id)');
        $this->addSql('ALTER TABLE folder_page ADD folder_id INT NOT NULL');
        $this->addSql('ALTER TABLE folder_page ADD CONSTRAINT FK_D959035162CB942 FOREIGN KEY (folder_id) REFERENCES folder (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_D959035162CB942 ON folder_page (folder_id)');
        $this->addSql('ALTER TABLE page ADD parent_id INT DEFAULT NULL, ADD page_type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB620727ACA70 FOREIGN KEY (parent_id) REFERENCES page (id)');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB6203F2C6706 FOREIGN KEY (page_type_id) REFERENCES page_type (id)');
        $this->addSql('CREATE INDEX IDX_140AB620727ACA70 ON page (parent_id)');
        $this->addSql('CREATE INDEX IDX_140AB6203F2C6706 ON page (page_type_id)');
        $this->addSql('ALTER TABLE page_widget ADD page_id INT NOT NULL, ADD widget_id INT NOT NULL');
        $this->addSql('ALTER TABLE page_widget ADD CONSTRAINT FK_EA2FE8CEC4663E4 FOREIGN KEY (page_id) REFERENCES page (id)');
        $this->addSql('ALTER TABLE page_widget ADD CONSTRAINT FK_EA2FE8CEFBE885E2 FOREIGN KEY (widget_id) REFERENCES widget (id)');
        $this->addSql('CREATE INDEX IDX_EA2FE8CEC4663E4 ON page_widget (page_id)');
        $this->addSql('CREATE INDEX IDX_EA2FE8CEFBE885E2 ON page_widget (widget_id)');
        $this->addSql('ALTER TABLE product ADD manufacturer_id INT DEFAULT NULL, ADD main_picture_id INT DEFAULT NULL, ADD product_tax_group_id INT NOT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADA23B42D FOREIGN KEY (manufacturer_id) REFERENCES manufacturer (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADD6BDC9DC FOREIGN KEY (main_picture_id) REFERENCES product_picture (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD93645A92 FOREIGN KEY (product_tax_group_id) REFERENCES manufacturer (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADA23B42D ON product (manufacturer_id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADD6BDC9DC ON product (main_picture_id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD93645A92 ON product (product_tax_group_id)');
        $this->addSql('ALTER TABLE product_category ADD product_id INT NOT NULL, ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC73564584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC735612469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_CDFC73564584665A ON product_category (product_id)');
        $this->addSql('CREATE INDEX IDX_CDFC735612469DE2 ON product_category (category_id)');
        $this->addSql('ALTER TABLE product_picture ADD product_id INT NOT NULL');
        $this->addSql('ALTER TABLE product_picture ADD CONSTRAINT FK_C70254394584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_C70254394584665A ON product_picture (product_id)');
        $this->addSql('ALTER TABLE product_price ADD product_id INT NOT NULL, ADD customer_price_group_id INT DEFAULT NULL, ADD customer_group_id INT DEFAULT NULL, ADD unit_of_measure_id INT DEFAULT NULL, ADD selection_code_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product_price ADD CONSTRAINT FK_6B9459854584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_price ADD CONSTRAINT FK_6B94598558FD69A FOREIGN KEY (customer_price_group_id) REFERENCES customer_price_group (id)');
        $this->addSql('ALTER TABLE product_price ADD CONSTRAINT FK_6B945985D2919A68 FOREIGN KEY (customer_group_id) REFERENCES customer_group (id)');
        $this->addSql('ALTER TABLE product_price ADD CONSTRAINT FK_6B945985DA4E2C90 FOREIGN KEY (unit_of_measure_id) REFERENCES unit_of_measure (id)');
        $this->addSql('ALTER TABLE product_price ADD CONSTRAINT FK_6B9459858F7D58F6 FOREIGN KEY (selection_code_id) REFERENCES selection_code (id)');
        $this->addSql('CREATE INDEX IDX_6B9459854584665A ON product_price (product_id)');
        $this->addSql('CREATE INDEX IDX_6B94598558FD69A ON product_price (customer_price_group_id)');
        $this->addSql('CREATE INDEX IDX_6B945985D2919A68 ON product_price (customer_group_id)');
        $this->addSql('CREATE INDEX IDX_6B945985DA4E2C90 ON product_price (unit_of_measure_id)');
        $this->addSql('CREATE INDEX IDX_6B9459858F7D58F6 ON product_price (selection_code_id)');
        $this->addSql('ALTER TABLE product_unit_of_measure ADD product_id INT NOT NULL, ADD unit_of_measure_id INT NOT NULL');
        $this->addSql('ALTER TABLE product_unit_of_measure ADD CONSTRAINT FK_4C517BC94584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_unit_of_measure ADD CONSTRAINT FK_4C517BC9DA4E2C90 FOREIGN KEY (unit_of_measure_id) REFERENCES unit_of_measure (id)');
        $this->addSql('CREATE INDEX IDX_4C517BC94584665A ON product_unit_of_measure (product_id)');
        $this->addSql('CREATE INDEX IDX_4C517BC9DA4E2C90 ON product_unit_of_measure (unit_of_measure_id)');
        $this->addSql('ALTER TABLE rewrite ADD page_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rewrite ADD CONSTRAINT FK_5EB0DD7C4663E4 FOREIGN KEY (page_id) REFERENCES page (id)');
        $this->addSql('CREATE INDEX IDX_5EB0DD7C4663E4 ON rewrite (page_id)');
        $this->addSql('ALTER TABLE tax ADD product_tax_group_id INT NOT NULL, ADD customer_tax_group_id INT NOT NULL');
        $this->addSql('ALTER TABLE tax ADD CONSTRAINT FK_8E81BA7693645A92 FOREIGN KEY (product_tax_group_id) REFERENCES product_tax_group (id)');
        $this->addSql('ALTER TABLE tax ADD CONSTRAINT FK_8E81BA761018BBE0 FOREIGN KEY (customer_tax_group_id) REFERENCES customer_tax_group (id)');
        $this->addSql('CREATE INDEX IDX_8E81BA7693645A92 ON tax (product_tax_group_id)');
        $this->addSql('CREATE INDEX IDX_8E81BA761018BBE0 ON tax (customer_tax_group_id)');
        $this->addSql('ALTER TABLE web_order ADD cart_id INT NOT NULL');
        $this->addSql('ALTER TABLE web_order ADD CONSTRAINT FK_383A97061AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_383A97061AD5CDBF ON web_order (cart_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B79395C3F3');
        $this->addSql('DROP INDEX IDX_BA388B79395C3F3 ON cart');
        $this->addSql('ALTER TABLE cart DROP customer_id');
        $this->addSql('ALTER TABLE cart_product DROP FOREIGN KEY FK_2890CCAA1AD5CDBF');
        $this->addSql('ALTER TABLE cart_product DROP FOREIGN KEY FK_2890CCAA4584665A');
        $this->addSql('ALTER TABLE cart_product DROP FOREIGN KEY FK_2890CCAADA4E2C90');
        $this->addSql('DROP INDEX IDX_2890CCAA1AD5CDBF ON cart_product');
        $this->addSql('DROP INDEX IDX_2890CCAA4584665A ON cart_product');
        $this->addSql('DROP INDEX IDX_2890CCAADA4E2C90 ON cart_product');
        $this->addSql('ALTER TABLE cart_product DROP cart_id, DROP product_id, DROP unit_of_measure_id');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1727ACA70');
        $this->addSql('DROP INDEX IDX_64C19C1727ACA70 ON category');
        $this->addSql('ALTER TABLE category DROP parent_id');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E0958FD69A');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E09D2919A68');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E09149959DC');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E0980430CC5');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E098F7D58F6');
        $this->addSql('DROP INDEX IDX_81398E0958FD69A ON customer');
        $this->addSql('DROP INDEX IDX_81398E09D2919A68 ON customer');
        $this->addSql('DROP INDEX IDX_81398E09149959DC ON customer');
        $this->addSql('DROP INDEX IDX_81398E0980430CC5 ON customer');
        $this->addSql('DROP INDEX IDX_81398E098F7D58F6 ON customer');
        $this->addSql('ALTER TABLE customer DROP customer_price_group_id, DROP customer_group_id, DROP customer_tax_grup_id, DROP customer_discount_group_id, DROP selection_code_id');
        $this->addSql('ALTER TABLE customer_order DROP FOREIGN KEY FK_3B1CE6A3D2919A68');
        $this->addSql('DROP INDEX IDX_3B1CE6A3D2919A68 ON customer_order');
        $this->addSql('ALTER TABLE customer_order DROP customer_group_id');
        $this->addSql('ALTER TABLE customer_order_line DROP FOREIGN KEY FK_612C8A63A15A2E17');
        $this->addSql('ALTER TABLE customer_order_line DROP FOREIGN KEY FK_612C8A634584665A');
        $this->addSql('ALTER TABLE customer_order_line DROP FOREIGN KEY FK_612C8A63DA4E2C90');
        $this->addSql('DROP INDEX IDX_612C8A63A15A2E17 ON customer_order_line');
        $this->addSql('DROP INDEX IDX_612C8A634584665A ON customer_order_line');
        $this->addSql('DROP INDEX IDX_612C8A63DA4E2C90 ON customer_order_line');
        $this->addSql('ALTER TABLE customer_order_line DROP customer_order_id, DROP product_id, DROP unit_of_measure_id');
        $this->addSql('ALTER TABLE customer_product DROP FOREIGN KEY FK_CF97A013D2919A68');
        $this->addSql('ALTER TABLE customer_product DROP FOREIGN KEY FK_CF97A0134584665A');
        $this->addSql('ALTER TABLE customer_product DROP FOREIGN KEY FK_CF97A01333077A23');
        $this->addSql('DROP INDEX IDX_CF97A013D2919A68 ON customer_product');
        $this->addSql('DROP INDEX IDX_CF97A0134584665A ON customer_product');
        $this->addSql('DROP INDEX IDX_CF97A01333077A23 ON customer_product');
        $this->addSql('ALTER TABLE customer_product DROP customer_group_id, DROP product_id, DROP unit_of_measure_id_id');
        $this->addSql('ALTER TABLE folder_page DROP FOREIGN KEY FK_D959035162CB942');
        $this->addSql('DROP INDEX IDX_D959035162CB942 ON folder_page');
        $this->addSql('ALTER TABLE folder_page DROP folder_id');
        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB620727ACA70');
        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB6203F2C6706');
        $this->addSql('DROP INDEX IDX_140AB620727ACA70 ON page');
        $this->addSql('DROP INDEX IDX_140AB6203F2C6706 ON page');
        $this->addSql('ALTER TABLE page DROP parent_id, DROP page_type_id');
        $this->addSql('ALTER TABLE page_widget DROP FOREIGN KEY FK_EA2FE8CEC4663E4');
        $this->addSql('ALTER TABLE page_widget DROP FOREIGN KEY FK_EA2FE8CEFBE885E2');
        $this->addSql('DROP INDEX IDX_EA2FE8CEC4663E4 ON page_widget');
        $this->addSql('DROP INDEX IDX_EA2FE8CEFBE885E2 ON page_widget');
        $this->addSql('ALTER TABLE page_widget DROP page_id, DROP widget_id');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADA23B42D');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADD6BDC9DC');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD93645A92');
        $this->addSql('DROP INDEX IDX_D34A04ADA23B42D ON product');
        $this->addSql('DROP INDEX IDX_D34A04ADD6BDC9DC ON product');
        $this->addSql('DROP INDEX IDX_D34A04AD93645A92 ON product');
        $this->addSql('ALTER TABLE product DROP manufacturer_id, DROP main_picture_id, DROP product_tax_group_id');
        $this->addSql('ALTER TABLE product_category DROP FOREIGN KEY FK_CDFC73564584665A');
        $this->addSql('ALTER TABLE product_category DROP FOREIGN KEY FK_CDFC735612469DE2');
        $this->addSql('DROP INDEX IDX_CDFC73564584665A ON product_category');
        $this->addSql('DROP INDEX IDX_CDFC735612469DE2 ON product_category');
        $this->addSql('ALTER TABLE product_category DROP product_id, DROP category_id');
        $this->addSql('ALTER TABLE product_picture DROP FOREIGN KEY FK_C70254394584665A');
        $this->addSql('DROP INDEX IDX_C70254394584665A ON product_picture');
        $this->addSql('ALTER TABLE product_picture DROP product_id');
        $this->addSql('ALTER TABLE product_price DROP FOREIGN KEY FK_6B9459854584665A');
        $this->addSql('ALTER TABLE product_price DROP FOREIGN KEY FK_6B94598558FD69A');
        $this->addSql('ALTER TABLE product_price DROP FOREIGN KEY FK_6B945985D2919A68');
        $this->addSql('ALTER TABLE product_price DROP FOREIGN KEY FK_6B945985DA4E2C90');
        $this->addSql('ALTER TABLE product_price DROP FOREIGN KEY FK_6B9459858F7D58F6');
        $this->addSql('DROP INDEX IDX_6B9459854584665A ON product_price');
        $this->addSql('DROP INDEX IDX_6B94598558FD69A ON product_price');
        $this->addSql('DROP INDEX IDX_6B945985D2919A68 ON product_price');
        $this->addSql('DROP INDEX IDX_6B945985DA4E2C90 ON product_price');
        $this->addSql('DROP INDEX IDX_6B9459858F7D58F6 ON product_price');
        $this->addSql('ALTER TABLE product_price DROP product_id, DROP customer_price_group_id, DROP customer_group_id, DROP unit_of_measure_id, DROP selection_code_id');
        $this->addSql('ALTER TABLE product_unit_of_measure DROP FOREIGN KEY FK_4C517BC94584665A');
        $this->addSql('ALTER TABLE product_unit_of_measure DROP FOREIGN KEY FK_4C517BC9DA4E2C90');
        $this->addSql('DROP INDEX IDX_4C517BC94584665A ON product_unit_of_measure');
        $this->addSql('DROP INDEX IDX_4C517BC9DA4E2C90 ON product_unit_of_measure');
        $this->addSql('ALTER TABLE product_unit_of_measure DROP product_id, DROP unit_of_measure_id');
        $this->addSql('ALTER TABLE rewrite DROP FOREIGN KEY FK_5EB0DD7C4663E4');
        $this->addSql('DROP INDEX IDX_5EB0DD7C4663E4 ON rewrite');
        $this->addSql('ALTER TABLE rewrite DROP page_id');
        $this->addSql('ALTER TABLE tax DROP FOREIGN KEY FK_8E81BA7693645A92');
        $this->addSql('ALTER TABLE tax DROP FOREIGN KEY FK_8E81BA761018BBE0');
        $this->addSql('DROP INDEX IDX_8E81BA7693645A92 ON tax');
        $this->addSql('DROP INDEX IDX_8E81BA761018BBE0 ON tax');
        $this->addSql('ALTER TABLE tax DROP product_tax_group_id, DROP customer_tax_group_id');
        $this->addSql('ALTER TABLE web_order DROP FOREIGN KEY FK_383A97061AD5CDBF');
        $this->addSql('DROP INDEX IDX_383A97061AD5CDBF ON web_order');
        $this->addSql('ALTER TABLE web_order DROP cart_id');
    }
}
