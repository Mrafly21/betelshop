@extends('layout.app')

@section('title', 'Profile')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h4>Profile</h4>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <p>Email: {{ $user->email }}</p>
                    <p>Username: {{ $user->name }}</p>
                    <p>Phone Number: {{ $user->contact_number }}</p>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit</button>
                    <a href="{{ route('profile.show-change-password-form') }}" class="btn btn-secondary">Change Password</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('profile.update') }}" method="POST" onsubmit="return concatenatePhoneNumber()">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Username</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="contact_number" class="form-label">Phone Number</label>
                        <div class="input-group">
                            <select name="country_code" id="country_code" class="form-select" style="max-width: 40%;" required>
                                <!-- Options will be populated by JavaScript -->
                            </select>
                            <input type="text" name="contact_number" class="form-control" id="contact_number" value="{{ substr($user->contact_number, strlen($user->country_code)) }}" placeholder="85222332" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
function concatenatePhoneNumber() {
    var countryCode = document.getElementById('country_code').value;
    var contactNumber = document.getElementById('contact_number').value;
    document.getElementById('contact_number').value = countryCode + contactNumber;
    return true;
}

document.addEventListener('DOMContentLoaded', function() {
    fetch('https://restcountries.com/v3.1/all')
        .then(response => response.json())
        .then(data => {
            var countrySelect = document.getElementById('country_code');
            var countries = data.filter(country => country.idd && country.idd.root);
            countries.sort((a, b) => a.name.common.localeCompare(b.name.common));
            countries.forEach(country => {
                var countryCode = country.idd.root + (country.idd.suffixes ? country.idd.suffixes[0] : '');
                var option = document.createElement('option');
                option.value = countryCode.replace(/\s/g, ''); // Remove any spaces
                option.textContent = `${country.name.common} (${countryCode})`;
                countrySelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching country data:', error));
});
</script>
@endpush
