<x-dashboard-layout>

    @php
    $name = 'name_' . app()->getLocale();
    $title = 'title_' . app()->getLocale();
    @endphp

    <x-slot:breadcrumbs>
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard.home') }}">{{ __('admin.Home') }}</a>
        </li>

        <li class="breadcrumb-item">
            {{ __('admin.Podcasts') }}
        </li>
        </x-slot:breadcrumb>

        <div class="col-span-12">

            <div class="card table-card">

                <div class="card-header">

                    <div class="sm:flex items-center justify-between">

                        <h5>{{ __('admin.Podcasts') }}</h5>

                        @can('create', 'App\Models\Podcast')
                        <a href="{{ route('dashboard.podcast.create') }}" class="btn btn-primary">

                            {{ __('admin.Add Podcast') }}

                        </a>
                        @endcan

                    </div>

                </div>

                @can('view', 'App\Models\Podcast')

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-hover">

                            <thead>

                                <tr>

                                    <th>#</th>
                                    <th>{{ __('admin.Image') }}</th>
                                    <th>{{ __('admin.Title') }}</th>
                                    <th>{{ __('admin.Category') }}</th>
                                    <th>{{ __('admin.Duration') }}</th>
                                    <th>{{ __('admin.Created') }}</th>
                                    <th>{{ __('admin.Actions') }}</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach($podcasts as $podcast)

                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>

                                        @if($podcast->img_view)

                                        <img src="{{ asset('storage/' . $podcast->img_view) }}" width="60">

                                        @endif

                                    </td>

                                    <td>{{ $podcast->$title }}</td>

                                    <td>

                                        @if(app()->getLocale() == 'ar')
                                        {{ $podcast->category->name_ar ?? '' }}
                                        @else
                                        {{ $podcast->category->name_en ?? '' }}
                                        @endif

                                    </td>


                                    <td>
                                        @php
                                        $totalSeconds = 0;

                                        foreach ($podcast->episodes as $ep) {
                                        if ($ep->time) {
                                        [$h, $m, $s] = array_pad(explode(':', $ep->time), 3, 0);
                                        $totalSeconds += ($h * 3600) + ($m * 60) + $s;
                                        }
                                        }

                                        $formatted = $totalSeconds > 0 ? gmdate("H:i:s", $totalSeconds) : '-';
                                        @endphp

                                        {{ $formatted }}
                                    </td>

                                    <td>{{ $podcast->created_at->format('Y-m-d') }}</td>

                                    <td class="d-flex">

                                        <a href="{{ route('dashboard.podcast.edit', $podcast->id) }}"
                                            class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary">

                                            <i class="ti ti-edit text-xl"></i>

                                        </a>

                                        <form action="{{ route('dashboard.podcast.destroy', $podcast->id) }}"
                                            method="post" class="delete-form">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary">

                                                <i class="ti ti-trash text-xl"></i>

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                    <div class="mt-4">

                        {{ $podcasts->links() }}

                    </div>

                </div>

                @endcan

            </div>

        </div>

</x-dashboard-layout>