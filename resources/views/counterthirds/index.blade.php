@extends('counterthirds.layout')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-4">
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <h2 class="text-center">عدادات منطقة 08</h2>
            </div>
        </div>
    </div>

    <div class="form-group">
        <form action="{{ route('counterthirds.index') }}" method="GET" class=" form-inline align-items-center">
            <div class="col-12 col-lg-7 text-center align-items-center">
                <input name="search" style="width: 78%!important; margin-top:28px !important"
                    value="{{ app('request')->get('search') }}" class="d-inline-block form-control search" type="search"
                    placeholder="ابحث من خلال رقم العداد أو الاشتراك أو اسم المشترك أو عنوانه أو أي قراءة">

                <button type="submit" class="d-inline-block btn btn-success mt-2 search-sm">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <div class="col-lg-4 d-inline-block text-center align-items-center">
                <a class="btn btn-success mt-2" href="{{ route('counterthirds.create') }}">إضافة عداد <i
                        class="fas fa-plus"></i>
                </a>
                <a class="btn btn-warning mt-2" data-toggle="modal" id="smallButton" data-target="#smallModal"
                    data-attr="{{ route('refreshthird') }}" title="تصفير العدادات"> تصفـير الكل <i class="fas fa-undo"></i>
                </a>
                <a class="btn btn-success mt-2" href="{{ route('export_thirdcounters') }}"> تصدير كملف <i
                        class="fas fa-file-excel"></i>
                </a>
            </div>
        </form>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success pb-0">
            <p>{{ $message }}</p>
        </div>
    @elseif ($message = Session::get('error'))
        <div class="alert alert-danger pb-0">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="my-table">
        <table class="table table-bordered">
            <tr>
                <th class="hide-on-extra-small"> </th>
                <th class="hide-on-small">رقم الموقع</th>
                <th class="hide-on-small">رقم الاشتراك</th>
                <th>المشترك</th>
                <th>رقم العداد</th>
                <th>القراءة السابقة</th>
                <th>القراءة الحالية</th>
                <th class="hide-on-small"> الاستهلاك بالكوب </th>
                <th class="hide-on-small">استهلاك</th>
                <th>إدارة</th>
            </tr>
            @foreach ($counters as $counter)
                <tr>
                    <td class="hide-on-extra-small">{{ $counter->number }}
                        {{-- @if ($counter->current_read > 0)
                            <a class="btn btn-link btn-sm"><i class="fas fa-check-circle fa-lg text-success"></i></a>
                        @endif --}}
                    </td>
                    <td class="hide-on-small">{{ $counter->position_number }}</td>
                    <td class="hide-on-small">{{ $counter->subscription_number }}</td>
                    <td>{{ $counter->subscriber }}</td>
                    <td>{{ $counter->counter_number }}</td>
                    <td>{{ $counter->previous_read }}</td>
                    <td>
                        <form action="{{ route('counterthird.update') }}" method="GET" class="update_form" onsubmit="return do_something()">
                            @csrf
                            @method('PUT')
                            <div class="display-inline-block text-center">
                                <input name="current_read" class="display-inline-block current_read_input"
                                    style="width: 70px; margin-top: 8px !important; margin-bottom: 10px !important;"
                                    value="{{ $counter->current_read }}" type="number">
                                <input type="hidden" class="d-none" name="counter_id" value="{{ $counter->id }}">
                                <button type="submit" class="btn btn-success btn-sm" style="margin-top: -3px">
                                    <i class="fas text-light fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>

                    </td>
                    <td class="hide-on-small">{{ $counter->cups_consumption }}</td>
                    <td class="hide-on-small">{{ $counter->shekels_consumption }} شيكل</td>
                    <td>
                        <a class="btn btn-info btn-sm mt-2" href="{{ route('counterthirds.show', $counter->id) }}"><i
                                class="fas fa-list"></i></a>
                        <a class="btn btn-secondary btn-sm mt-2" href="{{ route('counterthirds.edit', $counter->id) }}"><i
                                class="fas fa-edit"></i></a>
                    </td>
                </tr>
            @endforeach
        </table>

        {{ $counters->links('pagination::bootstrap-4') }}
    </div>
    <div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header p-1 d-flex align-items-left " dir="ltr">
                    <button type="button" class="btn btn-link outline-none text-muted" data-dismiss="modal"
                        onClick="removeBackdrop()">
                        <i class="text-muted fa fa-lg fa-times-circle"></i>
                    </button>
                </div>
                <div class="modal-body" id="smallBody">
                    <div>
                        <!-- the result to be displayed apply here -->
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        // $('input[type="number"]').keyup(function() {
        //     if ($(this).val() != 0) {
        //         $('.update_form').css("display", "none");
        //         $(this).parent().parent().css("display", "block");
        //     }
        // });


        // function do_something(){
        //     $('.update_form').css("display", "block");
        // }

        function removeBackdrop() {
            $('.modal-backdrop').remove();
        }

        $(document).on('click', '#smallButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#smallModal').modal("show");
                    $('#smallBody').html(result).show();
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });
    </script>
    <br>
@endsection
