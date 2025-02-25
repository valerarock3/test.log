<?php

use yii\db\Migration;

class m240225_123456_add_avatar_column extends Migration
{
    public function up()
    {
        $this->addColumn('valera.user', 'avatar', $this->string(255)->null());
    }

    public function down()
    {
        $this->dropColumn('valera.user', 'avatar');
    }
} 