<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    /*** 关联到模型的数据表 ** @var string */ 
    protected $table = 'member';

    /*** The primary key associated with the table. ** @var string */ 
    protected $primaryKey = 'member_id';
 
    /*** 表明模型是否应该被打上时间戳 ** @var bool */ 
    public $timestamps = false;
 
   //  public static function getGoodsIndex($pageSize){
   //      return self::orderBy('goods_id','desc')->paginate($pageSize);
   //  }
 
    /*** 可以被批量赋值的属性. ** @var array */   //白名单
    //protected $fillable = ['goods_name','cate_id','goods_number','brand_id'];
 
    /*** 不能被批量赋值的属性** @var array */ 
    protected $guarded = [];
}
