<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Artist Entity
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $image_profile
 * @property string|null $fb
 * @property string|null $player_spotify
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Album[] $albums
 * @property \App\Model\Entity\FavouriteArtist[] $favourite_artist
 */
class Artist extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'first_name' => true,
        'last_name' => true,
        'image_profile' => true,
        'fb' => true,
        'player_spotify' => true,
        'created' => true,
        'modified' => true,
        'albums' => true,
        'favourite_artist' => true,
    ];
}
