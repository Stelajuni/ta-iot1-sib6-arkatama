@extends ('layouts.dashboard')

@section('content')
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between align-items-center">
            <div class="iq-header-title">
                <h4 class="card-title">DHT 11</h4>
            </div>
        </div>
        <div class="iq-card-body">
            <div class="table-responsive">
                <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid"
                    aria-describedby="user-list-page-info">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Suhu</th>
                            <th>Kelembapan</th>
                            <th>Created_at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dht11 as $sensor)
                            <tr>

                                <td>{{ $sensor['id'] }}</td>
                                <td>{{ $sensor['name'] }}</td>
                                <td>{{ $sensor['suhu'] }}</td>
                                <td>{{ $sensor['kelembapan'] }}</td>
                                <td>{{ $sensor->created_at->format('d M Y, H:i:s') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between align-items-center">
            <div class="iq-header-title">
                <h4 class="card-title">MQ-5</h4>
            </div>
        </div>
        <div class="iq-card-body">
            <div class="table-responsive">
                <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid"
                    aria-describedby="user-list-page-info">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Nilai Gas</th>
                            <th>Created_at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mq5 as $sensor)
                            <tr>
                                <td>{{ $sensor['id'] }}</td>
                                <td>{{ $sensor['name'] }}</td>
                                <td>{{ $sensor['nilai_gas'] }}</td>
                                <td>{{ $sensor->created_at->format('d M Y, H:i:s') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between align-items-center">
            <div class="iq-header-title">
                <h4 class="card-title">Rain Sensor</h4>
            </div>
        </div>
        <div class="iq-card-body">
            <div class="table-responsive">
                <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid"
                    aria-describedby="user-list-page-info">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Nilai Hujan</th>
                            <th>Created_at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rain as $sensor)
                            <tr>
                                <td>{{ $sensor['id'] }}</td>
                                <td>{{ $sensor['name'] }}</td>
                                <td>{{ $sensor['nilai_rain'] }}</td>
                                <td>{{ $sensor->created_at->format('d M Y, H:i:s') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
