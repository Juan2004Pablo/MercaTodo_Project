<?php

namespace App\Repositories\Pay;

use App\Models\Order;
use App\Models\Pay;
use App\Repositories\BaseRepository;
use App\Repositories\Pay\ConectionPTPRepository;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PlaceToPayRepository extends BaseRepository
{
    public function getModel(): Order
    {
        return new Order();
    }

    protected $conection;

    public function __construct(ConectionPTPRepository $conection)
    {
        $this->conection = $conection;
    }

    public function conectionPlaceToPay(): object
    {
        $p = Pay::inProcess()->first();

        if ($p) {
            $p->delete();
            $order = $this->getModel()->pending()->rejected()->first();
            $total = $order->total;
            $reference = $order->id;
        } else {
            $order = $this->getModel()->pending()->rejected()->first();

            $total = $order->total;
            $reference = $order->id;
        }

        $auth = $this->conection->conectioPlaceToPay();

        $amount =
            [
                'currency' => 'COP',
                'total' => $total,
            ];

        $payment =
            [
                'reference' => $reference,
                'description' => 'This is a payment',
                'amount' => $amount,
            ];

        $data =
            [
                'auth' => $auth,
                'payment' => $payment,
                'expiration' => date('c', strtotime('+15 minutes')),
                'returnUrl' => 'http://127.0.0.1:8000/pay/consultPayment/' . $reference,
                'ipAddress' => '127.0.0.1',
                'userAgent' => 'PlacetoPay Sandbox',
            ];
        $url = 'https://test.placetopay.com/redirection/api/session/';

        $client = new Client([
            'headers' => ['Content-Type' => 'application/json'],
        ]);
        try {
            $response = $client->post($url, [
                'json' => $data,
            ]);

            $body = $response->getBody();
            $result = json_decode($response->getBody());

            return $result;
        } catch (RequestException $e) {
            Log::channel('contlog')->error('RequestException' .
                    Psr7\str($e->getResponse()));
        } catch (ServerException $e) {
            Log::channel('contlog')->error('ServerException' .
                    Psr7\str($e->getResponse()));
        } catch (BadResponseException $e) {
            Log::channel('contlog')->error('BadResponseException' .
                   Psr7\str($e->getResponse()));
        }
    }

    public function consultPay(int $reference): object
    {

        $pay = Pay::all()->where('reference', $reference)->last();
        $pay->reference = $reference;
        $requestId = $pay->requestId;

        $auth = $this->conection->conectioPlaceToPay();

        $data =
            [
                'auth' => $auth,
                'expiration' => date('c', strtotime('+15 minutes')),
                'returnUrl' => 'http://127.0.0.1:8000/pay/updatedata/' . $reference,
                'ipAddress' => '127.0.0.1',
                'userAgent' => 'PlacetoPay Sandbox',
            ];

        $url = 'https://test.placetopay.com/redirection/api/session/' . $requestId;

        $client = new Client([
            'headers' => ['Content-Type' => 'application/json'],
        ]);

        try {
            $response = $client->post($url, [
            'json' => $data, ]);

            $body = $response->getBody();
            $res = json_decode($response->getBody());
            Log::channel('contlog')->info('Answer payment: ' . $body);

            return $res;
        } catch (RequestException $e) {
            Log::channel('contlog')->error('RequestException' .
                Psr7\str($e->getResponse()));
        } catch (ServerException $e) {
            Log::channel('contlog')->error('ServerException' .
                Psr7\str($e->getResponse()));
        } catch (BadResponseException $e) {
            Log::channel('contlog')->error('BadResponseException' .
                Psr7\str($e->getResponse()));
        }
    }

    public function consultPayJob(int $reference): object
    {
        $pay = Pay::where('reference', $reference)->pending()->first();
        $pay->reference = $reference;
        $requestId = $pay->requestId;

        $auth = $this->conection->conectioPlaceToPay();

        $data =
            [
                'auth' => $auth,
                'expiration' => date('c', strtotime('+15 minutes')),
                'returnUrl' => 'http://127.0.0.1:8000/pay/updatedata/' . $reference,
                'ipAddress' => '127.0.0.1',
                'userAgent' => 'PlacetoPay Sandbox',
            ];

        $url = 'https://test.placetopay.com/redirection/api/session/' . $requestId;

        $client = new Client([
            'headers' => ['Content-Type' => 'application/json'],
        ]);

        try {
            $response = $client->post($url, [
                'json' => $data, ]);

            $body = $response->getBody();
            $res = json_decode($response->getBody());
            Log::channel('contlog')->info('Answer payment: ' . $body);

            return $res;
        } catch (RequestException $e) {
            Log::channel('contlog')->error('RequestException' .
                Psr7\str($e->getResponse()));
        } catch (ServerException $e) {
            Log::channel('contlog')->error('ServerException' .
                Psr7\str($e->getResponse()));
        } catch (BadResponseException $e) {
            Log::channel('contlog')->error('BadResponseException' .
                Psr7\str($e->getResponse()));
        }
    }
}
