<?php
namespace App\Model;
class Shop extends \Illuminate\Database\Eloquent\Model {
    protected $table    = 'shops';
    protected $fillable = ['shop','timezone','token'];
}