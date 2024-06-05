@extends('layout.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Do You Need Any Help?</h2>
            <p>If you have any questions or need assistance, please feel free to reach out to us using the form below. Our team is here to help you!</p>
        </div>
        <div class="col-md-6">
            <form action="{{ route('send.message') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Your Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Your Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="message">Your Message:</label>
                    <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>
        </div>
    </div>
</div>
@endsection
