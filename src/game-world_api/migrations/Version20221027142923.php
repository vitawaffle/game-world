<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

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
                name TEXT NOT NULL UNIQUE CHECK(
                    LENGTH(name) > 0
                        AND name ~ '^[A-Z]+[A-Z0-9_]+$'
                )
            )
        ");

        $this->addSql("
            CREATE TABLE users (
                id BIGSERIAL NOT NULL PRIMARY KEY,
                username TEXT NOT NULL UNIQUE CHECK(
                    LENGTH(username) > 0
                        AND username ~ '^[A-Za-z]+[A-Za-z0-9_]+$'
                ),
                password TEXT NOT NULL
            )
        ");

        $this->addSql("
            CREATE TABLE users_roles (
                user_id BIGINT NOT NULL,
                role_id BIGINT NOT NULL,
                PRIMARY KEY(user_id, role_id),
                CONSTRAINT users_roles_user_id_fkey FOREIGN KEY(user_id)
                    REFERENCES users (id) ON DELETE CASCADE,
                CONSTRAINT users_roles_role_id_fkey FOREIGN KEY(role_id)
                    REFERENCES roles (id) ON DELETE CASCADE
            )
        ");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE users_roles');
    }
}
