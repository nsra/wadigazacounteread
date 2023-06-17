@extends('counterthirds.layout')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>إضافة قراءة جديدة</h2>
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

        <form action="{{ route('counterthirds.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>الرقم التسلسلي:</strong>
                        <input type="number" name="number" value="{{ old('number') }}" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>رقم الموقع:</strong>
                        <input type="text" name="position_number" value="{{ old('position_number') }}"
                            class="form-control" placeholder="من موقع WG:00/00/0000 إلى موقع WG:06/99/9999 ">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>رقم الاشتراك:</strong>
                        <input type="number" name="subscription_number" value="{{ old('subscription_number') }}"
                            class="form-control" required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>المشترك/المستفيد:</strong>
                        <input type="text" name="subscriber" value="{{ old('subscriber') }}" class="form-control" required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>العنوان:</strong>
                        <textarea class="form-control" style="height:100px" name="address">{{ old('address') }}</textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>رقم العداد:</strong>
                        <input type="text" name="counter_number" value="{{ old('counter_number') }}"
                            class="form-control" required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>القراءة السابقة:</strong>
                        <input type="number" name="previous_read" value="{{ old('previous_read') }}" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>القراءة الحالية:</strong>
                        <input type="number" name="current_read" value="{{ old('current_read') }}" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>الاستهلاك الشهري بالكوب:</strong>
                        <input type="number" name="cups_consumption" value="{{ old('cups_consumption') }}"
                            class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>الاستهلاك الشهري بالشيكل:</strong>
                        <input type="number" name="shekels_consumption" value="{{ old('shekels_consumption') }}"
                            class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>حالة العداد:</strong>
                        <input type="text" name="counter_status" value="{{ old('counter_status') }}"
                            class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>ملاحظات:</strong>
                        <textarea class="form-control" style="height:150px" name="notes" placeholder="ملاحظات">{{ old('notes') }}</textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">ارسال</button>
                    <a class="btn btn-primary" href="javascript:history.back()"> رجوع</a>
                </div>
            </div>
            <input type="hidden" name="url" value={{URL::previous()}}>

        </form>
    </div>

@endsection
