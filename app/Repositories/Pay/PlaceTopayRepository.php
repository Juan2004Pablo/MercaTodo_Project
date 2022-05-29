<?php

namespace App\Repositories\Pay;

use App\Models\Order;
use App\Models\Pay;
use App\Repositories\BaseRepository;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
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
            Log::channel('contlog')->error(
                'RequestException',
                ['error' => $e]
            );
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
            Log::channel('contlog')->error(
                'PlaceToPayException',
                ['error' => $e]
            );
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
            Log::channel('contlog')->error(
                'PlaceToPayException',
                ['error' => $e]
            );
        }
    }
}
