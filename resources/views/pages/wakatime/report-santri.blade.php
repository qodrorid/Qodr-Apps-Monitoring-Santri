@extends('templates.base')

@section('content')

@include('components.page-header', [
    'title' => 'Report Tracking',
    'subtitle' => 'Report wakatime per week',
    'breadcrumb' => [
        'wakatime',
        'report tracking'
    ]
])

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Coding Activity</h5>
                    <span>Statistic coding activity per week, standart <code>8 hours</code></span>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-minus minimize-card"></i></li>
                            <li><i class="feather icon-maximize full-card"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-block">
                    <canvas id="codingActivity" style="width: 100%; height: 330px"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Languages</h5>
                    <span>languages report</span>
                </div>
                <div class="card-block">
                    <canvas id="languages" style="width: 100%; height: 300px"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Editors</h5>
                    <span>editors report</span>
                </div>
                <div class="card-block">
                    <canvas id="editors" style="width: 100%; height: 300px"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
{{ HTML::script('plugins/chart.js/Chart.js') }}
<script>
(function() {

    var codingActivity = {
        labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
        datasets: [{
            backgroundColor: '#25A6F7',
            hoverBackgroundColor: '#6cc4fb',
            data: {!! $report->codingActivity !!},
            fill: false
        }]
    };

    var codingActivityElemt = document.getElementById("codingActivity").getContext('2d');
    new Chart(codingActivityElemt, {
        type: 'bar',
        data: codingActivity,
        options: {
            responsive: true,
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    })

    var languagesElemt = document.getElementById("languages");
    var languages = {
        labels: {!! json_encode($report->languages->pluck('name')->toArray()) !!},
        datasets: [{
            data: {!! json_encode($report->languages->pluck('percent')->toArray()) !!},
            backgroundColor: [
                '#25A6F7',
                '#FB9A7D',
                '#01C0C8',
                '#EF5350',
                '#EC407A',
                '#9C27B0',
                '#673AB7',
                '#3F51B5',
                '#2196F3',
                '#00BCD4',
                '#009688',
                '#CDDC39',
                '#FFEB3B'
            ],
            hoverBackgroundColor: [
                '#6cc4fb',
                '#ffb59f',
                '#0dedf7',
                '#F06292',
                '#E57373',
                '#BA68C8',
                '#9575CD',
                '#7986CB',
                '#64B5F6',
                '#4DD0E1',
                '#4DB6AC',
                '#DCE775',
                '#FFF176'
            ]
        }]
    };

    new Chart(languagesElemt, {
        type: 'pie',
        data: languages,
        options: {
            legend: {
                position: 'bottom',
                labels: {
                    boxWidth: 12,
                    padding: 20
                }
            }
        }
    });

    var editorsElemt = document.getElementById("editors");
    var editors = {
        labels: {!! json_encode($report->editors->pluck('name')->toArray()) !!},
        datasets: [{
            data: {!! json_encode($report->editors->pluck('percent')->toArray()) !!},
            backgroundColor: [
                "#25A6F7",
                "#FB9A7D",
                "#01C0C8"
            ],
            hoverBackgroundColor: [
                "#6cc4fb",
                "#ffb59f",
                "#0dedf7"
            ]
        }]
    };

    new Chart(editorsElemt, {
        type: 'pie',
        data: editors,
        options: {
            legend: {
                position: 'bottom',
                labels: {
                    boxWidth: 12,
                    padding: 20
                }
            }
        }
    });
})()
</script>
@endsection