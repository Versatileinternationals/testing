<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['product_number' ,'m_id', 'category_id', 'subcategory_id', 'name', 'sku', 'brand', 'sale_price', 'regular_price',
    'short_description', 'description', 'stock', 'minimum_stock', 'sale_start_date', 'sale_end_date', 'weight', 'length', 'width', 'height', 'colors',
    'allow_customer_review', 'sold_avaliable', 'purchase_note', 'tags', 'images', 'status', 'shipping_class', 'image', 'position', 'button_text',
    'page_title' , 'page_description' , 'page_keywords' , 'added_by' ,'allow_return', 'max_order_qty', 'main_image', 'specification','related_product'];
    protected $table = "products";

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo('App\Models\SubCategory', 'subcategory_id');
    }

    public function brandData()
    {
        return $this->belongsTo('App\Models\Brand', 'brand');
    }
    public function status()
    {
        return $this->belongsTo('App\Models\Brand', 'status');
    }
}
