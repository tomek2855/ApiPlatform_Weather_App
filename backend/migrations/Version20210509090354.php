<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210509090354 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE weather_record (id INT AUTO_INCREMENT NOT NULL, city_id INT NOT NULL, created_at DATETIME NOT NULL, temp DOUBLE PRECISION NOT NULL, temp_feels_like DOUBLE PRECISION NOT NULL, preesure INT NOT NULL, humidity INT NOT NULL, visibility INT NOT NULL, wind_speed DOUBLE PRECISION NOT NULL, wind_deg INT NOT NULL, INDEX IDX_7513B9F78BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE weather_record ADD CONSTRAINT FK_7513B9F78BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE weather_record');
    }
}
