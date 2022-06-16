<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Perminantly store the location response.
 *
 * @property int $id
 * @property string $postcode
 * @property string $latitude
 * @property string $longitude
 * @property array $response
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class LocationQuery extends Model
{
    use HasFactory;

    protected $fillable = [
        'postcode',
        'latitude',
        'longitude',
        'response',
    ];

    protected $casts = [
        'response' => 'array',
    ];

    /**
     * Find the location query by postcode.
     *
     * @param  string $postcode
     *
     * @return \App\Models\LocationQuery|null
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function scopeFindOrCreateByPostcode(Builder $query, string $postcode)
    {
        // format postcode to match API response
        $postcode = str($postcode)->upper()->replace(' ', '')->value();

        return $query->where('postcode', $postcode)->firstOr(function () use ($postcode) {
            $response = Http::get('https://api.postcodes.io/postcodes/' . $postcode)->throw()->json();

            return $this->create([
                'postcode' => $postcode,
                'latitude' => $response['result']['latitude'],
                'longitude' => $response['result']['longitude'],
                'response' => $response,
            ]);
        });
    }
}
