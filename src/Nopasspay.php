<?php
/**
 * Created by PhpStorm.
 * User: xiaowas
 * Date: 2019/4/1
 * Time: 4:14 PM
 */

namespace Xiaowas\Nopasspay;

use GuzzleHttp\Client;
use Xiaowas\Nopasspay\Exceptions\HttpException;
use Xiaowas\Nopasspay\Exceptions\InvalidArgumentException;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Request;


class Nopasspay
{

    public function act($data)
    {

        $data = array_merge(Config::get('nopasspay.data'), $data);

        $sign = Sign::sign(Config::get('nopasspay.data.s_key'), ['amount' => $data['amount'], 'out_trade_no' => $data['out_trade_no']]);

        $data['sign'] = $sign;

        $client = new Client();

        $res = $client->request('POST', Config::get('nopasspay.gate_way'), [
            'form_params' => $data
        ]);

        $body = $res->getBody();

        $res = (array)json_decode($body);

        if ($res['code'] == -1) {
            throw new HttpException($res['msg'], 500);
        }

        $data = (array)$res['data'];
        $orderId = $data['order_id'];

        return [
            'msg' => $res['msg'],
            'code' => 200,
            'orderId' => $orderId
        ];
    }

    public function verify($data = null)
    {

        if (is_null($data)) {
            $request = Request::createFromGlobals();
            $data = $request->request->count() > 0 ? $request->request->all() : $request->query->all();
        }

        //第一步，检测商户KEY是否一致
        if ($data['account_key'] != Config::get('nopasspay.account_key')) exit('error:key');
        //第二步，验证签名是否一致
        if (Sign::sign(Config::get('nopasspay.data.s_key'), ['amount' => $data['amount'], 'out_trade_no' => $data['out_trade_no']]) != $data['sign']) exit('error:sign');

        return true;
    }

    public function json($data)
    {
        return $this->act($data);
    }

    public function web($data)
    {
        $res = $this->act($data);
        $url = Config::get('nopasspay.pay_way') . "?id=" . $res['orderId'];
        header("Location: {$url}");
    }

}