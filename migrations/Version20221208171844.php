<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221208171844 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chanson ADD genre_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE chanson ADD CONSTRAINT FK_A2E637C24296D31F FOREIGN KEY (genre_id) REFERENCES genre (id)');
        $this->addSql('CREATE INDEX IDX_A2E637C24296D31F ON chanson (genre_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chanson DROP FOREIGN KEY FK_A2E637C24296D31F');
        $this->addSql('DROP INDEX IDX_A2E637C24296D31F ON chanson');
        $this->addSql('ALTER TABLE chanson DROP genre_id');
    }
}
