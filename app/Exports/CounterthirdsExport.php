<?php
  
namespace App\Exports;
  
use App\Counterthird;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class CounterthirdsExport implements FromCollection, WithStyles, WithHeadings, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],

        ];
    }

    public function headings(): array
    {
        return ["التسلسل","رقم الموقع", "رقم الاشتراك", "المشترك", "العنوان", "رقم العداد", "القراءة السابقة", "القراءة الحالية", "الاستهلاك الشهري بالشيكل", "الاستهلاك الشهري بالكوب", "حالة العداد", "ملاحظات"];
    }

    public function collection()
    {
        return Counterthird::select("number","position_number", "subscription_number", "subscriber", "address","counter_number", "previous_read", "current_read", "cups_consumption", "shekels_consumption", "counter_status", "notes")->orderBy('number', 'ASC')->get();
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->setRightToLeft(true);
                $event->sheet->getDelegate()->getStyle('1')->getFont()->setSize(12);
                $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(30);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(15);
                $event->sheet->getDelegate()->getColumnDimension('c')->setWidth(15);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(11);
                $event->sheet->getDelegate()->getColumnDimension('G')->setWidth(12);
                $event->sheet->getDelegate()->getColumnDimension('H')->setWidth(12);
                $event->sheet->getDelegate()->getColumnDimension('I')->setWidth(22);
                $event->sheet->getDelegate()->getColumnDimension('J')->setWidth(21);
                $event->sheet->getDelegate()->getColumnDimension('L')->setWidth(30);
            },
        ];
    }
}