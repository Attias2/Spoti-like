<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class CreateRequests extends BaseMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/migrations/4/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('requests');
        $table->addColumn('user_id', 'integer', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('content', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->changeColumn('status', 'string', [
            'default' => 'envoyé',
            'null' => false
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();
    }
}
