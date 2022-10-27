<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221027142923 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
            CREATE TABLE roles (
                id BIGSERIAL NOT NULL PRIMARY KEY,
                name TEXT NOT NULL UNIQUE CHECK(LENGTH(name) > 0 AND name ~ '^[A-Z]+[A-Z0-9_]+$')
            )
        ");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE roles');
    }
}
