{{-- !-- Delete Warning Modal --> --}}
<form action="{{ route('counterseconds.destroy', $counter->id) }}" method="post">
    <div class="modal-body">
        @csrf
        @method('DELETE')
        <h5 class="text-center">{{__('هل أنت متأكد من حذف عداد')}} {{ $counter->subscriber }} ؟</h5>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary"  onClick="removeBackdrop()" data-dismiss="modal">{{ __("إلغاء")}}</button>
        <button type="submit" class="btn btn-danger">{{__('احذف')}}</button>
    </div>

</form>
{{-- 
<script>
    console.log(history.back())
    </script> --}}

