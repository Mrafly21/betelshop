@extends('layout.app')

@section('title', 'Request Become Seller')

@section('content')
<div class="py-5 bg-white">
    <div class="container">
        @if (session('message'))
            <div class="alert alert-warning">{{ session('message') }}</div>
            @endif
        <div class="row">
            <div class="col-md-12">
                <h4>Request to Become a Seller</h4>
                <div class="underline mb-5"></div>
                <form method="POST" action="{{ route('become-seller.submit') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Do you want to become a seller?</label>
                        <input type="checkbox" name="confirmation" id="confirmation" required>
                    </div>
                    <div class="mb-3">
                        <label for="contact_number" class="form-label">Contact Number:</label>
                        <input type="number" class="form-control" id="contact_number" name="contact_number" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Brief Description of Your Store:</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="What will you sell? Describe your store, why do you want to sell these items?" required></textarea>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="agreement" required>
                        <label class="form-check-label" for="agreement">I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">Terms and Conditions</a>.</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Insert your terms and conditions text here -->
                Please read the following terms and conditions carefully before agreeing to become a seller on our platform.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
