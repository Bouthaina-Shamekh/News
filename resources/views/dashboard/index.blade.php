<x-dashboard-layout>

<div class="col-span-12">
        <div class="card welcome-banner bg-primary-800">
        <div class="absolute opacity-50 inset-0 z-10 bg-right-bottom bg-[length:100%] bg-no-repeat bg-[url('../images/widget/img-dropbox-bg.svg')] "></div>
        <div class="card-body relative z-20">
            <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 sm:col-span-6">
                
            </div>
           
            </div>

            <div class="row">
                    
            <div class="col-xl-3 col-md-6 mb-3">
    <div class="card border-left-info shadow h-100 py-2 bg-light"> <!-- لون فاتح -->
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                        {{ __('admin.Add') }}
                    </div>
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                {{ $ad_count }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-tags fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-md-6 mb-3">
    <div class="card border-left-info shadow h-100 py-2 bg-info-subtle"> <!-- لون فاتح أزرق -->
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                        {{ __('admin.Articale') }}
                    </div>
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                {{ $a_count }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-tags fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-md-6 mb-3">
    <div class="card border-left-info shadow h-100 py-2 bg-warning-subtle"> <!-- لون فاتح أصفر -->
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                        {{ __('admin.News') }}
                    </div>
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                {{ $n_count }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-tags fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="col-xl-3 col-md-6 mb-3">
    <div class="card border-left-info shadow h-100 py-2 bg-info-subtle"> <!-- لون فاتح أزرق -->
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                        {{ __('admin.Publisher')}}
                    </div>
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                {{ $p_count }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-tags fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>


                </div>
        </div>
        </div>
    </div>

    <div class="col-span-12 md:col-span-6">
        <div class="card">
            <div class="card-header">
                <h5>{{__('admin.Visits')}}</h5>
            </div>
            <div class="card-body">
                <div id="line-chart-1"></div>
            </div>
        </div>
    </div>

    <div class="col-span-12 md:col-span-6">
        <div class="card">
            <div class="card-header">
                <h5>{{ __('admin.Visits In Month') }}</h5>
            </div>
            <div class="card-body">
                <div id="bar-chart-1"></div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('assets-dashboard/js/plugins/apexcharts.min.js') }}"></script>
        <script>
            const days = {!! json_encode($days) !!};
            const daysVisits = {!! json_encode($daysVisits) !!};
            const months = {!! json_encode($months) !!};
            const monthsVisits = {!! json_encode($monthsVisits) !!};
            setTimeout(function() {
                (function() {
                    var options = {
                        chart: {
                            height: 300,
                            type: 'line',
                            zoom: {
                                enabled: false
                            }
                        },
                        dataLabels: {
                            enabled: false,
                            width: 2
                        },
                        stroke: {
                            curve: 'straight'
                        },
                        colors: ['#4680FF'],
                        series: [{
                            name: "{{ __('admin.Visits') }}",
                            data: daysVisits
                        }],
                        grid: {
                            row: {
                                colors: ['#f3f6ff', 'transparent'],
                                opacity: 0.5
                            }
                        },
                        xaxis: {
                            categories: days
                        }
                    };
                    var chart = new ApexCharts(document.querySelector('#line-chart-1'), options);
                    chart.render();
                    // bar chart 1
                    var options_bar_chart_1 = {
                        chart: {
                            height: 350,
                            type: 'bar'
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: '55%',
                                endingShape: 'rounded'
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        colors: ['#2CA87F', '#4680FF', '#13c2c2'],
                        stroke: {
                            show: true,
                            width: 2,
                            colors: ['transparent']
                        },
                        series: [
                            {
                                name: "{{ __('admin.Visits') }}",
                                data: monthsVisits
                            },
                        ],
                        xaxis: {
                            categories: months
                        },
                        fill: {
                            opacity: 1
                        },
                        tooltip: {
                            y: {
                                formatter: function(val) {
                                    return val + ' visits';
                                }
                            }
                        }
                    };
                    var chart_bar_chart_1 = new ApexCharts(document.querySelector('#bar-chart-1'),
                        options_bar_chart_1);
                    chart_bar_chart_1.render();
                })();
            }, 700);
        </script>
    @endpush
    
</x-dashboard-layout>
