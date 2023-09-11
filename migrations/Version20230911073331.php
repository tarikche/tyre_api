<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230911073331 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tyre ADD order_line_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tyre ADD CONSTRAINT FK_BEE835ABBB01DC09 FOREIGN KEY (order_line_id) REFERENCES order_line (id)');
        $this->addSql('CREATE INDEX IDX_BEE835ABBB01DC09 ON tyre (order_line_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tyre DROP FOREIGN KEY FK_BEE835ABBB01DC09');
        $this->addSql('DROP INDEX IDX_BEE835ABBB01DC09 ON tyre');
        $this->addSql('ALTER TABLE tyre DROP order_line_id');
    }
}
