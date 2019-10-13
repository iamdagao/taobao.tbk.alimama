<?php
namespace app\demo\controller;
use cmf\controller\HomeBaseController;
use tbk;
class DemoController extends HomeBaseController
{
    public function index()
    {
       $tbk=new \tbk\tbk();
		//tbk\tbk.php
		//相关商品
		$arr=array(
			'method'=>'taobao.tbk.item.recommend.get',	//API
			'fields'=>'num_iid,title,pict_url,small_images,reserve_price,zk_final_price,user_type,provcity,item_url',	//字段
			'num_iid'=>'590030941756',	//商品ID
			'count'=>40,	//返回数量，默认20，最大值40
			'platform'=>2,	//链接形式：1：PC，2：无线，默认：１
		);
		$tbk->arr=$arr;
		$r=$tbk->getapi ();
		print_r($r);
		
    }
}
