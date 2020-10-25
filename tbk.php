<?php
namespace tbk;
class tbk
{
    protected $url='http://gw.api.taobao.com/router/rest?';
	protected $appKey ='';
	protected $appSecret = '';
	protected $format = 'json';
	protected $v = '2.0';
	protected $sign_method='md5';
	protected $timestamp;
	public $arr;
	/*
	getapi ($arr)
	//相关商品清单
	$arr=array(
		'method'=>'taobao.tbk.item.recommend.get',	//API
		'fields'=>'num_iid,title,pict_url,small_images,reserve_price,zk_final_price,user_type,provcity,item_url',	//字段
		'num_iid'=>'590030941756',	//商品ID
		'count'=>20,	//返回数量，默认20，最大值40
		'platform'=>2,	//链接形式：1：PC，2：无线，默认：１
	);
	//相关店铺清单
	$arr=array(
		'method'=>'taobao.tbk.shop.recommend.get',	//API
		'fields'=>'user_id,shop_title,shop_type,seller_nick,pict_url,shop_url',		//需返回的字段列表
		'user_id'=>'卖家Id',
		'count'=>20,	//返回数量，默认20，最大值40
		'platform'=>2,	//链接形式：1：PC，2：无线，默认：１
	);
	//搜索店铺清单
	$arr=array(
		'method'=>'taobao.tbk.shop.get',	//API
		'fields'=>'user_id,shop_title,shop_type,seller_nick,pict_url,shop_url',	需返回的字段列表
		'q'=>'女装',	//查询词
		'sort'=>'commission_rate_des',	//排序_des（降序），排序_asc（升序），佣金比率（commission_rate），商品数量（auction_count），销售总数量（total_auction）
		'is_tmall'=>false,	//true表示天猫，false表示不判断这个
		'start_credit'=>1,	//信用等级下限，1~20
		'end_credit'=>20,	//信用等级上限，1~20
		'start_commission_rate'=>2000,	//淘客佣金比率下限，1~10000
		'end_commission_rate'=>123,	//淘客佣金比率上限，1~10000
		'start_total_action'=>1,	//店铺商品总数下限
		'end_total_action'=>100,	//店铺商品总数上限
		'start_auction_count'=>123,	//累计推广商品下限
		'end_auction_count'=>false,	//200	累计推广商品上限
		'platform'=>2,	//链接形式：1：PC，2：无线，默认：１
		'page_no'=>1,	//第几页，默认1，1~100
		'page_size'=>20,	//页大小，默认20，1~100
	);
	//搜索商品清单
	$arr=array(
		'method'=>'taobao.tbk.dg.material.optional',	//API
		'start_dsr'=>10,	//商品筛选-店铺dsr评分。筛选大于等于当前设置的店铺dsr评分的商品0-50000之间
		'page_size'=>20,	//页大小，默认20，1~100
		'page_no'=>1,	//第几页，默认：１
		'platform'=>2,	//链接形式：1：PC，2：无线，默认：１
		'end_tk_rate'=>1234,	//商品筛选-淘客佣金比率上限。如：1234表示12.34%
		'start_tk_rate'=>1234,	//商品筛选-淘客佣金比率下限。如：1234表示12.34%
		'end_price'=>10,	//商品筛选-折扣价范围上限。单位：元
		'start_price'=>10,	//商品筛选-折扣价范围下限。单位：元
		'is_overseas'=>false,	//商品筛选-是否海外商品。true表示属于海外商品，false或不设置表示不限
		'is_tmall'=>false,	//商品筛选-是否天猫商品。true表示属于天猫商品，false或不设置表示不限
		'sort'=>'tk_rate_des',	//des降asc升 销量total_sales佣金比率tk_rate 累计推广量tk_total_sales总支出佣金tk_total_commi价格price
		'itemloc'=>'杭州',	//商品筛选-所在地
		'cat'=>'16,18',	//商品筛选-后台类目ID。用,分割，最大10个，该ID可以通过taobao.itemcats.get接口获取到
		'q'=>'女装',	//商品筛选-查询词
		'material_id'=>2836,	//官方的物料Id(详细物料id见：https://tbk.bbs.taobao.com/detail.html?appId)，不传时默认为2836
		'has_coupon'=>false,	//优惠券筛选-是否有优惠券。true表示该商品有优惠券，false或不设置表示不限
		'ip'=>'13.2.33.4',	//ip参数影响邮费获取，如果不传或者传入不准确，邮费无法精准提供
		'adzone_id'=>12345678,	//mm_xxx_xxx_12345678三段式的最后一段数字
		'need_free_shipment'=>true,	//商品筛选-是否包邮。true表示包邮，false或不设置表示不限
		'need_prepay'=>true,	//商品筛选-是否加入消费者保障。true表示加入，false或不设置表示不限
		'include_pay_rate_30'=>true,	//商品筛选(特定媒体支持)-成交转化是否高于行业均值。True表示大于等于，false或不设置不限
		'include_good_rate'=>true,	//商品筛选-好评率是否高于行业均值。True表示大于等于，false或不设置不限
		'include_rfd_rate'=>true,	//商品筛选(特定媒体支持)-退款率是否低于行业均值。True表示大于等于，false或不设置表示不限
		'npx_level'=>2,	//商品筛选-牛皮癣程度。取值：1不限，2无，3轻微
		'end_ka_tk_rate'=>1234,	//商品筛选-KA媒体淘客佣金比率上限。如：1234表示12.34%
		'start_ka_tk_rate'=>1234,	//商品筛选-KA媒体淘客佣金比率下限。如：1234表示12.34%
		'device_encrypt'=>'MD5',	//智能匹配-设备号加密类型：MD5
		'device_value'=>'xxx',	//智能匹配-设备号加密后的值（MD5加密需32位小写）
		'device_type'=>'IMEI',	//智能匹配-设备号类型：IMEI，或者IDFA，或者UTDID（UTDID不支持MD5加密），或者OAID
		'lock_rate_end_time'=>1567440000000,	//锁佣结束时间
		'lock_rate_start_time'=>1567440000000,	//锁佣开始时间
	);
	//淘抢购商品清单
	$arr=array(
		'method'=>'taobao.tbk.ju.tqg.get',	//API
		'adzone_id'=>123,	//推广位id（推广位申请方式：http://club.alimama.com/read.php?tid=6306396&ds=1&page=1&toread=1）
		'fields'=>'title,total_amount,click_url,category_name,zk_final_price,end_time,sold_num,start_time,reserve_price,pic_url,num_iid',	//字段
		'start_time'=>true,	//2016-08-09 09:00:00	最早开团时间
		'end_time'=>true,	//2016-08-09 16:00:00	最晚开团时间
		'page_no'=>1,	//第几页，默认1，1~100
		'page_size'=>40,	//页大小，默认40，1~40
	);
	//聚划算商品清单
	$arr=array(
		'method'=>'taobao.ju.items.search',	//API
		'current_page'=>1,	//页码,必传
		'page_size'=>20,	//一页大小,必传
		'pid'=>'',	//媒体pid,必传'
		'postage'=>true,	//是否包邮,可不传
		'status'=>2,	//状态，预热：1，正在进行中：2,可不传
		'taobao_category_id'=>1000,	//淘宝类目id,可不传
		'word'=>'',	//搜索关键词,可不传
	);
	//淘口令生成
	$arr=array(
		'method'=>'taobao.tbk.tpwd.create',	//API
		'text'=>'',	//长度大于5个字符	口令弹框内容
		'url'=>'https://uland.taobao.com/',	//口令跳转目标页
	);
	//商品详情查询
	$arr=array(
		'method'=>'taobao.tbk.item.info.get',	//API
		'num_iids'=>'',	//商品ID串，用,分割，最大40个
		'platform'=>2,	//链接形式：1：PC，2：无线，默认：１
	);
	//优惠券查询
	$arr=array(
		'method'=>'taobao.tbk.coupon.get',	//API
		'item_id'=>123,	//商品ID
		'activity_id'=>'sdfwe3eefsdf',	//券ID
	);
	*/
	public function getapi () {
		$this->timestamp = date('Y-m-d H:i:s');
		$paramArr = array(
			 'app_key' => $this->appKey,
			 'format' => $this->format,
			 'v' => $this->v,
			 'sign_method'=>$this->sign_method,
			 'timestamp' =>$this->timestamp,
		);
		$paramArr=array_merge($paramArr,$this->arr);
		$sign = $this->createSign($paramArr);
		//组织参数
		$strParam = $this->createStrParam($paramArr);
		$strParam .= 'sign='.$sign;
		return $this->curld($this->url.$strParam);
	}
	//构造签名
	public function createSign ($paramArr) {
		$sign = $this->appSecret;
		ksort($paramArr);
		foreach ($paramArr as $key => $val) {
			if ($key != '' && $val != '') {
				$sign .= $key.$val;
			}
		}
		$sign.=$this->appSecret;
		$sign = strtoupper(md5($sign));
		return $sign;
	}
	//构造get参数
	public function createStrParam ($paramArr) {
		$strParam = '';
		foreach ($paramArr as $key => $val) {
		if ($key != '' && $val != '') {
				$strParam .= $key.'='.urlencode($val).'&';
			}
		}
		return $strParam;
	}
	//对象转数组
	public function std_to_arr ($array) {
		if(is_object($array)) {  
			$array = (array)$array;  
		} if(is_array($array)) {  
			foreach($array as $key=>$value) {  
				$array[$key] = $this->std_to_arr($value);  
			}  
		}  
		return $array;  
	}
	//读取API
	public function curld($url){
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$result = curl_exec($ch);
		curl_close($ch);
		$r = $this->std_to_arr(json_decode($result));//返回数据结果，爱咋用咋用！
		return $r;
	}
}
?>
