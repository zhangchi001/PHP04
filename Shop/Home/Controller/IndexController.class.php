<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        

    		$this->display("Index/index");

    }

    public function add(){


    	$mod = M("shop");

    	$mod->create();
    	$id = $mod->add();


        //调用图片上传
       $image = $this->myupload($_FILES);

       dump($image);
        
        if(!empty($image)){
           
            $bod = M("shopimage");

            //批量添加的 数组格式
           // array(
           //     array("imgpath"=>"第一图片",sid=3),
           //     array("imapaht"=>"第二图片",sid=5),
           //  )      
              $data = [];  //用于写入批量添加的数据  
             foreach($image as $k=>$v){   // $v  图片路径

                if($k==0){
                    $data[$k]['start'] = 1;
                }else{
                    $data[$k]['start'] = 0;
                }

                $data[$k]['imgpath'] = $v;
                $data[$k]['sid'] = $id;
               
            }

            //执行批量添加
            $a = $bod->addAll($data);

            if($a){
                $this->success("添加商品与图片成功",U("Index/show"));
                exit;
            }else{

                $this->error("添加商品与图片失败");
                exit;
            }

        }

        if($id){

                 $this->success("添加商品成功",U("Index/show"));
                 exit;
            }else{

                $this->error("添加商品");
                exit;

            }
    	
    	 //实例化数据库
    	 

    	// var_dump($id);
    }


    public function show(){

            // $mod = M("shop");

            // // $res = $mod->order("id")->select();

            // // $res = $mod->query("select * from shop left join shopimage on shop.id=shopimage.sid and shopimage.start=1 order by shop.id");


            // //为了保证数据不冲突 要用 as 对字段相同的下标 起个别名
            // $res =  $mod
            // ->field("shop.id as aid,shop.shopname,shopimage.id,shopimage.imgpath")
            // ->join("left join shopimage on shop.id=shopimage.sid and shopimage.start=1")
            // ->order("shop.id")
            // ->select();

            $mod = M();

            $res = $mod->table("shop s")
            ->field("s.id as aid,s.shopname as nm,m.id,m.imgpath")
            ->join("left join shopimage as m on s.id=m.sid and m.start=1")
            ->select();

        
              dump($res);
            $name = "";
            $this->assign("abc",$name);
            $this->assign("res",$res);
            $this->display("Index/show");

          

     
    }



    public function myupload(){
    		  // 实例化上传类  
    		  $upload = new \Think\Upload();  


    		  $upload->maxSize = 0;// 设置附件上传大小  

    		  // 设置附件上传类型    
    		  $upload->exts    =  array('jpg', 'gif', 'png', 'jpeg ');

    		  //设置是否开启创建日期目录 默认为true;
    		  $upload->autoSub = false;

    		  // 设置图片保存的根止当
    		  $upload->rootPath = "./Shop/Public";

    		  //设置附件上传目录  //定义好根目录后系统会自动创建 
    		  $upload->savePath = '/Uploads/'; 
    		   

    		  // 单文件文件上传 得到一维数组  
    		  // $info = $upload->uploadOne($_FILES['pic']);


    		  // 多文件上传(开启)
    		   $info = $upload->upload();

    		  /*
                实例化图片缩放类 PHP中要开启GD库
              **/
              //实例化
                $image = new \Think\Image(); 
    		  
              //定义一个空数组
              
                $image = [];
              if($info){
    		  	 foreach ($info as $file) {
    		 		//完整的图片路径
    		 	 	 $image[] = $file['savepath'].$file['savename'];

                    

                    //通过完整路径打开上传后的图片
                   //  $image = $image->open("./Shop/Public".$file['savepath'].$file['savename']);

                     //设置用图片缩放方法
                     //thumb() 设置缩放的宽与高
                     //save()  设置缩放后图片存放的位置 (缩放后的图片是一张新的图片)
                    
                     //设置图片缩放
                     // $image->thumb(50, 50)->save("./Shop/Public".$file['savepath']."m_".$file['savename']);



                     //设置图片水印
                   //  $image->open("./Shop/Public".$file['savepath'].$file['savename'])->water('./Shop/Public/Uploads/m_5b4ae891b97fa.jpg',\Think\Image::IMAGE_WATER_NORTHEAST)->save("./Shop/Public".$file['savepath'].$file['savename']); 
                     
    		 	 }

                 return $image;

    		  }
    		    
    	}


}