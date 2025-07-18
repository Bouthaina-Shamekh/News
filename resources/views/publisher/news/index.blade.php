<x-publisher-layout>
    @php
        $name = 'name_' . app()->getLocale();
        $title = 'title_' . app()->getLocale();
        $text = 'text_' . app()->getLocale();
        $keyword = 'keyword_' . app()->getLocale();
    @endphp
    @push('styles')
    <!-- data tables css -->
    <link rel="stylesheet" href="{{ asset('assets-dashboard/css/plugins/dataTables.bootstrap5.min.css') }}" />
    <style>
        .title {
            width: 303px;
            display: block;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
        .title:hover {
            width: auto;
            display: block;
            overflow: visible;
            white-space: normal;
            text-overflow: clip;
        }
        .filters-container {
            display: flex;
            align-items: center;
            gap: 5px; /* تقليل التباعد بين العناصر */
            margin-bottom: 20px;
            flex-wrap: wrap; /* منع الانتقال إلى سطر جديد */
            margin: 20px;
        }
        .filter-item {
            display: flex;
            align-items: center;
            gap: 5px;
            flex: 1; /* جعل العناصر تأخذ مساحة متساوية */
        }
        .filter-item label {
            font-weight: bold;
            white-space: nowrap;
            margin-bottom: 0;
            font-size: 14px; /* تكبير حجم النص */
        }
        .filter-item input,
        .filter-item select {
            padding: 6px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 120px; /* تقليل عرض العناصر */
            font-size: 14px; /* تكبير حجم النص */
        }
        #search {
            background-color: #28a745; /* Green color */
            color: white;
            border: none;
            padding: 6px 12px;
            font-size: 14px; /* تكبير حجم النص */
            cursor: pointer;
            border-radius: 4px;
            white-space: nowrap; /* منع الانتقال إلى سطر جديد */
            margin-left: 5px; /* نفس مسافة التباعد بين الفلاتر */
        }
        #search:hover {
            background-color: #218838; /* Darker green on hover */
        }
    </style>
    @endpush

    <x-slot:breadcrumbs>
        <li class="breadcrumb-item"><a href="{{ route('publisher.home') }}">{{ __('admin.Home') }}</a></li>
        <li class="breadcrumb-item" aria-current="page">{{ __('admin.News') }}</li>
    </x-slot:breadcrumb>

    <!-- Both borders table start -->
    <div class="col-span-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="row">
                    <h5>{{ __('admin.News') }}</h5>
                </div>
                <div>
                        <a href="{{ route('publisher.nw.create') }}" class="btn btn-primary">
                            {{ __('admin.Add News') }}
                        </a>
                </div>
            </div>

            <!-- Filters Section -->
            <div class="filters-container">
                <div class="filter-item">
                    <label for="keyword">{{ __('admin.Keyword_EN') }}:</label>
                    <x-form.input name="keyword" id="keyword" type="text" placeholder="{{ __('admin.enter keyword') }}" />
                </div>
                <div class="filter-item">
                    <label for="date">{{ __('admin.From Date') }}:</label>
                    <x-form.input name="date" id="date" type="date" placeholder="mm/dd/yyyy"  />
                </div>
                <div class="filter-item">
                    <label for="to_date">{{ __('admin.To Date') }}:</label>
                    <x-form.input name="to_date" id="to_date" type="date" placeholder="mm/dd/yyyy"  />
                </div>
                <div class="filter-item">
                    <label for="category_id">{{ __('admin.Category') }}:</label>
                    <select id="category_id" name="category_id" class="form-control">
                        <option value="" selected>{{ __('admin.Choose') }}</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->$name }}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn" id="search">{{ __('admin.Filter') }}</button>
            </div>

            <div class="card-body">
                <div class="dt-responsive table-responsive">
                    <table id="footer-search" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('admin.Image') }}</th>
                                <th>{{ __('admin.Title') }}</th>
                                <th>{{ __('admin.Publisher') }}</th>
                                <th>{{ __('admin.Category') }}</th>
                                <th>{{ __('admin.Date') }}</th>
                                <th>{{ __('admin.Created') }}</th>
                                <th>{{ __('admin.Keyword_AR') }}</th>
                                <th>{{ __('admin.Status') }}</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($news as $new)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($new->img_view)
                                            @if(Storage::disk('public')->exists($new->img_view))
                                            <img src="{{ asset('storage/' . $new->img_view) }}" width="50" alt="Image">
                                            @else
                                            {{ __('No Image') }}
                                            @endif
                                        @else
                                        {{ __('No Image') }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('site.new', $new->id) }}" target="_blank" class="title">{{ $new->$title }}</a>
                                    </td>
                                    <td>{{ $new->publisher->name ?? '' }}</td>
                                    <td>
                                        @if(app()->getLocale() == 'ar')
                                            {{ $new->category->name_ar ?? '' }}
                                        @else
                                            {{ $new->category->name_en ?? '' }}
                                        @endif
                                    </td>
                                    <td>{{ Carbon\Carbon::parse($new->date)->format('Y-m-d') }}</td>
                                    <td>{{ $new->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        @if(app()->getLocale() == 'ar')
                                            {{ $new->keyword_ar ?? '' }}
                                        @else
                                            {{ $new->keyword_en ?? '' }}
                                        @endif
                                    </td>

                                    <td>
                                    {{ app()->getLocale() == 'ar' ? $new->status->name_ar : $new->status->name_en }}
                                    </td>


                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between" dir="ltr" id="pagination-links">
                    {{ $news->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- Both borders table end -->


@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.33.2/tagify.css" referrerpolicy="origin">
@endpush
    @push('scripts')
    <script src="{{ asset('assets-dashboard/js/plugins/dataTables.min.js') }}"></script>
    <script src="{{ asset('assets-dashboard/js/plugins/dataTables.bootstrap5.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.33.2/tagify.min.js" referrerpolicy="origin"></script>

    <script>
        const tagifyElements = document.querySelectorAll('#keyword');
        tagifyElements.forEach(el => {
            new Tagify(el);
        });
        $(document).ready(function() {
            function formatDate(dateString) {
                const date = new Date(dateString);
                const year = date.getFullYear();
                const month = (date.getMonth() + 1).toString().padStart(2, '0'); // من 0 إلى 11
                const day = date.getDate().toString().padStart(2, '0');
                return `${year}-${month}-${day}`;
            }
            $('#search').on('click', function() {
                let date = $('#date').val();
                let to_date = $('#to_date').val();
                let category_id = $('#category_id').val();
                let keyword = $('#keyword').val();
                let accept = "{{__('admin.accept')}}";
                let not_accepted = "{{__('admin.not accepted yet')}}";
                $.ajax({
                    url: '{{ route('dashboard.nw.index') }}',
                    method: 'GET',
                    data: {
                        date: date,
                        to_date: to_date,
                        category_id: category_id,
                        keyword: keyword,
                    },
                    success: function(data) {
                        $('#footer-search tbody').empty();
                        let newss = data.newss;
                        $.each(newss, function(index, newsItem) {
                            var row = `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>
                                        <img src="../../storage/${newsItem.img_view}" width="100" alt="No Image">
                                    </td>
                                    <td>
                                        @if(app()->getLocale() == 'ar')
                                            <a href="{{ route('site.new', ':id') }}" target="_blank" class="title">${newsItem.title_ar}</a>
                                        @else
                                            <a href="{{ route('site.new', ':id') }}" target="_blank" class="title">${newsItem.title_en}</a>
                                        @endif
                                    </td>
                                    <td>${newsItem.publisher ? newsItem.publisher.name : ''}</td>
                                    <td>
                                        @if(app()->getLocale() == 'ar')
                                            ${newsItem.category.name_ar}
                                        @else
                                            ${newsItem.category.name_en}
                                        @endif
                                    </td>
                                    <td>
                                        @if(app()->getLocale() == 'ar')
                                            ${newsItem.newplace ? newsItem.newplace.name_ar : ''}
                                        @else
                                            ${newsItem.newplace ? newsItem.newplace.name_en : ''}
                                        @endif
                                    </td>
                                    <td>${formatDate(newsItem.created_at)}</td>
                                    <td>${newsItem.visit}</td>
                                    <td>
                                        @if(app()->getLocale() == 'ar')
                                            ${newsItem.status.name_ar}
                                        @else
                                            ${newsItem.status.name_en}
                                        @endif
                                    </td>
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
                            row = row.replace(/:id/g, newsItem.id);
                            $('#footer-search tbody').append(row);
                        });
                        $('#footer-search_info').empty();
                        $('#pagination-links').empty();
                        $('.paging_full_numbers').empty();
                    }
                });
            });
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
</x-publisher-layout>
