<?php 

/**文件上传的方法 */
function upload($filename){
    // echo $filename;
    // dd(request()->file($filename)->isValid());
    //1.使用 isValid 方法判断文件在上传过程中是否出错：
    if (request()->file($filename)->isValid()){
        //2.接收文件
        $file = request()->$filename;
        // dd($file);
        //3.生成唯一的id 返回路径$path
        $path = request()->$filename->store('uploads');
        return $path;
    }
    return '文件上传过程出错';
}

/**多文件上传 */
function Moreupload($filename){
    $files = request()->$filename;

    if(!count($files)){
        return; 
    }
    foreach($files as $k=>$v){
        $path[] = $v->store('uploads');
    }
    return $path;
}


//无限极分类                                   //$level等级
function getCateInfo($cateInfo,$pid=0,$level=0){
    //判断
    if(!$cateInfo) return;
    //静态变量 追加
    static $info=[];
    //循环数据
    foreach($cateInfo as $k=>$v){
        //判断取得层级分类
        if($v->pid==$pid){
            //取得层级分类  加入到静态变量
            $v->level = $level;
            $info[]=$v;
            //再次调用自身 查询下一级分类
            getCateInfo($cateInfo,$v->cate_id,$level+1);
        }
    }
    return $info;
}
















?>