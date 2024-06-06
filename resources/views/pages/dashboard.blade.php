@extends ('layouts.dashboard')

@section('content')
    <div class="row my-2">
        <div class="col-sm-12 col-md-6">
            <div class="card iq-mb-3">
                <div class="card-body">
                    <h4 class="card-title">Monitoring Sensor DHT11</h4>
                    <div id="monitoringSuhu"></div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6">
            <div class="card iq-mb-3">
                <div class="card-body">
                    <h4 class="card-title">Monitoring Sensor DHT11</h4>
                    <div id="monitoringKelembapan"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row my-2">
        <div class="col-sm-12 col-md-6">
            <div class="card iq-mb-3">
                <div class="card-body">
                    <h4 class="card-title">Monitoring Sensor Gas</h4>
                    <div id="monitoringGas"></div>
                </div>
            </div>
        </div>


        <div class="col-sm-12 col-md-6">
            <div class="card iq-mb-3">
                <div class="card-body">
                    <h4 class="card-title">Monitoring Sensor Hujan</h4>
                    <div id="monitoringHujan"></div>
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between align-items-center">
                            <div class="iq-header-title">
                                <h4 class="card-title">Rain</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="table-responsive">
                                <table id="rain-table" class="table table-striped table-bordered mt-4" role="grid"
                                    aria-describedby="user-list-page-info">
                                    <thead>
                                        <tr>
                                            <th>Nilai</th>
                                            <th>Keterangan</th>
                                            <th>Created_at</th>
                                        </tr>
                                    </thead>
                                    <tbody id="rain-table-body">
                                        {{-- Data akan dimasukkan secara dinamis --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    {{-- DHT 11 --}}
    {{-- @push('scripts')
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script>
            let chartSuhu;

            async function requestData() {
                try {
                    const result = await fetch('http://127.0.0.1:8000/dht11');
                    if (result.ok) {
                        const data = await result.json();
                        console.log(data);

                        // Pastikan data yang diterima sesuai dengan yang diharapkan
                        if (data.created_at && data.suhu) {
                            const date = new Date(data.created_at).getTime();
                            const value = data.suhu;

                            const point = [date, value * 1]; // Misalnya, Anda mengalikan suhu dengan 10
                            const series = chartSuhu.series[0];
                            const shift = series.data.length > 20; // Shift if the series is longer than 20

                            // Add the point
                            chartSuhu.series[0].addPoint(point, true, shift);
                        } else {
                            console.error('Data format is incorrect', data);
                        }

                        // Call it again after one second
                        setTimeout(requestData, 5000);
                    } else {
                        console.error('Network response was not ok', result.statusText);
                    }
                } catch (error) {
                    console.error('Fetch error:', error);
                }
            }

            // Mulai permintaan data saat halaman dimuat
            requestData();

            window.addEventListener('load', function() {
                chartSuhu = new Highcharts.Chart({
                    chart: {
                        renderTo: 'monitoringSuhu',
                        defaultSeriesType: 'spline',
                        events: {
                            load: requestData
                        }
                    },
                    title: {
                        text: 'Suhu & Waktu'
                    },
                    xAxis: {
                        type: 'datetime',
                        tickPixelInterval: 150,
                        maxZoom: 20 * 1000
                    },
                    yAxis: {
                        minPadding: 0.2,
                        maxPadding: 0.2,
                        title: {
                            text: 'Suhu (°C)',
                            margin: 80
                        }
                    },
                    series: [{
                        name: 'DHT 11',
                        data: []
                    }]
                });
            });
        </script>
    @endpush --}}

    {{-- Suhu --}}
    @push('scripts')
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script>
            let chartSuhu; // global

            async function requestDataSuhu() {
                try {
                    const result = await fetch("{{ route('latest_dht11') }}"); // Ganti dengan URL endpoint API suhu Anda
                    if (result.ok) {
                        const data = await result.json();
                        console.log(data);

                        // Pastikan data yang diterima sesuai dengan yang diharapkan
                        if (data.created_at && data.suhu) {
                            const date = new Date(data.created_at).getTime();
                            const value = parseFloat(data.suhu);

                            const point = [date, value];
                            const series = chartSuhu.series[0];
                            const shift = series.data.length > 20; // Shift if the series is longer than 20

                            // Add the point
                            chartSuhu.series[0].addPoint(point, true, shift);
                        } else {
                            console.error('Data format is incorrect', data);
                        }

                        // Call it again after five seconds
                        setTimeout(requestDataSuhu, 5000);
                    } else {
                        console.error('Network response was not ok', result.statusText);
                    }
                } catch (error) {
                    console.error('Fetch error:', error);
                }
            }

            // Initialize the chart when the window loads
            window.addEventListener('load', function() {
                chartSuhu = new Highcharts.Chart({
                    chart: {
                        renderTo: 'monitoringSuhu',
                        type: 'spline',
                        events: {
                            load: requestDataSuhu // Start the data fetching when the chart is loaded
                        }
                    },
                    title: {
                        text: 'Suhu & Waktu'
                    },
                    xAxis: {
                        type: 'datetime',
                        tickPixelInterval: 150,
                        maxZoom: 20 * 1000 // max zoom is 20 seconds
                    },
                    yAxis: {
                        minPadding: 0.2,
                        maxPadding: 0.2,
                        title: {
                            text: 'Suhu (°C)',
                            margin: 80
                        }
                    },
                    series: [{
                        name: 'DHT 11',
                        data: []
                    }]
                });
            });
        </script>
    @endpush

    {{-- Kelembapan --}}
    @push('scripts')
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script>
            let chartKelembapan; // global

            async function requestDataKelembapan() {
                try {
                    const result = await fetch("{{ route('latest_kelembapan') }}");
                    if (result.ok) {
                        const data = await result.json();
                        console.log(data);

                        // Pastikan data yang diterima sesuai dengan yang diharapkan
                        if (data.created_at && data.kelembapan) {
                            const date = new Date(data.created_at).getTime();
                            const value = parseFloat(data.kelembapan);

                            const point = [date, value];
                            const series = chartKelembapan.series[0];
                            const shift = series.data.length > 20; // Shift if the series is longer than 20

                            // Add the point
                            chartKelembapan.series[0].addPoint(point, true, shift);
                        } else {
                            console.error('Data format is incorrect', data);
                        }

                        // Call it again after five seconds
                        setTimeout(requestDataKelembapan, 5000);
                    } else {
                        console.error('Network response was not ok', result.statusText);
                    }
                } catch (error) {
                    console.error('Fetch error:', error);
                }
            }

            // Initialize the chart when the window loads
            window.addEventListener('load', function() {
                chartKelembapan = new Highcharts.Chart({
                    chart: {
                        renderTo: 'monitoringKelembapan',
                        type: 'spline',
                        events: {
                            load: requestDataKelembapan // Start the data fetching when the chart is loaded
                        }
                    },
                    title: {
                        text: 'Kelembapan & Waktu'
                    },
                    xAxis: {
                        type: 'datetime',
                        tickPixelInterval: 150,
                        maxZoom: 20 * 1000 // max zoom is 20 seconds
                    },
                    yAxis: {
                        minPadding: 0.2,
                        maxPadding: 0.2,
                        title: {
                            text: 'Kelembapan (%)',
                            margin: 80
                        }
                    },
                    series: [{
                        name: 'DHT 11',
                        data: []
                    }]
                });
            });
        </script>
    @endpush


    {{-- MQ5 --}}
    @push('scripts')
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script>
            let chartGas;
            async function requestData() {
                try {
                    const result = await fetch("{{ route('latest_mq5') }}");
                    if (result.ok) {
                        const data = await result.json();
                        console.log(data);

                        // Pastikan data yang diterima sesuai dengan yang diharapkan
                        if ((data.created_at != null) &&  (data.nilai_gas !=null)) {
                            const date = new Date(data.created_at).getTime();
                            const value = data.nilai_gas;

                            const point = [date, value * 1]; // Misalnya, Anda mengalikan suhu dengan 10
                            const series = chartGas.series[0];
                            const shift = series.data.length > 20; // Shift if the series is longer than 20

                            // Add the point
                            chartGas.series[0].addPoint(point, true, shift);
                        } else {
                            console.error('Data format is incorrect', data);
                        }

                        // Call it again after one second
                        setTimeout(requestData, 5000);
                    } else {
                        console.error('Network response was not ok', result.statusText);
                    }
                } catch (error) {
                    console.error('Fetch error:', error);
                }
            }

            // Mulai permintaan data saat halaman dimuat
            requestData();

            window.addEventListener('load', function() {
                chartGas = new Highcharts.Chart({
                    chart: {
                        renderTo: 'monitoringGas',
                        defaultSeriesType: 'spline',
                        events: {
                            load: requestData
                        }
                    },
                    title: {
                        text: 'Gas & Waktu'
                    },
                    xAxis: {
                        type: 'datetime',
                        tickPixelInterval: 150,
                        maxZoom: 20 * 1000
                    },
                    yAxis: {
                        minPadding: 0.2,
                        maxPadding: 0.2,
                        title: {
                            text: 'Gas (ppm)',
                            margin: 80
                        }
                    },
                    series: [{
                        name: 'MQ5',
                        data: []
                    }]
                });
            });
        </script>
    @endpush

    {{-- Rain --}}
    @push('scripts')
        <script>
            async function fetchRainData() {
                try {
                    const response = await fetch("{{ route('latest_rain') }}");
                    if (response.ok) {
                        const data = await response.json();
                        updateRainTable(data);
                    } else {
                        console.error('Network response was not ok', response.statusText);
                    }
                } catch (error) {
                    console.error('Fetch error:', error);
                }
            }

            function updateRainTable(data) {
                const tableBody = document.getElementById('rain-table-body');
                // Clear existing rows
                tableBody.innerHTML = '';

                // Insert new row
                const row = document.createElement('tr');
                row.innerHTML = `
                <td>${data.nilai_rain !== null ? data.nilai_rain : 'N/A'}</td>
                <td>${data.status}</td>
                <td>${data.created_at}</td>
            `;
                tableBody.appendChild(row);
            }

            // Fetch data every 3 seconds
            setInterval(fetchRainData, 3000);

            // Initial fetch
            fetchRainData();
        </script>
    @endpush
