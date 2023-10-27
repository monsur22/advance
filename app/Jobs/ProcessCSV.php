<?php

namespace App\Jobs;

use App\Models\JobQueueDemo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;

class ProcessCSV implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $filePath;
    protected $mainFilePath;

    /**
     * Create a new job instance.
     */
    public function __construct($filePath,$mainFilePath)
    {
        $this->filePath = $filePath;
        $this->mainFilePath = $mainFilePath;
    }

    /**
     * Execute the job.
     */

    public function handle(): void
    {

        foreach ($this->filePath as $filePath) {
            $csvFile = fopen(storage_path('app/' . $filePath), 'r');

            if ($csvFile) {
                $dataToInsert = [];
                while (($data = fgetcsv($csvFile)) !== false) {
                    $dataToInsert[] = [
                        'Title' => $data[0],
                        'Company' => $data[1],
                        'State' => $data[2],
                        'Revenew' => $data[3],
                    ];
                }
                JobQueueDemo::insert($dataToInsert);
                fclose($csvFile);

                // Delete the processed smaller CSV file
                File::delete(storage_path('app/' . $filePath));
            }
        }

        File::delete(storage_path('app/' . $this->mainFilePath));
    }

}
