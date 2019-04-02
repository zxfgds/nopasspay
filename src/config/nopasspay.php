<?php
return [
    //支付请求url
    'pay_way' => 'http://pp.ana51.com/gateway/pay/automaticAlipay.do',
    //请求url
    'gate_way' => 'http://pp.ana51.com/gateway/index/checkpoint.do',
    //商户名
    'account_key' => 'ceshi',
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
        'type' => ''
    ],
];
