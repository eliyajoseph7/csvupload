<?php

namespace App\Http\Livewire;

use App\Helpers\CsvImport;
use App\Models\Customer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\LazyCollection;
use Livewire\Component;
use Livewire\WithFileUploads;

class Dashboard extends Component
{
    use WithFileUploads;
    public $file;
    public $columns;
    public $mapColumnField = [
        'first_name' => '',
        'last_name' => '',
        'email' => '',
        'phone' => '',
        'created_at' => '',
    ];

    protected $rules = [
        'mapColumnField.first_name' => 'required',
        'mapColumnField.last_name' => 'required',
        'mapColumnField.email' => 'required',
        'mapColumnField.phone' => 'required'
    ];


    protected $customAttributes = [
        'mapColumnField.first_name' => 'First Name',
        'mapColumnField.last_name' => 'Last Name',
        'mapColumnField.email' => 'Email',
        'mapColumnField.phone' => 'Phone Number',
        'mapColumnField.created_at' => 'Date'
    ];

    // protected $listeners = ['file-upload' => 'fileUpload'];


    public function updatingFile($value) {
        Validator::make(
            [ 'file' => $value ],
            [ 'file' => 'required|mimes:csv' ],
        )->validate();
    }

    public function updatedFile() {
        $this->columns = CsvImport::from($this->file)->columns();
        $this->dictateWhichColumnsMayMapToWhichField();
    }

    public function dictateWhichColumnsMayMapToWhichField() {
        $predictions = [
            'first_name' => ['First Name', 'fname', 'first_name', 'f_name'],
            'last_name' => ['Last Name', 'lname', 'last_name', 'l_name', 'surname'],
            'email' => ['email'],
            'phone' => ['phone', 'tel', 'mobile'],
            'created_at' => ['date', 'created_at', 'recorded at', 'recorded_at'],
        ];

        foreach($this->columns as $column) {
            $match = collect($predictions)->search(fn($options)=>in_array(strtolower($column), $options));
            if($match) $this->mapColumnField[$match] = $column;
        }
    }

    public function uploadFile() {
        $this->validate();

        CsvImport::from($this->file)->eachRow(function ($row) {
            Customer::create(
                $this->extractFieldsFromRow($row)
            );
        });

        $this->reset();
    }


    public function extractFieldsFromRow($row) {
        $attributes = collect($this->mapColumnField)->filter()->mapWithKeys(function($heading, $fields) use ($row) {
            return [$fields => $row[$heading]];
        })->toArray();

        return ($attributes + ['updated_at' => now()]);
    }

    public function fileUpload($file)
    {
        

        // if (!$file) return null;
        // $name = time() . '.csv';
        // // dd($file);
        // $this->file = $file;
        // Storage::disk('public')->putFileAs('uploads', $file, $name);
        // LazyCollection::make(function () {
        //     $handle = fopen(Storage::disk('public')->get('uploads/1677096200.csv'), 'r');
        //     while (($line = fgetcsv($handle, 4096)) !== false) {
        //         $dataString = implode(", ", $line);
        //         $row = explode(';', $dataString);
        //         yield $row;
        //     }

        //     // fclose($handle);
        // })
        //     ->skip(1)
        //     ->chunk(1000)
        //     ->each(function (LazyCollection $chunk) {
        //         $records = $chunk->map(function ($row) {
        //             return [
        //                 "name" => $row[0],
        //                 "description" => $row[1],
        //             ];
        //         })->toArray();

        //         dd($records);
        //         // DB::table('products')->insert($records);
        //     });
        // dd($this->file);
        // // dd($file);
    }


    public function render()
    {
        return view('livewire.dashboard');
    }
}
