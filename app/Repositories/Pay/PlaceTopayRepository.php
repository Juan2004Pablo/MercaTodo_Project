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
use  GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class PlaceToPayRepository extends BaseRepository
{
    public function getModel(): Order
    {
        return new Order();
    }

    protected $conection;

    /**
     * AdminPayController constructor.
     */
    public function __construct(ConectionPTPRepository $conection)
    {
        $this->conection = $conection;
    }

    /**
     * function to connect to the payment gateway of place to pay
     *
     */
    public function conectionPlaceToPay(): object
    {
        $p = Pay::inProcess()->first();

        if ($p) {
            $p->delete();
            $order = $this->getModel()->open()->rejected()->first();
            $total = $order->total;
            $reference = $order->id;
        } else {
            $order = $this->getModel()->open()->rejected()->first();

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
                'description' => 'Basic test payment',
                'amount' => $amount,
            ];

        $data =
            [
                'auth' => $auth,
                'payment' => $payment,
                'expiration' => date('c', strtotime('+15 minutes')),
                'returnUrl' => config('app.url') . '/pay/consultPayment/' . $reference,
                'ipAddress' => config('app.ip_address'),
                'userAgent' => 'PlacetoPay Sandbox',
            ];
        $url = config('app.WEBCHECKOUT_URL') . 'api/session';

        try {
            $response = Http::withHeaders(['Content-Type' => 'application/json'])->post($url, $data);

            $body = $response->getBody();
            $result = json_decode($response->getBody());

            return $result;
        } catch (Throwable $e) {
            Log::channel('contlog')->error('RequestException' ,
            ['error' => $e]);
        }
    }

    /**
     * function to check the details of the payment made
     *
     * @param int $reference
     * @return object
     */
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
                'returnUrl' => config('app.url') . '/pay/consultPayment/' . $reference,
                'ipAddress' => config('app.ip_address'),
                'userAgent' => 'PlacetoPay Sandbox',
            ];
        $url = config('app.WEBCHECKOUT_URL') . 'api/session/' . $requestId;

        $client = new Client([
            'headers' => ['Content-Type' => 'application/json'],
        ]);

        try {
            $response = $client->post($url, [
            'json' => $data, ]);

            $body = $response->getBody();
            $res = json_decode($response->getBody());
            Log::channel('contlog')->info('payment response: ' . $body);

            return $res;
        } catch (Throwable $e) {
            Log::channel('contlog')->error('PlaceToPayException' ,
            ['error' => $e]);
        }
    }

    /**
     * function to check the details of the payment made after job
     *
     * @param int $reference
     * @return object
     */
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
                'returnUrl' => config('app.url') . '/pay/consultPayment/' . $reference,
                'ipAddress' => config('app.ip_address'),
                'userAgent' => 'PlacetoPay Sandbox',
            ];

        $url = config('app.WEBCHECKOUT_URL') . 'api/session/' . $requestId;

        $client = new Client([
            'headers' => ['Content-Type' => 'application/json'],
        ]);

        try {
            $response = $client->post($url, [
                'json' => $data, ]);

            $body = $response->getBody();
            $res = json_decode($response->getBody());
            Log::channel('contlog')->info('payment response: ' . $body);

            return $res;
        } catch (Throwable $e) {
            Log::channel('contlog')->error('PlaceToPayException' ,
            ['error' => $e]);
        }
    }
}
