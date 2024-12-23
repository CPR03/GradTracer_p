<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ url('css/survey.css') }}">

    @vite('resources/js/app.js') @vite('resources/css/app.css')
</head>

<body>
    <div>
        @yield('donut')
    </div>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!-- ChartJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>

    <script>
        $(function() {
            /* ChartJS
             * -------
             * Here we will create a few charts using ChartJS
             */

            //--------------
            //- AREA CHART -
            //--------------

            // Get context with jQuery - using jQuery's .get() method.
            var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

            var areaChartData = {
                labels: ['2022', '2023', '2024', '2025', '2026', '2027', '2028'],
                datasets: [{
                        label: 'First Job',
                        backgroundColor: 'rgba(58,0,0,1)',
                        borderColor: 'rgba(58,0,0,1)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',

                        data: ["{{ $firstJob }}"]

                    },
                    {
                        label: 'Second Job',
                        backgroundColor: 'rgba(137,34,15,1)',
                        borderColor: 'rgba(137,34,15,1)',
                        pointRadius: false,
                        pointColor: 'rgba(210, 214, 222, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data: ["{{ $secondJob }}"]
                    },
                ]
            }

            var areaChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: false,
                        }
                    }]
                }
            }
            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = $.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            var temp1 = areaChartData.datasets[1]
            barChartData.datasets[0] = temp1
            barChartData.datasets[1] = temp0

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false
            }

            new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })

            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvass = $('#barCharts').get(0).getContext('2d')
            var barChartData = $.extend(true, {}, areaChartDatas)
            var temp0 = areaChartDatas.datasets[0]
            var temp1 = areaChartDatas.datasets[1]
            barChartData.datasets[0] = temp1
            barChartData.datasets[1] = temp0

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false
            }

            new Chart(barChartCanvass, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })
        })

        var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

        var areaChartDatas = {
            labels: ['2022', '2023', '2024', '2025', '2026', '2027', '2028'],
            datasets: [{
                    label: 'Students',
                    backgroundColor: 'rgba(58,0,0,1)',
                    borderColor: 'rgba(58,0,0,1)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(58,0,0,1)',

                    data: [
                        @foreach ($user as $students)
                            "{{ $students->count() }}"
                            @break
                        @endforeach
                    ]

                },
                {
                    label: 'Survey Taken',
                    backgroundColor: 'rgba(137,34,15,1)',
                    borderColor: 'rgba(137,34,15,1)',
                    pointRadius: false,
                    pointColor: 'rgba(210, 214, 222, 1)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(137,34,15,1)',
                    data: [
                        @foreach ($response as $survey_taken)
                            "{{ $survey_taken->count() }}"
                            @break
                        @endforeach
                    ]
                },
            ]
        }
    </script>
    <script>
        //-------------
        //- DONUT CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
        var donutData = {
            labels: [
                'Students',
                'Students Taken Survey',
            ],
            datasets: [{
                data: [
                    @foreach ($user as $students)
                        "{{ $students->count() }}"
                        @break
                    @endforeach ,
                    @foreach ($response as $survey_taken)
                        "{{ $survey_taken->count() }}"
                        @break
                    @endforeach
                ],
                backgroundColor: ['#3a0000', '#89220f'],
            }]
        }
        var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        })

        //-------------
        //- DONUT CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var donutChartCanvas = $('#donutCharts').get(0).getContext('2d')
        var donutData = {
            labels: [
                'Students',
                'Students Taken Survey',
            ],
            datasets: [{
                data: [700, 500],
                backgroundColor: ['#3a0000', '#89220f'],
            }]
        }
        var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        })
    </script>
</body>

</html>
