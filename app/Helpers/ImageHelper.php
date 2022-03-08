<?php
/**
 * Created by PhpStorm
 * User: ProgrammerHasan
 * Date: 31-10-2020
 * Time: 9:16 PM
 */
namespace App\Helpers;
/**
 * ImageHelper Class
 */
use App\Models\User;
use App\Helpers\GravatarHelper;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManagerStatic;

class ImageHelper
{
  public static function getUserProfileImage($user)
  {
    $avatar_url = "";
    if (!is_null($user)) {
      if ($user->photo_uri == NULL) {
        // Return him gravatar image
        if (GravatarHelper::validate_gravatar($user->email)) {
          $avatar_url = GravatarHelper::gravatar_image($user->email, 100);
        }else {
          $avatar_url = url('images/defaultAvatar.png');
        }
      }else {
        // Return that image
        $avatar_url = storage_url($user->photo_uri);
      }
    }else {
      // return redirect('/');
    }

    return $avatar_url;
  }

    /**
     * @param Request $request
     * @param $src
     * @return mixed
     */
    public static function image($src)
  {
      // pass calls to image cache
      $img = Image::cache(function($image) use ($src) {
        return  $image->make('https://images.deliveryhero.io/image/fd-bd/LH/'.$src)->resize(200,200);
      });
      return \Response::make($img, 200, array('Content-Type' => 'image/jpeg'));
  }

}
