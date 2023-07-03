<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230703092926 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE delivery (id INT AUTO_INCREMENT NOT NULL, shipping_address VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, discription VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, supplier_id INT NOT NULL, tyre_id INT NOT NULL, quantity INT NOT NULL, INDEX IDX_4B3656602ADD6D8C (supplier_id), INDEX IDX_4B365660BF8CDFF3 (tyre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B3656602ADD6D8C FOREIGN KEY (supplier_id) REFERENCES supplier (id)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660BF8CDFF3 FOREIGN KEY (tyre_id) REFERENCES tyre (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B3656602ADD6D8C');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B365660BF8CDFF3');
        $this->addSql('DROP TABLE delivery');
        $this->addSql('DROP TABLE stock');
    }
}
