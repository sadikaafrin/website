<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    private static $product,$image, $imageName, $imageUrl, $directory, $otherImages;

    public static function getImageUrl($request)
    {
        self::$image = $request->file('image');
        self::$imageName = self::$image->getClientOriginalName();
        self::$directory = 'product-image/';
        self::$image->move(self::$directory, self::$imageName);
        self::$imageUrl = self::$directory.self::$imageName;
        return self::$imageUrl;
    }

    public static function newProduct($request)
    {
        return Product::saveBasicInfo(new Product(), $request, self::getImageUrl($request));
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function subCategory()
    {
        return $this->belongsTo('App\Models\SubCategory');
    }
    public function  brand()
    {
        return $this->belongsTo(('App\Models\Brand'));
    }
    public function  unit()
    {
        return $this->belongsTo(('App\Models\Unit'));
    }
    public static function updateProduct($request, $id)
    {
        self::$product = Product::find($id);
        if ($request->file('image'))
        {
            if (file_exists(self::$product->image))
            {
                unlink(self::$product->image);
            }
            self::$imageUrl = self::getImageUrl($request);
        }
        else
        {
            self::$imageUrl = self::$product->image;
        }
        Product::saveBasicInfo(self::$product, $request,  self::$imageUrl);
    }

    public static function deleteProduct($id)
    {
        self::$product = Product::find($id);
        if (file_exists(self::$product->image))
        {
            unlink(self::$product->image);
        }
        self::$product->delete();

        self::$otherImages = OtherImage::where('product_id', $id)->get();
        foreach (self::$otherImages as $otherImage)
        {
            if (file_exists($otherImage->image))
            {
                unlink($otherImage->image);
            }
            $otherImage->delete();
        }
    }

    public static function saveBasicInfo($product, $request, $imageUrl)
    {
        $product->category_id         = $request->category_id;
        $product->sub_category_id     = $request->sub_category_id;
        $product->brand_id            = $request->brand_id;
        $product->unit_id             = $request->unit_id;
        $product->name                = $request->name;
        $product->code                = $request->code;
        $product->regular_price       = $request->regular_price;
        $product->selling_price       = $request->selling_price;
        $product->stock_amount        = $request->stock_amount;
        $product->short_description   = $request->short_description;
        $product->long_description    = $request->long_description;
        $product->image               = $imageUrl;
        $product->save();
        return $product;
    }
    public function  otherIamges()
    {
        return $this->hasMany(('App\Models\OtherImage'));
    }
}
