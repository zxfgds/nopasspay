<h1 align="center"> nopasspay </h1>

<p align="center"> 支付宝、微信免签支付.</p>


## 安装

```shell
$ composer require xiaowas/nopasspay -vvv
```

## 使用方法

等待下载安装完成，需要在`config/app.php`中注册服务提供者同时注册下相应门面：
```php
'providers' => [
    //........
    Xiaowas\Nopasspay\ServiceProvider::class,
],

'aliases' => [
    //..........
    'Nopasspay' => Xiaowas\Nopasspay\Facades\Nopasspay::class,
],

```
服务注入以后，发布配置文件到config目录 nopasspay配置文件，必须配置商户参数：
```composer
php artisan vendor:publish
```

###配置文件

```
return [
    "data" => [
        //商户ID->到平台首页自行复制粘贴
        'account_id' => '2',
        //S_KEY->商户KEY，到平台首页自行复制粘贴，该参数无需上传，用来做签名验证和回调验证，请勿泄露
        's_key' => '07FA836875B823',
        //请求获取的网页类型，json ,直接使用json即可
        'content_type' => 'json',
        //轮训状态，是否开启轮训，状态 1 为关闭   2为开启
        'robin' => 1,
        //异步通知接口url->用作于接收成功支付后回调请求
        'callback_url' => 'https://requestbin.leo108.com/1loiw2t1',
        //支付成功后自动跳转url
        'success_url' => 'http://myblog.test',
        //支付失败或者超时后跳转url
        'error_url' => 'http://myblog.test',
        'extend' => '',
        //支付类型->类型参数是服务版使用，公开版无需传参也可以
        'type' => '',
    ],
];


```



##代码示例

#### 请求参数

````
 $data = [
     'out_trade_no' => date("YmdHis") . mt_rand(10000, 99999),
     'thoroughfare' => 'alipay_auto',
     'keyId' => '225067CF8A84357C76',
     'amount' => 2.00
 ];

````

####直接跳转到支付页面（无返回参数）

````
 $nopassword = new Nopasspay();
 $nopassword->web($data); //直接跳转付款页面 第一种方法

````

####返回数据自行处理

````

 $res = $nopassword->json($data); //返回json数据，获得订单号，可自行跳转 

````

#####返回参数

```
  array:3 [▼
      "msg" => "success"
      "code" => 200
      "orderId" => "87"
    ]

```





#####异常

````

 try {
    $nopassword = new Nopasspay();
    $nopassword->web($data); //直接跳转付款页面 第一种方法
    

 } catch (Exception $e) {
   if ($e instanceof HttpException) {
        //异常逻辑 写自己的逻辑
         dd($e);
   }
 }
````


## 联系方式

邮箱： 413964626@qq.com 
QQ:   413964626

## License

MIT