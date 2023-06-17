{{-- !-- Delete Warning Modal --> --}}
<form action="{{ route('counters.refresh') }}" method="get">
    <div class="modal-body">
        @csrf
        @method('DELETE')
        <h5 class="text-center">{{__('هذا الإجراء سيؤدي إلى استبدال القرآت السابقة بالقرآت الحالية، إذا انتهيت من قراءة جميع عدادات الموقع 09 بالفعل يرجى أخذ نسخة اكسل من البيانات')}} </h5>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary"  onClick="removeBackdrop()" data-dismiss="modal">{{ __("إلغاء")}}</button>
        <button type="submit" class="btn btn-warning">{{__('تصفير')}}</button>
    </div>

</form>
{{-- 
<script>
    console.log(history.back())
    </script> --}}

