<?php

namespace App\Jobs;

use App\Models\Vaccine;
use App\Models\Worker;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class WorkersWithMissingVaccinesReportJob implements ShouldQueue
{
    use Queueable;

    private $fileName;
    private $startTime;
    const FOLDER_PATH = 'reports/non-vaccinated/';

    /**
     * Create a new job instance.
     */
    public function __construct() {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('Start building report...');
        $time = date('Y_m_d_H_i_s');

        $this->startTime = microtime();
        $this->fileName = $time . '-export-report.csv';

        $file = tmpfile();

        $header = [
            'nome_completo',
            'cpf',
            'vacinas_tomadas'
        ];

        fputcsv($file, $header, ';');

        $workers = Worker::select(['id', 'fullname', 'cpf'])->withCount('vaccines')->with('vaccines')->orderBy('fullname')->having('vaccines_count', '<', Vaccine::MAX_DOSE_COUNT)->get();

        foreach ($workers as $worker) {
            $row = [
                $worker->fullname,
                $worker->full_cpf,
                count($worker->vaccines)
            ];

            fputcsv($file, $row, ';');
        }
        
        Log::debug('Saving CSV file...');
        
        rewind($file);
        $data = stream_get_contents($file);
        fclose($file);

        Storage::put(self::FOLDER_PATH . $this->fileName, $data, 'public');
        Log::info('Job done!');
    }
}
