<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use App\Models\Crime;

class CrimeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Retrieves the total number of crimes in a given area.
     *
     * @var string
     */
    public function TotalByArea(String $area)
    {
        if (Crime::where('area_name', '=', urldecode($area))->exists()) {
            $total = Crime::where('area_name', '=', urldecode($area))
            ->count();
            return response()->json(['total' => $total]);
        } else {
            return response()->json(['message' => 'This area doesn\'t exist in the dataset.'], 404);
        }
    }

    /**
     * Retrieves the total number of crimes by type.
     *
     * @var string
     */
    public function TotalByType(String $type)
    {
        if (Crime::where('crime_cd_desc', '=', urldecode($type))
        ->exists()) {
            $total = Crime::where('crime_cd_desc', '=', urldecode($type))
            ->count();
            return response()->json(['total' => $total]);
        } else {
            return response()->json(['message' => 'This area doesn\'t exist in the dataset.'], 404);
        }
    }

    /**
     * Retrieves the location, latitude, and longitude of all
     * crime locations by type.
     *
     * @var string
     */
    public function LocationByType(String $type)
    {
        if (Crime::where('crime_cd_desc', '=', urldecode($type))
        ->exists()) {
            return Crime::select('location', 'lat', 'long')
        ->where('crime_cd_desc', '=', urldecode($type))
        ->paginate(100);
        } else {
            return response()->json(['message' => 'This area doesn\'t exist in the dataset.'], 404);
        }
    }

    /**
     * Retrieves the full address of all crime locations by type.
     *
     * @var string
     */
    public function FullAddressByType(String $type, Request $request)
    {
        $locations = Crime::select('location', 'lat', 'long')
            ->where('crime_cd_desc', '=', urldecode($type))
            ->limit(20)
            ->get();
        $addresses = [];
        foreach ($locations as $location) {
            $address = [
                'street' => $location->location,
            ];
            $address = array_merge_recursive($address, $this->GetAddress($location->lat, $location->long));
            $addresses[] = $address;
        }
        $total = count($addresses);
        $per_page = 5;
        $current_page = $request->input('page') ?? 1;

        $starting_point = ($current_page * $per_page) - $per_page;

        $pagination_array = array_slice($addresses, $starting_point, $per_page, true);

        $pagination_array = new Paginator($pagination_array, $total, $per_page, $current_page, [
            'nextPage' => $request->url() . '?page=' . ($current_page + 1),
        ]);
    }

    public function GetAddress(String $latitude, String $longitude)
    {
        $response = Http::get('https://nominatim.openstreetmap.org/reverse', [
            'format' => 'jsonv2',
            'lat' => $latitude,
            'lon' => $longitude,
            'zoom' => 18,
            'addressdetails' => 1
        ]);

        if ($response->status() === 200) {
            $json = $response->json()['address'];
            $geocoded_data = [
                'city' => $json['city'],
                'state' => $json['state'],
                'zipcode' => $json['postcode'],
            ];

            return $geocoded_data;
        } else {
            return false;
        }
    }
}
