@extends('counterthirds.layout')
@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2> عرض العداد</h2>
                </div>
                <br>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>الرقم التسلسلي:</strong>
                    {{ $counter->number }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>رقم الموقع:</strong>
                    {{ $counter->position_number }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>رقم الاشتراك:</strong>
                    {{ $counter->subscription_number }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>المشترك:</strong>
                    {{ $counter->subscriber }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>العنوان:</strong>
                    {{ $counter->address }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>رقم العداد:</strong>
                    {{ $counter->counter_number }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>القراءة السابقة:</strong>
                    {{ $counter->previous_read }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>القراءة الحالية:</strong>
                    {{ $counter->current_read }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong> الاستهلاك الشهري بالكوب - الفرق بين القراءة الحالية والسابقة:</strong>
                    {{ $counter->cups_consumption }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>الاستهلاك الشهري بالشيكل:</strong>
                    {{ $counter->shekels_consumption }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>حالة العداد:</strong>
                    {{ $counter->status }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ملاحظات:</strong>
                    {{ $counter->notes }}
                </div>
            </div>
            <br>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <a class="btn btn-primary" href="javascript:history.back()"> رجوع</a>
            </div>
        </div>
    </div>

    
@endsection
