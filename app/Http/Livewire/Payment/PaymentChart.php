<?php

namespace App\Http\Livewire\Payment;

use Livewire\Component;

class PaymentChart extends Component
{
    public function render()
    {
        $year = chartYear();
        $metrics = new \App\Helpers\Report();

        $payments = [
            'jan' => $metrics->paymentsByMonth(1, $year),
            'feb' => $metrics->paymentsByMonth(2, $year),
            'mar' => $metrics->paymentsByMonth(3, $year),
            'apr' => $metrics->paymentsByMonth(4, $year),
            'may' => $metrics->paymentsByMonth(5, $year),
            'jun' => $metrics->paymentsByMonth(6, $year),
            'jul' => $metrics->paymentsByMonth(7, $year),
            'aug' => $metrics->paymentsByMonth(8, $year),
            'sep' => $metrics->paymentsByMonth(9, $year),
            'oct' => $metrics->paymentsByMonth(10, $year),
            'nov' => $metrics->paymentsByMonth(11, $year),
            'dec' => $metrics->paymentsByMonth(12, $year),
        ];
        $credits = [
            'jan' => $metrics->creditsByMonth(1, $year),
            'feb' => $metrics->creditsByMonth(2, $year),
            'mar' => $metrics->creditsByMonth(3, $year),
            'apr' => $metrics->creditsByMonth(4, $year),
            'may' => $metrics->creditsByMonth(5, $year),
            'jun' => $metrics->creditsByMonth(6, $year),
            'jul' => $metrics->creditsByMonth(7, $year),
            'aug' => $metrics->creditsByMonth(8, $year),
            'sep' => $metrics->creditsByMonth(9, $year),
            'oct' => $metrics->creditsByMonth(10, $year),
            'nov' => $metrics->creditsByMonth(11, $year),
            'dec' => $metrics->creditsByMonth(12, $year),
        ];
        return view('livewire.payment.payment-chart', [
            'year' => $year,
            'payments' => $payments,
            'credits' => $credits,
        ]);
    }
}
