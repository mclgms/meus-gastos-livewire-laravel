<?php

namespace App\Http\Livewire\Payment;

use App\Services\PagSeguro\Credencials;
use App\Services\PagSeguro\Subscription\SubscriptionService;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class CreditCard extends Component
{
    public $sessionId;

    protected $listeners = [
        'paymentData' => 'proccessSubscription'
    ];

    public function mount()
    {
        $url = Credencials::getCredencials('/sessions/');
        $response = Http::withHeaders([
            'Accept' => 'application/vnd.pagseguro.com.br.v3+xml;charset=ISO-8859-1',
            'Content-Type'=>'application/xml;charset=ISO-8859-1'
        ])->post($url);
        $res = simplexml_load_string($response->body());
        if ($res) {
            $this->sessionId = (string) $res->id;
        } else {
            $this->sessionId = 'Sessão inválida';
        }
    }

    public function proccessSubscription($payload)
    {
        $payload['plan_reference'] = '';
        $makeSubscription = (new SubscriptionService($payload))->makeSubscription();
        dd($makeSubscription);
    }

    public function render()
    {
        return view('livewire.payment.credit-card')
            ->layout('layouts.front');
    }
}
