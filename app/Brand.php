<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    /*** 关联到模型的数据表 ** @var string */ 
    protected $table = 'brand';

   /*** The primary key associated with the table. ** @var string */ 
   protected $primaryKey = 'brand_id';

   /*** 表明模型是否应该被打上时间戳 ** @var bool */ 
   public $timestamps = false;

   public static function getBrandIndex($pageSize,$where){
       return self::where($where)->orderBy('brand_id','desc')->paginate($pageSize);
   }

   /*** 可以被批量赋值的属性. ** @var array */   //白名单
   //protected $fillable = ['brand_name','brand_url','brand_logo','brand_desc'];
 
   /*** 不能被批量赋值的属性** @var array */  //黑名单
   protected $guarded = [];

}
