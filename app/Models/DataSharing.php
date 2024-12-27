<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSharing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'data',
    ];

    public static function storeShareableData($data): bool
    {
        DataSharing::updateOrCreate(
            [
                'user_id' => auth()->id()
            ],
            [
                'data' => json_encode($data, true)
            ]
        );

        return true;
    }

    public static function getData($items = null)
    {
        if ($items != null) {

            $itemsArray = json_decode($items->data, true);

            $data = [];

            foreach ($itemsArray as $key => $val) {
                if ($val == 'firstName') {
                    $data[] = 'First Name';
                }

                if ($val == 'middleName') {
                    $data[] = 'Middle Name';
                }

                if ($val == 'lastName') {
                    $data[] = 'Last Name';
                }

                if ($val == 'nickName') {
                    $data[] = 'Nick Name';
                }

                if ($val == 'email') {
                    $data[] = 'Email';
                }

                if ($val == 'mobile') {
                    $data[] = 'Mobile';
                }

                if ($val == 'dob') {
                    $data[] = 'Date Of Birth';
                }

                if ($val == 'gender') {
                    $data[] = 'Gender';
                }

                if ($val == 'aboutMe') {
                    $data[] = 'About Me';
                }

                if ($val == 'addressLine1') {
                    $data[] = 'Address Line 1';
                }

                if ($val == 'subRoad') {
                    $data[] = 'Sub Road';
                }

                if ($val == 'city') {
                    $data[] = 'City';
                }

                if ($val == 'postCode') {
                    $data[] = 'Post Code';
                }

                if ($val == 'country') {
                    $data[] = 'Country';
                }

                if ($val == 'profilePicture') {
                    $data[] = 'Profile Picture';
                }

                if ($val == 'photoId') {
                    $data[] = 'Photo ID';
                }

                if ($val == 'documents') {
                    $data[] = 'Documents';
                }
            }

            return $data;
        } else {
            return '';
        }
    }

}
