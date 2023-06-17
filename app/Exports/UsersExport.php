<?php
  
namespace App\Exports;
  
use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;

class UsersExport implements FromCollection, WithStyles, WithHeadings, WithEvents
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
        return ["id","الاسم", "البريد"];
    }

    public function collection()
    {
        return User::select("id","name", "email")->get();
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
   
                $event->sheet->getDelegate()->setRightToLeft(true);
                $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(30);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('c')->setWidth(30);

     
            },
        ];
    }
}