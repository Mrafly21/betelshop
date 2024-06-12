@extends('layout.admin')

@section('content')
    <div class="row">

        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Seller Reports</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Report ID</th>
                                    <th>User ID</th>
                                    <th>Seller ID</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reports as $report)
                                    <tr>
                                        <td>{{ $report->id }}</td>
                                        <td>{{ $report->user_id }}</td>
                                        <td>{{ $report->seller_id }}</td>
                                        <td>{{ $report->message }}</td>
                                        <td>{{ $report->status }}</td>
                                        <td>
                                            <form action="{{ route('admin.seller-reports.handle', ['id' => $report->id, 'action' => 'ignore']) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-secondary">Ignore</button>
                                            </form>
                                            <form action="{{ route('admin.seller-reports.handle', ['id' => $report->id, 'action' => 'warn']) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-warning">Warn</button>
                                            </form>
                                            <form action="{{ route('admin.seller-reports.handle', ['id' => $report->id, 'action' => 'ban']) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to ban this seller?')">Ban</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">No reports at this time</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
