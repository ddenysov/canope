<?php

declare(strict_types=1);

namespace Denysov\UserService\Infrastructure\Migrations\Doctrine;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250709154245 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Добавляет поля name и password в таблицу read_model_users';
    }

    public function up(Schema $schema): void
    {
        $table = $schema->getTable('read_model_users');
        $table->addColumn('name', 'string', ['length' => 255, 'notnull' => false]);
        $table->addColumn('password', 'string', ['length' => 255, 'notnull' => false]);
    }

    public function down(Schema $schema): void
    {
        $table = $schema->getTable('read_model_users');
        $table->dropColumn('name');
        $table->dropColumn('password');
    }
}
