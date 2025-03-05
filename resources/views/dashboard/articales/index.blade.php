<x-dashboard-layout>
    @php
    $name = 'name_' . app()->getLocale();
    $title = 'title_' . app()->getLocale();
    @endphp
    @push('styles')
    <!-- data tables css -->
    <link rel="stylesheet" href="{{ asset('assets-dashboard/css/plugins/dataTables.bootstrap5.min.css') }}" />
    <style>
        .title{
            width: 100px;
            display: block;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
        .title:hover{
            width: auto;
            display: block;
            overflow: visible;
            white-space: normal;
            text-overflow: clip;
        }
    </style>
    @endpush
    <x-slot:breadcrumbs>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">{{ __('Home') }}</a></li>
        <li class="breadcrumb-item" aria-current="page">{{ __('Articale') }}</li>
        </x-slot:breadcrumb>



        <!-- Both borders table start -->
        <div class="col-span-12">
            <div class="card">
                @can('create', 'App\Models\Artical')
                <div class="card-header d-flex justify-content-between">
                    <div class="row">
                        <h5>{{ __('admin.Articles') }}</h5>
                    </div>
                    <div>
                        <a href="{{ route('dashboard.articale.create') }}" class="btn btn-primary">
                            {{ __('admin.Add Articles') }}
                        </a>
                    </div>
                </div>
                @endcan

                <div class="d-flex justify-content-between align-items-end">
                    <div class="row flex-1 ms-3">
                        <div class="form-group col-2">
                            <x-form.input name="date" class="serch_form" label="{{ __('admin.From Date') }}" type="date" placeholder="{{__('admin.enter artical of date')}}" />
                        </div>
                        <div class="form-group col-2">
                            <x-form.input name="to_date" class="serch_form" label="{{ __('admin.To Date') }}" type="date" placeholder="{{__('admin.enter artical of date')}}" />
                        </div>
                        <div class="form-group col-3">
                            <label for="category_id" class="form-label">{{__('admin.Category')}}</label>
                            <select id="category_id" name="category_id" class="form-control serch_form">
                                <option value="" selected>{{__('admin.Choose category')}}</option>
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->$name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end me-2">
                        <button class="btn btn-primary" id="search">{{__('admin.Search')}}</button>
                    </div>
                </div>

                @can('view', 'App\Models\Artical')
                <div class="card-body">
                    <div class="dt-responsive table-responsive">
                        <table id="footer-search" class="table table-striped table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th></th>

                                    <th>{{ __('admin.Title') }}</th>
                                    <th>{{ __('admin.Publisher') }}</th>
                                    <th>{{ __('admin.Category') }}</th>
                                    <th>{{ __('admin.Date') }}</th>
                                    <th>{{ __('admin.Created') }}</th>
                                    <th>{{ __('admin.Visit') }}</th>
                                    <th>{{ __('admin.Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($articals as $artical)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($artical->img_view)
                                            @if(Storage::disk('public')->exists($artical->img_view))
                                            <img src="{{ asset('storage/' . $artical->img_view) }}" width="50" alt="Image">
                                            @else
                                            {{ __('No Image') }}
                                            @endif
                                        @else
                                            {{ __('No Image') }}
                                        @endif
                                    </td>
                                    <td>
                                        <span class="title">{{ $artical->$title }}</span>
                                    </td>
                                    <td>{{ $artical->publisher->name ?? '' }}</td>
                                    <td>
                                        @if(app()->getLocale() == 'ar')
                                            {{ $artical->category->name_ar ?? '' }}
                                        @else
                                            {{ $artical->category->name_en ?? '' }}
                                        @endif
                                    </td>
                                    <td>{{ $artical->date}}</td>
                                    <td>{{ $artical->created_at}}</td>
                                    <td>{{ $artical->visit }}</td>
                                    <td>{{ $artical->status == 1 ? __('admin.accept') : __('admin.not accepted yet') }}</td>

                                    <td class="d-flex">
                                        <a href="{{ route('dashboard.articale.edit', $artical->id) }}" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary">
                                            <i class="ti ti-edit text-xl leading-none"></i>
                                        </a>
                                        <form action="{{ route('dashboard.articale.destroy', $artical->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary" title="{{ __('Delete') }}">
                                                <i class="ti ti-trash text-xl leading-none"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                @endcan
            </div>
        </div>
        <!-- Both borders table end -->
        @push('scripts')
        <script src="{{ asset('assets-dashboard/js/plugins/dataTables.min.js') }}"></script>
        <script src="{{ asset('assets-dashboard/js/plugins/dataTables.bootstrap5.min.js') }}"></script>

        <script>
            // [ Add Rows ]
            var t = $('#add-row-table').DataTable();

            var table = $('#footer-search').DataTable();

            // [ Individual Column Searching (Select Inputs) ]
            $('#footer-select').DataTable({
                initComplete: function() {
                    this.api()
                        .columns()
                        .every(function() {
                            var column = this;
                            var select = $(
                                    '<select class="form-control form-control-sm"><option value=""></option></select>'
                                )
                                .appendTo($(column.footer()).empty())
                                .on('change', function() {
                                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                                    column.search(val ? '^' + val + '$' : '', true, false).draw();
                                });

                            column
                                .data()
                                .unique()
                                .sort()
                                .each(function(d, j) {
                                    select.append('<option value="' + d + '">' + d + '</option>');
                                });
                        });
                }
            });


            function format(d) {
                return (
                    '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
                    '<tr>' +
                    '<td>Full name:</td>' +
                    '<td>' +
                    d.name +
                    '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Extension number:</td>' +
                    '<td>' +
                    d.extn +
                    '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Extra info:</td>' +
                    '<td>And any further details here (images etc)...</td>' +
                    '</tr>' +
                    '</table>'
                );
            }

            // [ Form input ]
            var table = $('#form-input-table').DataTable();

            $('#form-input-btn').on('click', function() {
                var data = table.$('input, select').serialize();
                alert('The following data would have been submitted to the server: \n\n' + data.substr(0, 120) + '...');
                return false;
            });

            // [ Show-hide table js ]
            var sh = $('#show-hide-table').DataTable({
                scrollY: '200px'
                , paging: false
            });

            $('a.toggle-vis').on('click', function(e) {
                e.preventDefault();

                // Get the column API object
                var column = sh.column($(this).attr('data-column'));

                // Toggle the visibility
                column.visible(!column.visible());
            });

            // [ Search API ]
            function filterGlobal() {
                $('#search-api')
                    .DataTable()
                    .search($('#global_filter').val(), $('#global_regex').prop('checked'), $('#global_smart').prop('checked'))
                    .draw();
            }

            function filterColumn(i) {
                $('#search-api')
                    .DataTable()
                    .column(i)
                    .search($('#col' + i + '_filter').val(), $('#col' + i + '_regex').prop('checked'), $('#col' + i + '_smart')
                        .prop('checked'))
                    .draw();
            }

            $('#search-api').DataTable();

            $('input.global_filter').on('keyup click', function() {
                filterGlobal();
            });

            $('input.column_filter').on('keyup click', function() {
                filterColumn($(this).parents('tr').attr('data-column'));
            });

        </script>
        <script>
            $(document).ready(function() {
                $('#search').on('click', function() {
                    let date = $('#date').val();
                    let to_date = $('#to_date').val();
                    let category_id = $('#category_id').val();
                    // let date = $('#date').val();
                    $.ajax({
                        url: '{{ route('dashboard.articale.index')}}'
                        , method: 'GET'
                        , data: {
                            date: date
                            , to_date: to_date
                            , category_id: category_id
                        , }
                        , success: function(data) {
                            console.log(data);
                            $('#footer-search tbody').empty();
                            let articals = data.articals;
                            articals.forEach(function(artical, index) {
                                var row = `
                                    <tr>
                                        <td>${index + 1}</td>
                                        <td>${artical.title_ar}</td>
                                        <td>${artical.text_en}</td>
                                        <td>${artical.text_ar}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('dashboard.articale.edit', ':id') }}" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary">
                                                <i class="ti ti-edit text-xl leading-none"></i>
                                            </a>
                                            <form action="{{ route('dashboard.articale.destroy', ':id') }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary" title="{{ __('Delete') }}">
                                                    <i class="ti ti-trash text-xl leading-none"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                `;

                                // Replace ':id' in both the edit link and the destroy action URL
                                row = row.replace(/:id/g, artical.id);

                                // Append the row to the table
                                $('#footer-search tbody').append(row);
                            });

                            $('#footer-search_info').empty();
                            $('.paging_full_numbers').empty();
                        }
                    });
                });

            });

        </script>
        @endpush


</x-dashboard-layout>
