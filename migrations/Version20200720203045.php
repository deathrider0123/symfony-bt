<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200720203045 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, language_id INT DEFAULT NULL, name VARCHAR(32) NOT NULL, INDEX IDX_64C19C182F1BAF4 (language_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(2) NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, quantity INT NOT NULL, model VARCHAR(191) DEFAULT NULL, image LONGTEXT DEFAULT NULL, price NUMERIC(15, 0) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, date_available DATETIME DEFAULT NULL, weight VARCHAR(191) NOT NULL, weight_unit VARCHAR(191) DEFAULT NULL, status TINYINT(1) NOT NULL, is_current TINYINT(1) NOT NULL, tax_class INT NOT NULL, manufacturer INT DEFAULT NULL, ordered INT NOT NULL, liked INT NOT NULL, low_limit INT NOT NULL, is_feature TINYINT(1) NOT NULL, slug VARCHAR(191) NOT NULL, type INT NOT NULL, min_order INT NOT NULL, max_stock INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_category (product_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_CDFC73564584665A (product_id), INDEX IDX_CDFC735612469DE2 (category_id), PRIMARY KEY(product_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, customer INT DEFAULT NULL, customer_name VARCHAR(191) DEFAULT NULL, rating INT DEFAULT NULL, status TINYINT(1) NOT NULL, review_read INT NOT NULL, vendor INT DEFAULT NULL, text LONGTEXT NOT NULL, INDEX IDX_794381C64584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review_details (id INT AUTO_INCREMENT NOT NULL, review_id INT NOT NULL, language_id INT NOT NULL, text LONGTEXT NOT NULL, INDEX IDX_E9C8BF7D3E2E969B (review_id), INDEX IDX_E9C8BF7D82F1BAF4 (language_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C182F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC73564584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC735612469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C64584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE review_details ADD CONSTRAINT FK_E9C8BF7D3E2E969B FOREIGN KEY (review_id) REFERENCES review (id)');
        $this->addSql('ALTER TABLE review_details ADD CONSTRAINT FK_E9C8BF7D82F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_category DROP FOREIGN KEY FK_CDFC735612469DE2');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C182F1BAF4');
        $this->addSql('ALTER TABLE review_details DROP FOREIGN KEY FK_E9C8BF7D82F1BAF4');
        $this->addSql('ALTER TABLE product_category DROP FOREIGN KEY FK_CDFC73564584665A');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C64584665A');
        $this->addSql('ALTER TABLE review_details DROP FOREIGN KEY FK_E9C8BF7D3E2E969B');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE language');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_category');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE review_details');
    }
}
