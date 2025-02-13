<x-dashboard-layout>
    @push('styles')
        <link rel="stylesheet" href="{{asset('assets-dashboard/css/media.css')}}">
    @endpush
    <x-slot:breadcrumbs>
        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('admin.Home')}}</a></li>
        <li class="breadcrumb-item" aria-current="page">{{__('admin.Media')}}</li>
    </x-slot:breadcrumb>
    @can('view', 'App\\Models\Media')
    <!-- Both borders table start -->
    <div class="col-span-12">
        <div class="card table-card">
            <div class="card-header" style="padding: 15px 25px;">
                <div class="sm:flex items-center justify-between">
                    <h5 class="mb-3 sm:mb-0">{{__('admin.Media Gallery')}}</h5>
                    <div>
                        <form id="uploadForm" action="{{ route('dashboard.media.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="">
                                <label class="btn btn-outline-secondary" for="imageFile">
                                    <i class="ti ti-upload me-2"></i>
                                    {{__("Click to Upload")}}
                                </label>
                                <input type="file" id="imageFile" name="imageFile[]" accept="image/*" hidden multiple>
                                @if ($errors->any())
                                    <span class="text-danger block">{{$errors->first()}}</span>
                                @endif
                                {{-- <input type="text" name="path" id="pathImage" hidden> --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body pt-3 container  masonry-column">
                @foreach ($images as $image)
                    <div class="masonry-item relative" id="image-{{$image->id}}">
                        <img src="{{asset('storage/'.$image->path)}}" alt="صورة 1">
                        <div class="caption">
                            {{$image->file_name}} - {{ App\Helpers\FormatSize::formatSize($image->size) }}
                        </div>
                        <div class="absolute p-[9px] text-white del" id="del-{{$image->id}}" data-id="{{$image->id}}">
                            <button>X</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endcan
    <!-- Both borders table end -->
    <div class="modal fade" id="mediaModal" tabindex="-1" role="dialog" aria-labelledby="mediaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title h4" id="mediaModalLabel">Large Modal</h5>
                <button data-pc-modal-dismiss="#bd-example-modal-lg" class="text-lg flex items-center justify-center rounded w-7 h-7 text-secondary-500 hover:bg-danger-500/10 hover:text-danger-500">
                    <i class="ti ti-x"></i>
                </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $('#imageFile').on('change', function() {
                $('#uploadForm').submit();
            });
        </script>
        <script>
            $(document).ready(function() {
                $('.del').on('click', function() {
                    let id = $(this).data('id');
                    $.ajax({
                        url: "/admin/media/" + id,
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            // console.log(response);
                            $('#image-'+id).remove();
                        },
                        error: function(xhr) {
                            if(xhr.responseJSON.confirmation_deletion == false){
                                if (confirm('هل أنت متأكد من أنك تريد حذف هذه الصورة؟ إنها مرتبطة بعنصر مخزن')) {
                                    $.ajax({
                                            url: "/admin/media/" + id,
                                            type: "DELETE",
                                            data: {
                                                _token: "{{ csrf_token() }}",
                                                confirmation_deletion : true
                                            },
                                            success: function(response) {
                                                $('#image-'+id).remove();
                                            }
                                    });
                                    console.log('تم التأكيد، سيتم تنفيذ الحدث.');
                                } else {
                                    // إذا ضغط المستخدم على "إلغاء"، لا يحدث شيء
                                    console.log('تم إلغاء العملية، لن يحدث شيء.');
                                }
                            };
                        }
                    });
                });
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                @if ($errors->any())
                    // Open the pop-up when there are validation errors
                    $('#mediaAdd').addClass('show');
                @endif
            });
        </script>
    @endpush
</x-dashboard-layout>
