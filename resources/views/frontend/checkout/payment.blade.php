@extends('layout.app')

@section('title', 'Checkout Payment')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Complete Your Payment</h4>
                </div>
                <div class="card-body text-center">
                    <div id="payment-button" class="my-4">
                        <button id="pay-button" class="btn btn-primary btn-lg">Pay Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script type="text/javascript">
    document.getElementById('payment-button').innerHTML = '<button id="pay-button" class="btn btn-primary">Pay Now</button>';

    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function (result) {
                alert('Payment success!');
                console.log(result);
                updateOrderPaymentMethod(result);
                window.location.href = '/thank-you';
            },
            onPending: function (result) {
                alert('Waiting for your payment!');
                console.log(result);
                updateOrderPaymentMethod(result);
            },
            onError: function (result) {
                alert('Payment failed!');
                console.log(result);
            },
            onClose: function () {
                alert('You closed the popup without finishing the payment');
            }
        });
    });

    function updateOrderPaymentMethod(result) {
        // Send the payment result to your backend to update the order
        fetch('/update-payment-method', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(result)
        }).then(response => response.json())
        .then(data => {
            console.log('Success:', data);
        }).catch((error) => {
            console.error('Error:', error);
        });
    }
</script>
@endsection
