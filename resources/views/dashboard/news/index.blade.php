<x-dashboard-layout>




    @php
        $name = 'name_' . app()->getLocale();
        $title = 'title_' . app()->getLocale();
        $text = 'text_' . app()->getLocale();
        $keyword = 'keyword_' . app()->getLocale();

    @endphp
    @push('styles')
        <!-- data tables css -->
        <link rel="stylesheet" href="{{ asset('assets-dashboard/css/plugins/dataTables.bootstrap5.min.css') }}" />
    @endpush
    <x-slot:breadcrumbs>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">{{ __('Home') }}</a></li>
        <li class="breadcrumb-item" aria-current="page">{{ __('News') }}</li>
    </x-slot:breadcrumb>



    <!-- Both borders table start -->
    <div class="col-span-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="row">
                    <h5>{{ __('admin.News') }}</h5>
                </div>
                @can('create', 'App\Models\Nw')
                <div>
                    <a href="{{ route('dashboard.nw.create') }}" class="btn btn-primary">
                        {{ __('Add News') }}
                    </a>
                </div>
                @endcan
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <div class="row flex-1 ms-3">
                    <div class="form-group col-2 mb-3">
                        <x-form.input name="keyword" label="{{__('admin.Keyword')}}" type="text" placeholder="{{__('admin.enter news of keyword')}}" />
                    </div>
                    <div class="form-group col-2">
                        <x-form.input name="date" class="serch_form" label="{{ __('admin.Form Date') }}" type="date" placeholder="{{__('admin.enter artical of date')}}"/>
                    </div>
                    <div class="form-group col-2">
                        <x-form.input name="to_date" class="serch_form" label="{{ __('admin.To Date') }}"  type="date" placeholder="{{__('admin.enter artical of date')}}"/>
                    </div>
                    <div class="form-group col-3">
                        <label for="category_id" class="form-label">{{__('admin.category')}}</label>
                        <select id="category_id" name="category_id"  class="form-control serch_form">
                            <option value="" selected>{{__('admin.Choose')}}</option>
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

            @can('view', 'App\Models\Nw')
            <div class="card-body">
                <div class="dt-responsive table-responsive">
                    <table id="footer-search" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('admin.Title') }}</th>
                                <th>{{ __('admin.Publisher') }}</th>
                                <th>{{ __('admin.Category') }}</th>
                                <th>{{ __('admin. New Place') }}</th>
                                <th>{{ __('admin.Created') }}</th>
                                <th>{{ __('admin.Visit') }}</th>
                                <th>{{ __('admin.Status') }}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($news as $new)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $new->$title }}</td>
                                <td>{{ $new->publisher->name ?? '' }}</td>
                                            <td>
                @if(app()->getLocale() == 'ar')
                    {{ $artical->category->name_ar ?? '' }}
                @else
                    {{ $artical->category->name_en ?? '' }}
                @endif
            </td>
                                <td>{{ $new->newplace ? $new->newplace->name_en : '-' }}</td>
                                <td>{{ $new->created_at }}</td>
                                <td>{{ $new->visit}}</td>
                                <td>{{ $new->status == 1 ? __('admin.accept') : __('admin.not accepted yet') }}</td>

                                <td class="d-flex">
                                    <a href="{{ route('dashboard.nw.edit', $new->id) }}" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary">
                                        <i class="ti ti-edit text-xl leading-none"></i>
                                    </a>
                                    <form action="{{ route('dashboard.nw.destroy', $new->id) }}" method="post">
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
                scrollY: '200px',
                paging: false
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
                    let keyword = $('#keyword').val();
                    // let date = $('#date').val();
                    $.ajax({
                        url: '{{ route('dashboard.nw.index') }}',
                        method: 'GET',
                        data : {
                            date: date,
                            to_date: to_date,
                            category_id: category_id,
                            keyword: keyword,
                        },
                        success: function(data) {
                            $('#footer-search tbody').empty();
                            let newss = data.newss;
                            console.log(newss);

                            newss.forEach(function(newsItem,index) {
                                var row = `
                                    <tr>
                                        <td>${index + 1}</td>
                                        <td>${newsItem.title_ar}</td>
                                        <td>${newsItem.text_en}</td>
                                        <td>${newsItem.keyword_ar}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('dashboard.nw.edit', ':id') }}" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary">
                                                <i class="ti ti-edit text-xl leading-none"></i>
                                            </a>
                                            <form action="{{ route('dashboard.nw.destroy', ':id') }}" method="post">
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
                                row = row.replace(/:id/g, newsItem.id);

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
