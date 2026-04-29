<x-dashboard-layout>
    @php
        $name = 'name_' . app()->getLocale();
        $title = 'title_' . app()->getLocale();
    @endphp

    <x-slot:breadcrumbs>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">{{ __('admin.Home') }}</a></li>
        <li class="breadcrumb-item" aria-current="page">{{ __('admin.Videos') }}</li>
    </x-slot:breadcrumb>

    <div class="col-span-12">
        <div class="card table-card">
            <div class="card-header">
                <div class="sm:flex items-center justify-between">
                    <h5 class="mb-3 mb-sm-0">{{ __('admin.Videos') }}</h5>
                    @can('create', 'App\Models\Video')
                        <div>
                            <a href="{{ route('dashboard.video.create') }}"
                                class="btn btn-primary">{{ __('admin.Add Video') }}</a>
                        </div>
                    @endcan
                </div>
            </div>

            <div
                class="filters-container flex flex-col sm:flex-row sm:flex-wrap sm:items-end gap-4 bg-white p-4 sm:p-6 rounded-2xl shadow-md">
                <div class="flex flex-col space-y-2 w-full sm:w-48">
                    <label for="title" class="text-sm font-medium text-gray-700 mb-3">{{ __('admin.Title') }}</label>
                    <x-form.input name="title" id="title" type="text" placeholder="{{ __('admin.Title') }}"
                        class="h-15 px-4 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary text-sm w-full" />
                </div>

                <div class="flex flex-col space-y-2 w-full sm:w-40">
                    <label for="date" class="text-sm font-medium text-gray-700 mb-3">{{ __('admin.From Date') }}</label>
                    <x-form.input name="date" id="date" type="date" placeholder="mm/dd/yyyy"
                        class="h-15 px-4 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary text-sm w-full" />
                </div>

                <div class="flex flex-col space-y-2 w-full sm:w-40">
                    <label for="to_date" class="text-sm font-medium text-gray-700 mb-3">{{ __('admin.To Date') }}</label>
                    <x-form.input name="to_date" id="to_date" type="date" placeholder="mm/dd/yyyy"
                        class="h-15 px-4 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary text-sm w-full" />
                </div>

                <div class="flex flex-col space-y-2 w-full sm:w-44">
                    <label for="category_id" class="text-sm font-medium text-gray-700 mb-3">{{ __('admin.Category') }}</label>
                    <select id="category_id" name="category_id"
                        class="h-11 px-4 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary text-sm w-full">
                        <option value="" selected>{{ __('admin.Choose category') }}</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->$name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="w-full sm:w-auto mt-2 sm:mt-6">
                    <div class="mb-6"></div>
                    <button type="submit" id="search"
                        class="w-full sm:w-auto h-11 px-6 bg-primary hover:bg-primary/90 text-white text-sm font-semibold rounded-lg transition">
                        {{ __('admin.Search') }}
                    </button>
                </div>
            </div>

            @can('view', 'App\Models\Video')
                <div class="card-body pt-3">
                    <div class="table-responsive">
                        <table class="table table-hover" id="footer-search">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('admin.Image') }}</th>
                                    <th>{{ __('admin.Title') }}</th>
                                    <th>{{ __('admin.Category') }}</th>
                                    <th>{{ __('admin.Date') }}</th>
                                    <th>{{ __('admin.Duration') }}</th>
                                    <th>{{ __('admin.Created') }}</th>
                                    <th>{{ __('admin.Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($videos as $video)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if ($video->img_view)
                                                @if (Storage::disk('public')->exists($video->img_view))
                                                    <div class="flex items-center">
                                                        <div class="shrink-0">
                                                            <img src="{{ asset('storage/' . $video->img_view) }}"
                                                                alt="video image" class="w-10" />
                                                        </div>
                                                    </div>
                                                @else
                                                    {{ __('No Image') }}
                                                @endif
                                            @else
                                                {{ __('No Image') }}
                                            @endif
                                        </td>
                                        <td>{{ $video->$title }}</td>
                                        <td>
                                            @if (app()->getLocale() == 'ar')
                                                {{ $video->category->name_ar ?? '' }}
                                            @else
                                                {{ $video->category->name_en ?? '' }}
                                            @endif
                                        </td>
                                        <td>{{ $video->date }}</td>
                                        <td>{{ $video->time }}</td>
                                        <td>{{ $video->created_at->format('Y-m-d') }}</td>
                                        <td>
                                            <a href="{{ route('dashboard.video.edit', $video->id) }}"
                                                class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary">
                                                <i class="ti ti-edit text-xl leading-none"></i>
                                            </a>
                                            <form action="{{ route('dashboard.video.destroy', $video->id) }}"
                                                method="post"
                                                class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary delete-form">
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

                    <div class="mt-4" id="pagination-links">
                        {{ $videos->links() }}
                    </div>
                </div>
            @endcan
            </div>
        </div>

        <button type="button" id="deleteConfirmModalBtn" class="btn btn-primary" style="display: none;" data-pc-toggle="modal"
            data-pc-target="#deleteConfirmModal">
            Launch demo modal
        </button>

    @push('scripts')
        <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-center" style="border-radius: 15px; padding: 30px; border: none;">
                    <div class="modal-body">
                        <div class="mb-3">
                            <div
                                style="background-color: #f44336; width: 70px; height: 70px; border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#fff"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                </svg>
                            </div>
                        </div>
                        <h5 class="mb-4 mt-3">هل أنت متأكد أنك تريد الحذف؟</h5>
                        <div class="d-flex justify-content-center gap-3">
                            <button type="button" class="btn btn-secondary" data-pc-modal-dismiss="#deleteConfirmModal">إلغاء</button>
                            <button type="button" class="btn btn-danger px-4" id="confirmDeleteBtn">نعم، احذف</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endpush

    @push('scripts')
        <script>
            $(document).ready(function() {
                function formatDate(dateString) {
                    const date = new Date(dateString);
                    const year = date.getFullYear();
                    const month = (date.getMonth() + 1).toString().padStart(2, '0');
                    const day = date.getDate().toString().padStart(2, '0');
                    return `${year}-${month}-${day}`;
                }

                $('#search').on('click', function() {
                    let date = $('#date').val();
                    let to_date = $('#to_date').val();
                    let category_id = $('#category_id').val();

                    $.ajax({
                        url: '{{ route('dashboard.video.index') }}',
                        method: 'GET',
                        data: {
                            title: $('#title').val(),
                            date: date,
                            to_date: to_date,
                            category_id: category_id,
                        },
                        success: function(data) {
                            $('#footer-search tbody').empty();
                            let videos = data.videos;

                            $.each(videos, function(index, video) {
                                var row = `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>
                                        <img src="../../storage/${video.img_view}" width="100" alt="No Image">
                                    </td>
                                    <td>
                                        @if (app()->getLocale() == 'ar')
                                            ${video.title_ar ?? ''}
                                        @else
                                            ${video.title_en ?? ''}
                                        @endif
                                    </td>
                                    <td>
                                        @if (app()->getLocale() == 'ar')
                                            ${video.category ? video.category.name_ar : ''}
                                        @else
                                            ${video.category ? video.category.name_en : ''}
                                        @endif
                                    </td>
                                    <td>${video.date ?? ''}</td>
                                    <td>${video.time ?? ''}</td>
                                    <td>${formatDate(video.created_at)}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('dashboard.video.edit', ':id') }}" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary">
                                            <i class="ti ti-edit text-xl leading-none"></i>
                                        </a>
                                        <form action="{{ route('dashboard.video.destroy', ':id') }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary" title="{{ __('Delete') }}">
                                                <i class="ti ti-trash text-xl leading-none"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                `;
                                row = row.replace(/:id/g, video.id);
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
            let formToSubmit = null;

            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    formToSubmit = form;
                    $('#deleteConfirmModalBtn').click();
                });
            });

            document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
                if (formToSubmit) {
                    formToSubmit.submit();
                }
            });
        </script>
    @endpush
</x-dashboard-layout>
