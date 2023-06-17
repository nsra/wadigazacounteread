<?php

namespace App\Http\Controllers;

use App\Countersecond;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Exports\CountersecondsExport;
use Maatwebsite\Excel\Facades\Excel;
class CountersecondController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $counters = Countersecond::where([]);
        if ($request->has('search'))
            $counters = $counters->where('counter_number', 'like', "%{$request->input('search')}%")
                ->orWhere('subscription_number', 'like', "%{$request->input('search')}%")
                ->orWhere('subscriber', 'like', "%{$request->input('search')}%")
                ->orWhere('current_read', 'like', "%{$request->input('search')}%")
                ->orWhere('previous_read', 'like', "%{$request->input('search')}%");

        $counters = $counters->orderBy('number', 'ASC')->paginate(10);
        return view('counterseconds.index', compact('counters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('counterseconds.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required',
            'position_number' => 'required',
            'subscription_number' => 'required',
            'subscriber' => 'required',
            'counter_number' => 'required',
        ]);
        $counter = Countersecond::create($request->all());
        if ($request->current_read == null) $counter->current_read = NULL;
        if ($request->cups_consumption == null) $counter->cups_consumption = 0;
        if ($request->shekels_consumption == null) $counter->shekels_consumption = 0;
        $counter->save();
        $url = $request->input('url');
        return redirect($url)->with('success', 'تم إضافة العداد بنجاح');
        //->route('counterseconds.index')
            
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $counter = Countersecond::find($id);
        return view('counterseconds.show', compact('counter'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $counter = Countersecond::find($id);
        return view('counterseconds.edit', compact('counter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'number' => 'required',
            'position_number' => 'required',
            'subscription_number' => 'required',
            'subscriber' => 'required',
            'counter_number' => 'required',
            'previous_read' => 'required',
            'current_read' => 'required',
            'cups_consumption' => 'required',
            'shekels_consumption' => 'required',
        ]);

        $counter = Countersecond::find($id);
        $counter->fill($request->all());
        // $def = $request->current_read -  $request->previous_read;
        // if ($def >= 0) {
        //     $counter->cups_consumption = $def;
        //     $counter->shekels_consumption = (($def < 11) ? 20 : $def * 2);
        // } else {
        //     $counter->cups_consumption = 0;
        //     $counter->shekels_consumption = 0;
        // }
        $counter->update();
         $url = $request->input('url');
        return redirect($url)->with('success', 'تم تعديل العداد بنجاح');
       
    }

    public function update_current_read(Request $request)
    {
        $counter = Countersecond::find($request->counter_id);
        // dd($request->counter_id);
        $def = $request->current_read -  $counter->previous_read;
        // dd($def*-1 == $counter->previous_read);
        if ($def >= 0) {
            $counter->current_read = $request->current_read;
            $counter->cups_consumption = $def;
            $counter->shekels_consumption = (($def < 11) ? 20 : $def * 2);
            $counter->update();
            return redirect()->back()
            ->with('success', 'تم تعيين القراءة الحالية بنجاح');
        } else if($def*-1 == $counter->previous_read){
            $counter->current_read = NULL;
            $counter->cups_consumption = 0;
            $counter->shekels_consumption = 0;
            $counter->update();
            return redirect()->back()
            ->with('success', 'تم تصفير القراءة الحالية');
        }
        else {
            return redirect()->back()
            ->with('error', 'القراءة الحالية يجب أن تكون أكبر أو تساوي القراءة السابقة');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $counter = Countersecond::find($id);
        $counter->delete();
        return redirect()->route('counterseconds.index')
            ->with('success', 'تم الحذف بنجاح');
    }

    public function refresh()
    {
        $counters = Countersecond::get();
        foreach ($counters as $counter) {
            if ($counter->current_read != 0) 
            {
                $counter->previous_read = $counter->current_read;
            }
            $counter->current_read = NULL;
            $counter->cups_consumption = 0;
            $counter->shekels_consumption = 0;
            $counter->save();
        }

        return redirect()->back()
            ->with('success', 'تم تصفير جميع عدادات المنطقة');
    }

    public function get_refresh(){
        return view('counterseconds.refresh');
    }

    public function delete($id)
    {
        $counter = Countersecond::find($id);

        return view('counterseconds.delete', compact('counter'));
    }

    public function export() 
    {
        $counter_name = 'منطقة7-'.\Carbon\Carbon::now()->format('M-Y').'.xlsx';
        return Excel::download(new CountersecondsExport, $counter_name);
    }
}
