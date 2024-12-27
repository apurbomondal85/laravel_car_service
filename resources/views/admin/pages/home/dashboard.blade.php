@extends('admin.layouts.master')

@section('title', 'Dashboard')

@push('styles')
    <style>
        .background-primary {
            background: #4ACE8B !important;
        }

        .card .card-body {
            padding: 0 1.25rem 1.25rem;
        }

        #piechart {
            padding-top: 50px;
        }

        @media only screen and (min-width: 960px) {

            #piechart,
            #curve_chart {
                height: 400px;
            }
        }

        @media only screen and (min-width: 1440px) {

            #piechart,
            #curve_chart {
                height: 400px;
            }
        }

        @media only screen and (max-device-width: 480px) {

            #piechart,
            #curve_chart {
                height: 250px;
            }
        }

        @media only screen and (device-width: 768px) {

            #piechart,
            #curve_chart {
                height: 250px;
            }
        }

        /* different techniques for iPad screening */
        @media only screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait) {

            #piechart,
            #curve_chart {
                height: 250px;
            }
        }

        @media only screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape) {

            #piechart,
            #curve_chart {
                height: 250px;
            }
        }
    </style>
@endpush

@section('content')

    <div class="content-wrapper">

        <div class="content-header d-flex justify-content-between">
            <div class="d-block">
                <h4 class="content-title text-blod" style="font-size: 20px;">DASHBOARD</h4>
            </div>
        </div>

        <section>
            <div class="row">
                <div class="col-lg-4 stretch-card mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div style="font-size: 15px; font-weight: bold;" class="table-responsive pt-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center text-white background-primary">
                                            <th colspan="2" style="font-size: 20px; font-weight: bold;">
                                                Subscription Earning
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr style="font-size: 15px; font-weight: bold;" class="table-danger">
                                            <td>
                                                Due Amount
                                            </td>
                                            <td>
                                               0
                                            </td>
                                        <tr style="font-size: 15px; font-weight: bold;" class="table-primary">
                                            <td>
                                                Received
                                            </td>
                                            <td>
                                                0
                                            </td>
                                        </tr>

                                        <tr style="font-size: 15px; font-weight: bold;" class="table-success">
                                            <td>
                                                Last Year Received
                                            </td>
                                            <td>
                                                0
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 stretch-card mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div style="font-size: 15px; font-weight: bold;" class="table-responsive pt-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center text-white background-primary">
                                            <th colspan="2" style="font-size: 20px; font-weight: bold;">
                                                Members
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr style="font-size: 15px; font-weight: bold;" class="table-primary">
                                            <td>
                                                New Member
                                            </td>
                                            <td>
                                                {{ $newMember }}
                                            </td>
                                        </tr>
                                        <tr style="font-size: 15px; font-weight: bold;" class="table-success">
                                            <td>
                                                Active Member
                                            </td>
                                            <td>
                                                {{ $activeMember }}
                                            </td>
                                        </tr>

                                        <tr style="font-size: 15px; font-weight: bold;" class="table-danger">
                                            <td>
                                                Inactive Member
                                            </td>
                                            <td>
                                                {{ $inactiveMember }}
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 stretch-card mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div style="font-size: 15px; font-weight: bold;" class="table-responsive pt-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center text-white background-primary">
                                            <th colspan="2" style="font-size: 20px; font-weight: bold;">
                                                Others
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr style="font-size: 15px; font-weight: bold;" class="table-danger">
                                            <td>
                                                New Event
                                            </td>
                                            <td>
                                                {{ $event }}
                                            </td>
                                        </tr>
                                        <tr style="font-size: 15px; font-weight: bold;" class="table-success">
                                            <td>
                                                New Blog
                                            </td>
                                            <td>
                                                {{ $blog }}
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="row">
                <div class="col-lg-4 col-sm-12 col-12 stretch-card mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div id="piechart"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-sm-12 col-12 stretch-card mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div id="curve_chart"></div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

    </div>

@stop

@push('scripts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['Active', {{ $activeMember }}],
                ['Inactive', {{ $inactiveMember }}],
            ]);

            var options = {
                title: 'Active inactive members',
                width: '100%',
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>

    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Month', 'Sign up'],
                @foreach ($monthlySignup as $key => $rows)
                    ['{{ $key }}', {{ $rows }}],
                @endforeach
            ]);

            var options = {
                title: 'Online Membership Sign Up',
                curveType: 'function',
                legend: {
                    position: 'bottom'
                },
                width: '100%',
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
            chart.draw(data, options);
        }
    </script>
@endpush
