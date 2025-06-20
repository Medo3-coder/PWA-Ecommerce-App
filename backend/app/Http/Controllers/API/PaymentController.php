<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Payments\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentService ;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function charge(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric',
            'gateway' => 'required|string',
        ]);

        $result = $this->paymentService->charge($validated);
        return response()->json($result);
    }

    public function handleWebhook(Request $request)
    {
        return $this->paymentService->webhook($request->all());
    }
}
