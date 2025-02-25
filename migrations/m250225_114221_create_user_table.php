<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m250225_114221_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        // Создаем базу данных valera, если она не существует
        $this->execute('CREATE DATABASE IF NOT EXISTS valera');
        
        // Создаем таблицу user в базе данных valera
        $this->createTable('valera.user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(255)->notNull(),
            'password' => $this->string(255)->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'email' => $this->string(255)->notNull(),
            'confirmPassword' => $this->string(255)
        ]);

        // Создаем индексы для быстрого поиска
        $this->createIndex(
            'idx-user-username',
            'valera.user',
            'username',
            true
        );

        $this->createIndex(
            'idx-user-email',
            'valera.user',
            'email',
            true
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('valera.user');
        $this->execute('DROP DATABASE IF EXISTS valera');
    }
}
