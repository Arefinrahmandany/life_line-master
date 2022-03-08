<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RiderResource extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->map(function($data) {
            return [
                'id' => $data->id,
                'rider_id' => $data->rider->id,
                'first_name' => $data->first_name,
                'last_name' => $data->last_name,
                'type_id' => $data->type_id,
                'phone' => $data->phone,
                'email' => $data->email,
                'photo_uri' => $data->photo_uri,
                'phone_verified_at' => Carbon::createFromTimestamp(strtotime($data->phone_verified_at))->format('d-m-Y'),
                'email_verified_at' => Carbon::createFromTimestamp(strtotime($data->email_verified_at))->format('d-m-Y'),
                'is_active' => $data->is_active,
                'is_two_factor_auth' => $data->is_two_factor_auth,
                'device_token' => $data->device_token,
                //'full_name' => $data->full_name,
                'rider_is_online' => $data->rider->is_online,
                'joined_at' => Carbon::createFromTimestamp(strtotime($data->created_at))->format('d-m-Y'),
                'active_contract_date' => Carbon::createFromTimestamp(strtotime(@$data->rider->contract_date))->format('d-m-Y'),
            ];
        });
    }
}
