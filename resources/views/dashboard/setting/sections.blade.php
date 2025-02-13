<x-dashboard-layout>
<!-- Both borders table start -->
<div class="col-span-12 mb-4">
    <div class="alert alert-success alert-dismissible fade show" style="display: none;" role="alert" id="alert_success">
        <strong>{{__('admin.Success')}}!</strong> {{__('admin.Settings Saved Successfully!')}}
    </div>
</div> <!-- /. col -->
<div class="col-span-12">
    <div class="card table-card">
        <div class="card-header">
            <div class="sm:flex items-center justify-between">
                <h5 class="mb-3 sm:mb-0">{{__('admin.Settings Sections')}}</h5>
            </div>
        </div>
        @can('edit', 'App\\Models\Section')
        <div class="card-body pt-3">
            <div class="table-responsive" style="margin: 0 15px;">
                <table class="table table-hover table-bordered" id="pc-dt-simple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('admin.Name')}}</th>
                            <th>{{__('admin.Show')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sections as $key => $value)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$key}}</td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input customSwitch" id="customSwitch{{$key}}" name="{{$key}}" @if ($value) checked @endif value="1">
                                    </div>
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


@push('scripts')
<!-- Include jQuery first -->
<script>
    $(document).ready(function() {
        //
        $('.customSwitch').on('change', function() {
            let key = $(this).attr('name');
            let value = $(this).is(':checked') ? 1 : 0;

            $.ajax({
                url: "{{ route('dashboard.setting.showSection') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    key: key,
                    value: value
                },
                success: function(response) {
                    console.log(response);
                    $('#alert_success').slideDown();
                    setTimeout(function() {
                        $('#alert_success').slideUp();
                    }, 3000);
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
@endpush
</x-dashboard-layout>
