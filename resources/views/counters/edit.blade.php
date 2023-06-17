@extends('counters.layout')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>تعديل العداد</h2>
                </div>
                <br>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>للأسف!</strong> هناك مشكلة في مدخلاتك.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('counters.update', $counter->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>الرقم التسلسلي:</strong>
                        <input type="number" name="number" value="{{ $counter->number }}" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>رقم الموقع:</strong>
                        <input type="text" name="position_number" value="{{ $counter->position_number }}"
                            class="form-control" placeholder="من موقع WG:00/00/0000 إلى موقع WG:06/99/9999 ">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>رقم الاشتراك:</strong>
                        <input type="number" name="subscription_number" value="{{ $counter->subscription_number }}"
                            class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>المشترك/المستفيد:</strong>
                        <input type="text" name="subscriber" value="{{ $counter->subscriber }}" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>العنوان:</strong>
                        <textarea class="form-control" style="height:100px" name="address">{{ $counter->address }}</textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>رقم العداد:</strong>
                        <input type="text" name="counter_number" value="{{ $counter->counter_number }}"
                            class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>القراءة السابقة:</strong>
                        <input type="number" name="previous_read" value="{{ $counter->previous_read }}" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>القراءة الحالية:</strong>
                        <input type="number" name="current_read" value="{{ $counter->current_read }}" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>الاستهلاك الشهري بالكوب:</strong>
                        <input type="number" name="cups_consumption" value="{{ $counter->cups_consumption }}"
                            class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>الاستهلاك الشهري بالشيكل:</strong>
                        <input type="number" name="shekels_consumption" value="{{ $counter->shekels_consumption }}"
                            class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>حالة العداد:</strong>
                        <input type="text" name="counter_status" value="{{ $counter->counter_status }}"
                            class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>ملاحظات:</strong>
                        <textarea class="form-control" style="height:150px" name="notes" placeholder="ملاحظات">{{ $counter->notes }}</textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <a class="btn btn-danger text-light" data-toggle="modal" id="smallButton" data-target="#smallModal"
                        data-attr="{{ route('delete', $counter->id) }}" title="حذف العداد">
                        حذف العداد <i class="fas fa-trash text-light fa-lg"></i>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">ارسال</button>
                    <a class="btn btn-primary" href="{{ route('counters.index') }}"> رجوع</a>
                </div>
            </div>
            <input type="hidden" name="url" value={{URL::previous()}}>

        </form>
    </div>

    <div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header p-1 d-flex align-items-left " dir="ltr">
                    <button type="button" class="btn btn-link outline-none text-muted" data-dismiss="modal"  onClick="removeBackdrop()">
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
        function removeBackdrop(){
            $('.modal-backdrop').remove();
        }
            
        $(document).on('click', '#smallButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href
                , beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#smallModal').modal("show");
                    $('#smallBody').html(result).show();
                }
                , complete: function() {
                    $('#loader').hide();
                }
                , error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                }
                , timeout: 8000
            })
        });
    </script>
@endsection
