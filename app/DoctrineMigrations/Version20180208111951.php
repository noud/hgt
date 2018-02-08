<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180208111951 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, created_date DATETIME NOT NULL, finished_date DATE DEFAULT NULL, delivery_date DATE DEFAULT NULL, state VARCHAR(255) NOT NULL, reference VARCHAR(255) DEFAULT NULL, note TEXT NOT NULL, total_ex_tax DOUBLE PRECISION DEFAULT NULL, total_inc_tax DOUBLE PRECISION DEFAULT NULL, ip_address VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart_product (id INT AUTO_INCREMENT NOT NULL, unit_price DOUBLE PRECISION NOT NULL, qty DOUBLE PRECISION NOT NULL, tax_percentage DOUBLE PRECISION NOT NULL, is_action TINYINT(1) DEFAULT \'0\' NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, navision_id VARCHAR(16) NOT NULL, name VARCHAR(255) NOT NULL, short_description TEXT NOT NULL, picture VARCHAR(255) NOT NULL, show_homepage TINYINT(1) DEFAULT \'0\' NOT NULL, priority INT DEFAULT 0 NOT NULL, description TEXT NOT NULL, url_key VARCHAR(255) NOT NULL, product_count INT DEFAULT 0 NOT NULL, total_product_count INT DEFAULT 0 NOT NULL, level INT DEFAULT 0 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, navision_id VARCHAR(16) NOT NULL, username VARCHAR(255) DEFAULT NULL, blocked TINYINT(1) DEFAULT \'0\' NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, company VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, show_prices TINYINT(1) DEFAULT \'0\' NOT NULL, password_token VARCHAR(255) DEFAULT NULL, delivery_days VARCHAR(255) NOT NULL COMMENT \'0 (for Sunday) through 6 (for Saturday)\', address1 VARCHAR(255) NOT NULL, address2 VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, fax VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, post_code VARCHAR(255) NOT NULL, shipping_first_name VARCHAR(255) NOT NULL, shipping_last_name VARCHAR(255) NOT NULL, shipping_company VARCHAR(255) NOT NULL, shipping_address1 VARCHAR(255) NOT NULL, shipping_address2 VARCHAR(255) NOT NULL, shipping_city VARCHAR(255) NOT NULL, shipping_post_code VARCHAR(255) NOT NULL, shipping_country VARCHAR(255) NOT NULL, shipping_phone VARCHAR(255) NOT NULL, shipping_fax VARCHAR(255) NOT NULL, shipping_email VARCHAR(255) NOT NULL, chamber_of_commerce_number VARCHAR(255) NOT NULL, merchant_notes TEXT NOT NULL, payment_terms VARCHAR(255) NOT NULL, navision_pricing_discount_id VARCHAR(255) NOT NULL, customer_vat_number VARCHAR(255) NOT NULL, is_buying_on_account TINYINT(1) DEFAULT \'0\' NOT NULL, allow_line_discount TINYINT(1) DEFAULT \'0\' NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer_discount_group (id INT AUTO_INCREMENT NOT NULL, navision_id VARCHAR(16) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer_group (id INT AUTO_INCREMENT NOT NULL, navision_id VARCHAR(16) NOT NULL COMMENT \'InvoiceDiscountGroup\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer_order (id INT AUTO_INCREMENT NOT NULL, order_number VARCHAR(255) NOT NULL, delivery_address VARCHAR(255) NOT NULL, delivery_city VARCHAR(255) NOT NULL, order_reference VARCHAR(255) NOT NULL, order_date DATE NOT NULL, delivery_date DATE DEFAULT NULL, total_product_count INT NOT NULL, total_price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer_order_line (id INT AUTO_INCREMENT NOT NULL, line_no VARCHAR(255) NOT NULL, line_type VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, brand VARCHAR(255) NOT NULL, volume VARCHAR(255) NOT NULL, qty DOUBLE PRECISION NOT NULL, unit_price DOUBLE PRECISION NOT NULL, is_action TINYINT(1) DEFAULT \'0\' NOT NULL, total_price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer_price_group (id INT AUTO_INCREMENT NOT NULL, navision_id VARCHAR(16) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer_product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, volume VARCHAR(255) NOT NULL, search_name VARCHAR(255) NOT NULL, priority INT NOT NULL, qty_per_unit_of_measure DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer_tax_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, navision_id VARCHAR(16) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE folder (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, url_key VARCHAR(255) NOT NULL, meta_title VARCHAR(255) NOT NULL, meta_keywords VARCHAR(255) NOT NULL, meta_description VARCHAR(255) NOT NULL, short_description TEXT NOT NULL, content MEDIUMTEXT NOT NULL, picture VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE folder_page (id INT AUTO_INCREMENT NOT NULL, folder_image VARCHAR(255) NOT NULL, priority INT DEFAULT 900 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE home_banner (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, banner_image VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, priority INT DEFAULT 900 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE home_slide (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, slide_image VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, priority INT DEFAULT 900 NOT NULL, date_from DATE NOT NULL, date_to DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invalid_delivery_date (id INT AUTO_INCREMENT NOT NULL, invalid_delivery_date DATE NOT NULL, note VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE manufacturer (id INT AUTO_INCREMENT NOT NULL, navision_brand VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, url_key VARCHAR(255) NOT NULL, total_product_count INT NOT NULL, picture VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, short_description TEXT NOT NULL, description TEXT NOT NULL, picture VARCHAR(255) NOT NULL, start_date DATE NOT NULL, url_key VARCHAR(255) NOT NULL, meta_title VARCHAR(255) NOT NULL, meta_keywords VARCHAR(255) NOT NULL, meta_decription VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, content MEDIUMTEXT NOT NULL, meta_title VARCHAR(255) NOT NULL, meta_keywords VARCHAR(255) NOT NULL, meta_description VARCHAR(255) NOT NULL, url_key VARCHAR(255) NOT NULL, short_title VARCHAR(255) NOT NULL, show_in_search TINYINT(1) DEFAULT \'0\' NOT NULL, sort INT DEFAULT 999 NOT NULL, show_in_menu TINYINT(1) DEFAULT \'0\' NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page_widget (id INT AUTO_INCREMENT NOT NULL, priority INT DEFAULT 900 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, navision_id VARCHAR(16) NOT NULL, name VARCHAR(255) NOT NULL, short_description TEXT NOT NULL, description TEXT NOT NULL, volume VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, enabled TINYINT(1) DEFAULT \'1\' NOT NULL, url_key VARCHAR(255) NOT NULL, is_order_product TINYINT(1) DEFAULT \'0\' NOT NULL, mail_order_to_supplier VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_category (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_picture (id INT AUTO_INCREMENT NOT NULL, navision_id VARCHAR(16) NOT NULL, filename VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_price (id INT AUTO_INCREMENT NOT NULL, navision_id VARCHAR(16) NOT NULL, start_date DATE NOT NULL, end_date DATE DEFAULT NULL, unit_price DOUBLE PRECISION NOT NULL, minimum_qty DOUBLE PRECISION NOT NULL, is_action_price TINYINT(1) DEFAULT \'0\' NOT NULL, price_type VARCHAR(255) NOT NULL, is_web_action TINYINT(1) DEFAULT \'0\' NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_tax_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, navision_id VARCHAR(16) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_unit_of_measure (id INT AUTO_INCREMENT NOT NULL, navision_id INT NOT NULL, qty_per_unit_of_measure DOUBLE PRECISION NOT NULL, selected TINYINT(1) DEFAULT \'0\' NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rewrite (id INT AUTO_INCREMENT NOT NULL, is_system TINYINT(1) DEFAULT \'0\' NOT NULL, id_path VARCHAR(255) NOT NULL, request_path VARCHAR(255) NOT NULL, target_path VARCHAR(255) NOT NULL, canonical_url VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE selection_code (id INT AUTO_INCREMENT NOT NULL, navision_id VARCHAR(16) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE static_block (id INT AUTO_INCREMENT NOT NULL, identifier VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, content MEDIUMTEXT NOT NULL, name VARCHAR(255) NOT NULL COMMENT \'internal use only\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tax (id INT AUTO_INCREMENT NOT NULL, percentage DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unit_of_measure (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, navision_id VARCHAR(16) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE web_order (id INT AUTO_INCREMENT NOT NULL, export_date DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE widget (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, partial VARCHAR(255) NOT NULL, partial_data TEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE cart_product');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE customer_discount_group');
        $this->addSql('DROP TABLE customer_group');
        $this->addSql('DROP TABLE customer_order');
        $this->addSql('DROP TABLE customer_order_line');
        $this->addSql('DROP TABLE customer_price_group');
        $this->addSql('DROP TABLE customer_product');
        $this->addSql('DROP TABLE customer_tax_group');
        $this->addSql('DROP TABLE folder');
        $this->addSql('DROP TABLE folder_page');
        $this->addSql('DROP TABLE home_banner');
        $this->addSql('DROP TABLE home_slide');
        $this->addSql('DROP TABLE invalid_delivery_date');
        $this->addSql('DROP TABLE manufacturer');
        $this->addSql('DROP TABLE news');
        $this->addSql('DROP TABLE page');
        $this->addSql('DROP TABLE page_type');
        $this->addSql('DROP TABLE page_widget');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_category');
        $this->addSql('DROP TABLE product_picture');
        $this->addSql('DROP TABLE product_price');
        $this->addSql('DROP TABLE product_tax_group');
        $this->addSql('DROP TABLE product_unit_of_measure');
        $this->addSql('DROP TABLE rewrite');
        $this->addSql('DROP TABLE selection_code');
        $this->addSql('DROP TABLE static_block');
        $this->addSql('DROP TABLE tax');
        $this->addSql('DROP TABLE unit_of_measure');
        $this->addSql('DROP TABLE web_order');
        $this->addSql('DROP TABLE widget');
    }
}
