<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
     /*** 关联到模型的数据表 ** @var string */ 
     protected $table = 'goods';

     /*** The primary key associated with the table. ** @var string */ 
     protected $primaryKey = 'goods_id';
  
     /*** 表明模型是否应该被打上时间戳 ** @var bool */ 
     public $timestamps = false;
  
    //  public static function getGoodsIndex($pageSize){
    //      return self::orderBy('goods_id','desc')->paginate($pageSize);
    //  }
  
     /*** 可以被批量赋值的属性. ** @var array */   //白名单
     protected $fillable = ['goods_name','cate_id','goods_number','brand_id'];
  
     /*** 不能被批量赋值的属性** @var array */ 
     //protected $guarded = [];

     public static function getSliceData(){
          $where['is_slice']=1;
          $where['is_on_sale']=1;
          return self::select('goods_id','goods_img')->where('is_slice',1)->take(5)->get();
     }
}
