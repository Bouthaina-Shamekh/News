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


                <div style="width: 100%; height: 500px; max-width: 1500px; margin: 0 auto;">
                    {!! $chartjs->render() !!}
                </div>
                
        </div>
        </div>
    </div>

    

    
    


    @push('scripts')
       

        <script src="{{ asset('assets-dashboard/js/plugins/apexcharts.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

          
    @endpush
    
</x-dashboard-layout>
