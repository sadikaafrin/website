<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Termwind\ValueObjects\p;

class OtherImage extends Model
{
    use HasFactory;
    private static $otherImage, $otherImages, $image, $imageName, $imageUrl, $directory;


    public static function getImageUrl($otherImage)
    {
        self::$imageName = $otherImage->getClientOriginalName();
        self::$directory = 'other-image/';
       $otherImage->move(self::$directory, self::$imageName);
        self::$imageUrl = self::$directory.self::$imageName;
        return self::$imageUrl;
    }

    public static function newOtherImage($request, $id)
    {
        self::$otherImage = $request->file('other_image');
        foreach (self::$otherImage as $otherImage)
        {
            self::$otherImage = new OtherImage();
            self::$otherImage->product_id = $id;
            self::$otherImage->image      = self::getImageUrl($otherImage);
            self::$otherImage->save();
        }
    }
    public static function updateOtherImage($request, $id)
    {
        self::$otherImages = OtherImage::where('product_id', $id)->get();
        foreach (self::$otherImages as $otherImage)
        {
            if (file_exists($otherImage->image))
            {
                unlink($otherImage->image);
            }
            $otherImage->delete();
        }
        self::newOtherImage($request, $id);
    }
}
