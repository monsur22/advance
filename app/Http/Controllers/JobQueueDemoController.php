<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessCSV;
use App\Models\JobQueueDemo;
use Illuminate\Http\Request;

class JobQueueDemoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('upload');
    }

    public function upload(Request $request){
        $file = $request->file('csv');
        $filePath = $file->store('csv'); // Store the original file in the storage/app/csv directory
        // dd($filePath);

        // Read the content of the uploaded CSV file
        $csvData = file(storage_path('app/' . $filePath), FILE_IGNORE_NEW_LINES);

        // Set your desired chunk size
        $chunkSize = 1000;

        // Divide the content into smaller chunks
        $chunks = array_chunk($csvData, $chunkSize);

        // Create and store smaller CSV files for each chunk
        $chunkFiles = [];

        foreach ($chunks as $index => $chunk) {
            $newFilePath = "csv/chunk{$index}.csv"; // Modify the path as needed
            file_put_contents(storage_path('app/' . $newFilePath), implode(PHP_EOL, $chunk));
            $chunkFiles[] = $newFilePath;
        }

        // Now, you have an array of paths to the smaller CSV files (chunkFiles)

        // Dispatch a job to process these smaller files
        ProcessCSV::dispatch($chunkFiles,$filePath);

        return 'done';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(JobQueueDemo $jobQueueDemo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobQueueDemo $jobQueueDemo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobQueueDemo $jobQueueDemo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobQueueDemo $jobQueueDemo)
    {
        //
    }
}
