<x-dashboard-layout>
    @php
        $name = 'name_' . app()->getLocale();
        $title = 'title_' . app()->getLocale();
    @endphp
    <x-slot:breadcrumbs>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">{{ __('admin.Home') }}</a></li>
        <li class="breadcrumb-item" aria-current="page">{{ __('admin.Articals') }}</li>
    </x-slot:breadcrumb>
    <!-- [ Main Content ] start -->
    <div class="col-span-12">
        <div class="card table-card">
            <div class="card-header">
                <div class="sm:flex items-center justify-between">
                    <h5 class="mb-3 mb-sm-0">{{ __('admin.Articles') }}</h5>
                    @can('create', 'App\Models\Artical')
                        <div>
                            <a href="{{ route('dashboard.articale.create') }}" class="btn btn-primary">{{ __('admin.Add Articles') }}</a>
                        </div>
                    @endcan
                </div>
            </div>
            <!-- Filters Section -->
            <div class="filters-container flex flex-col sm:flex-row sm:flex-wrap sm:items-end gap-4 bg-white p-4 sm:p-6 rounded-2xl shadow-md">
                <!-- Title Input -->
                <div class="flex flex-col space-y-2 w-full sm:w-48">
                    <label for="title" class="text-sm font-medium text-gray-700 mb-3">{{ __('admin.Title') }}</label>
                    <x-form.input
                        name="title"
                        id="title"
                        type="text"
                        placeholder="{{ __('admin.Title') }}"
                        class="h-15 px-4 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary text-sm w-full"
                    />
                </div>
                <!-- From Date -->
                <div class="flex flex-col space-y-2 w-full sm:w-40">
                    <label for="date" class="text-sm font-medium text-gray-700 mb-3">{{ __('admin.From Date') }}</label>
                    <x-form.input
                        name="date"
                        id="date"
                        type="date"
                        placeholder="mm/dd/yyyy"
                        class="h-15 px-4 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary text-sm w-full"
                    />
                </div>
                <!-- To Date -->
                <div class="flex flex-col space-y-2 w-full sm:w-40">
                    <label for="to_date" class="text-sm font-medium text-gray-700 mb-3">{{ __('admin.To Date') }}</label>
                    <x-form.input
                        name="to_date"
                        id="to_date"
                        type="date"
                        placeholder="mm/dd/yyyy"
                        class="h-15 px-4 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary text-sm w-full"
                    />
                </div>
                <!-- Category Dropdown -->
                <div class="flex flex-col space-y-2 w-full sm:w-44">
                    <label for="category_id" class="text-sm font-medium text-gray-700 mb-3">{{ __('admin.Category') }}</label>
                    <select
                        id="category_id"
                        name="category_id"
                        class="h-11 px-4 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary text-sm w-full"
                    >
                        <option value="" selected>{{ __('admin.Choose category') }}</option>
                         @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->$name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Filter Button -->
                <div class="w-full sm:w-auto mt-2 sm:mt-6">
                    <div class="mb-6"></div>
                    <button
                        type="submit"
                        id="search"
                        class="w-full sm:w-auto h-11 px-6 bg-primary hover:bg-primary/90 text-white text-sm font-semibold rounded-lg transition"
                    >
                        {{ __('admin.Search') }}
                    </button>
                </div>
            </div>
            @can('view', 'App\Models\Artical')
                <div class="card-body pt-3">
                    <div class="table-responsive">
                        <table class="table table-hover" id="footer-search">
                            <thead>
                                <tr>
                                <th>#</th>
                                <th>{{ __('admin.Image') }}</th>
                                <th>{{ __('admin.Title') }}</th>
                                <th>{{ __('admin.Publisher') }}</th>
                                <th>{{ __('admin.Category') }}</th>
                                <th>{{ __('admin.Date') }}</th>
                                <th>{{ __('admin.Created') }}</th>
                                <th>{{ __('admin.Visit') }}</th>
                                <th>{{ __('admin.Status') }}</th>
                                <th>{{ __('admin.Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($articals as $artical)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if ($artical->img_view)
                                                @if(Storage::disk('public')->exists($artical->img_view))
                                                    <div class="flex items-center">
                                                        <div class="shrink-0">
                                                            <img src="{{ asset('storage/' . $artical->img_view) }}" alt="user image" class="w-10" />
                                                        </div>
                                                    </div>
                                                    @else
                                                    {{ __('No Image') }}
                                                @endif
                                                    @else
                                                    {{ __('No Image') }}
                                            @endif
                                        </td>
                                        <td><a href="{{ route('site.article', $artical->id) }}" target="_blank" class="title">{{ $artical->$title }}</a></td>
                                        <td>{{ $artical->publisher->name ?? '' }}</td>
                                        <td>
                                            @if(app()->getLocale() == 'ar')
                                                {{ $artical->category->name_ar ?? '' }}
                                                @else
                                                {{ $artical->category->name_en ?? '' }}
                                            @endif
                                        </td>
                                        <td>{{ $artical->date}}</td>
                                        <td>{{ $artical->created_at->format('Y-m-d') }}</td>
                                        <td>{{ $artical->visit }}</td>
                                        <td>{{ $artical->status ? $artical->status->$name : '' }}</td>
                                        <td>
                                            {{-- <a href="#" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary">
                                                <i class="ti ti-eye text-xl leading-none"></i>
                                            </a> --}}
                                            <a href="{{ route('dashboard.articale.edit', $artical->id) }}" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary">
                                                <i class="ti ti-edit text-xl leading-none"></i>
                                            </a>
                                            <form action="{{ route('dashboard.articale.destroy', $artical->id) }}" method="post" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="{{ __('Delete') }}">
                                                    <i class="ti ti-trash text-xl leading-none"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4"  id="pagination-links">
                        {{ $articals->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endcan
    <!-- [ Main Content ] end -->


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
                $.ajax({
                    url: '{{ route('dashboard.articale.index')}}',
                    method: 'GET',
                    data: {
                        title: $('#title').val(),
                        date: date,
                        to_date: to_date,
                        category_id: category_id,
                    },
                    success: function(data) {
                        $('#footer-search tbody').empty();
                        let articals = data.articals;
                        let accept = "{{__('admin.accept')}}";
                        let not_accepted = "{{__('admin.not accepted yet')}}";
                        $.each(articals, function(index, artical) {
                            var row = `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>
                                        <img src="../../storage/${artical.img_view}" width="100" alt="No Image">
                                    </td>
                                    <td>
                                        @if(app()->getLocale() == 'ar')
                                            <a href="{{ route('site.article', ':id') }}" target="_blank" class="title">${artical.title_ar}</a>
                                        @else
                                            <a href="{{ route('site.article', ':id') }}" target="_blank" class="title">${artical.title_en}</a>
                                        @endif
                                    </td>
                                    <td>${artical.publisher ? artical.publisher.name : ''}</td>
                                    <td>
                                        @if(app()->getLocale() == 'ar')
                                            ${artical.category.name_ar}
                                        @else
                                            ${artical.category.name_en}
                                        @endif
                                    </td>
                                    <td>${artical.date}</td>
                                    <td>${formatDate(artical.created_at)}</td>
                                    <td>${artical.visit}</td>
                                    <td>
                                        @if(app()->getLocale() == 'ar')
                                            ${artical.status.name_ar}
                                        @else
                                            ${artical.status.name_en}
                                        @endif
                                    </td>
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
                            row = row.replace(/:id/g, artical.id);
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

</x-dashboard-layout>




