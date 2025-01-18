<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\KebabPlace;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class RetrieveOpinionAction
{
    /**
     * @throws GuzzleException
     */
    public function execute(): void
    {
        $kebabPlaces = KebabPlace::query()->whereNotNull("place_id")->get();

        foreach ($kebabPlaces as $kebabPlace) {
            $placeId = $kebabPlace->place_id;
            $apiKey = config("services.google.maps_api_key");

            $url = "https://maps.googleapis.com/maps/api/place/details/json?placeid=$placeId&key=$apiKey";

            $client = new Client();
            $response = $client->get($url);

            $data = json_decode($response->getBody()->getContents(), true);

            if (isset($data["result"]["rating"])) {
                $rating = $data["result"]["rating"];

                $kebabPlace->update([
                    "google_maps_rating" => $rating,
                ]);
            }
        }
    }
}
