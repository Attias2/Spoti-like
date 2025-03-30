<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AlbumsFixture
 */
class AlbumsFixture extends TestFixture
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
                'artist_id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'typology' => 'Lorem ipsum dolor ',
                'created' => '2025-03-25 09:27:51',
                'modified' => '2025-03-25 09:27:51',
            ],
        ];
        parent::init();
    }
}
