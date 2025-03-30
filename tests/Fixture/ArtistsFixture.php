<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ArtistsFixture
 */
class ArtistsFixture extends TestFixture
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
                'first_name' => 'Lorem ipsum dolor sit amet',
                'last_name' => 'Lorem ipsum dolor sit amet',
                'image_profile' => 'Lorem ipsum dolor sit amet',
                'fb' => 'Lorem ipsum dolor sit amet',
                'player_spotify' => 'Lorem ipsum dolor sit amet',
                'created' => '2025-03-25 09:26:00',
                'modified' => '2025-03-25 09:26:00',
            ],
        ];
        parent::init();
    }
}
