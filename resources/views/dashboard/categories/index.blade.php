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
        <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">{{ __('admin.Home') }}</a></li>
        <li class="breadcrumb-item" aria-current="page">{{ __('admin.Category') }}</li>
    </x-slot:breadcrumb>



    <!-- Both borders table start -->
    <div class="col-span-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="row">
                    <h5>{{ __('admin.Category') }}</h5>
                </div>
                @can('create', 'App\Models\Category')
                <div>
                    <a href="{{ route('dashboard.category.create') }}" class="btn btn-primary">
                        {{ __('admin.Add Category') }}
                    </a>
                </div>
                @endcan
            </div>
            @can('view', 'App\Models\Category')
            <div class="card-body">
                <div class="dt-responsive table-responsive">
                <table id="footer-search" class="table table-striped table-bordered nowrap">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ __('admin.Name_AR') }}</th>
            <th>{{ __('admin.Name_EN') }}</th>
            <th>{{ __('admin.Actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $category->name_ar }}</td>
            <td>{{ $category->name_en }}</td>
            <td>
                <a href="{{ route('dashboard.category.edit', $category->id) }}" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary">
                    <i class="ti ti-edit text-xl leading-none"></i>
                </a>
               

                <form action="{{ route('dashboard.category.destroy', $category->id) }}" method="post" class="delete-form">
    @csrf
    @method('DELETE')
    <button type="submit" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary" title="{{ __('admin.Delete') }}">
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
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            const confirmMessage = @json(__('admin.confirm_delete'));
            if (!confirm(confirmMessage)) {
                e.preventDefault();
            }
        });
    });
</script>


    @endpush


</x-dashboard-layout>
