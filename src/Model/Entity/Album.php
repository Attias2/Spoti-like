<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Album Entity
 *
 * @property int $id
 * @property int $artist_id
 * @property string $name
 * @property string $typology
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Artist $artist
 * @property \App\Model\Entity\FavouriteAlbum[] $favourite_albums
 */
class Album extends Entity
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
        'artist_id' => true,
        'name' => true,
        'typology' => true,
        'created' => true,
        'modified' => true,
        'artist' => true,
        'favourite_albums' => true,
    ];
}
