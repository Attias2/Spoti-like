<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RequestsFixture
 */
class RequestsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'user_id' => 1,
                'content' => 'Lorem ipsum dolor sit amet',
                'status' => 'Lorem ipsum dolor ',
                'created' => '2025-03-25 09:26:57',
                'modified' => '2025-03-25 09:26:57',
            ],
        ];
        parent::init();
    }
}
