<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210910084930 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mission_target (mission_id INT NOT NULL, target_id INT NOT NULL, INDEX IDX_1E97F5B2BE6CAE90 (mission_id), INDEX IDX_1E97F5B2158E0B66 (target_id), PRIMARY KEY(mission_id, target_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mission_target ADD CONSTRAINT FK_1E97F5B2BE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mission_target ADD CONSTRAINT FK_1E97F5B2158E0B66 FOREIGN KEY (target_id) REFERENCES target (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE mission_target');
    }
}
