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
    {{-- <style>
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
            flex-wrap: nowrap; /* منع الانتقال إلى سطر جديد */
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
    </style> --}}
    @endpush

    <x-slot:breadcrumbs>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">{{ __('admin.Home') }}</a></li>
        <li class="breadcrumb-item" aria-current="page">{{ __('admin.News') }}</li>
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
                            {{ __('admin.Add News') }}
                        </a>
                    </div>
                @endcan
            </div>

            <div class="filters-container flex flex-col sm:flex-row sm:flex-wrap sm:items-end gap-4 bg-white p-4 sm:p-6 rounded-2xl shadow-md">
                <!-- Title Input -->
                <div class="flex flex-col space-y-2 w-full sm:w-48">
                    <label for="title" class="text-sm font-medium text-gray-700">{{ __('admin.Title') }}</label>
                    <x-form.input
                        name="title"
                        id="title"
                        type="text"
                        placeholder="{{ __('admin.Title') }}"
                        class="h-11 px-4 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary text-sm w-full"
                    />
                </div>
                <!-- From Date -->
                <div class="flex flex-col space-y-2 w-full sm:w-40">
                    <label for="date" class="text-sm font-medium text-gray-700">{{ __('admin.From Date') }}</label>
                    <x-form.input
                        name="date"
                        id="date"
                        type="date"
                        placeholder="mm/dd/yyyy"
                        class="h-11 px-4 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary text-sm w-full"
                    />
                </div>
                <!-- To Date -->
                <div class="flex flex-col space-y-2 w-full sm:w-40">
                    <label for="to_date" class="text-sm font-medium text-gray-700">{{ __('admin.To Date') }}</label>
                    <x-form.input
                        name="to_date"
                        id="to_date"
                        type="date"
                        placeholder="mm/dd/yyyy"
                        class="h-11 px-4 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary text-sm w-full"
                    />
                </div>
                <!-- Category Dropdown -->
                <div class="flex flex-col space-y-2 w-full sm:w-44">
                    <label for="category_id" class="text-sm font-medium text-gray-700">{{ __('admin.Category') }}</label>
                    <select
                        id="category_id"
                        name="category_id"
                        class="h-11 px-4 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary text-sm w-full"
                    >
                        <option value="" selected>{{ __('admin.Choose') }}</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->$name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Filter Button -->
                <div class="w-full sm:w-auto mt-2 sm:mt-6">
                    <button
                        type="submit"
                        id="search"
                        class="w-full sm:w-auto h-11 px-6 bg-primary hover:bg-primary/90 text-white text-sm font-semibold rounded-lg transition"
                    >
                        {{ __('admin.Filter') }}
                    </button>
                </div>
            </div>
        </div>
        @can('view', 'App\Models\Nw')
        <div class="card-body pt-3">
            <div class="table-responsive">
                <table id="footer-search" class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('admin.Image') }}</th>
                            <th>{{ __('admin.Title') }}</th>
                            <th>{{ __('admin.Publisher') }}</th>
                            <th>{{ __('admin.Category') }}</th>
                            <th>{{ __('admin.New Place') }}</th>
                            <th>{{ __('admin.Created') }}</th>
                            <th>{{ __('admin.Visit') }}</th>
                            <th>{{ __('admin.Status') }}</th>
                            <th>{{ __('admin.Actions') }}</th>
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
                                <a href="{{ route('site.new', $new->slug) }}" target="_blank" class="title">{{ $new->$title != null && $new->$title != '' ? $new->$title : $new->title_org }}</a>
                            </td>
                            <td>{{ $new->publisher->name ?? 'Admin' }}</td>
                            <td>
                                @if(app()->getLocale() == 'ar')
                                    {{ $new->category->name_ar ?? '' }}
                                    @else
                                    {{ $new->category->name_en ?? '' }}
                                @endif
                            </td>
                                <td>{{ $new->newplace ? $new->newplace->$name : '-' }}</td>
                                <td>{{ $new->created_at->format('Y-m-d') }}</td>
                                <td>{{ $new->visit }}</td>
                                <td>{{ $new->status ? $new->status->$name : '' }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('dashboard.nw.edit', $new->slug) }}" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary">
                                        <i class="ti ti-edit text-xl leading-none"></i>
                                    </a>
                                    <form action="{{ route('dashboard.nw.destroy', $new->slug) }}" method="post" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary" title="{{ __('Delete') }}">
                                            <i class="ti ti-trash text-xl leading-none"></i>
                                        </button>
                                    </form>
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
            @endcan
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
                let title = $('#title').val();
                let date = $('#date').val();
                let to_date = $('#to_date').val();
                let category_id = $('#category_id').val();
                let accept = "{{__('admin.accept')}}";
                let not_accepted = "{{__('admin.not accepted yet')}}";
                $.ajax({
                    url: '{{ route('dashboard.nw.index') }}',
                    method: 'GET',
                    data: {
                        title: title,
                        date: date,
                        to_date: to_date,
                        category_id: category_id,
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
                                            <a href="{{ route('site.new', ':id') }}" target="_blank" class="title">${newsItem.title_ar != '' && newsItem.title_ar != null ? newsItem.title_ar : newsItem.title_org}</a>
                                        @else
                                            <a href="{{ route('site.new', ':id') }}" target="_blank" class="title">${newsItem.title_en != '' && newsItem.title_en != null ? newsItem.title_en : newsItem.title_org}</a>
                                        @endif
                                    </td>
                                    <td>${newsItem.publisher ? newsItem.publisher.name : 'Admin'}</td>
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
                            row = row.replace(/:id/g, newsItem.slug);
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
</x-dashboard-layout>
