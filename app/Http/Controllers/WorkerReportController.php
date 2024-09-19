<?php

namespace App\Http\Controllers;

use App\Jobs\WorkersWithMissingVaccinesReportJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;

class WorkerReportController extends Controller
{
    public function reportView()
    {
        $files = Storage::files(WorkersWithMissingVaccinesReportJob::FOLDER_PATH);

        $files = array_reverse($files);
        $files = array_map(function ($item) {
            return [
                'file' => substr($item, strlen(WorkersWithMissingVaccinesReportJob::FOLDER_PATH)),
                'full_path' => $item
            ];
        }, $files);

        $queue = App::make('queue.connection');
        $size = $queue->size();

        $latestFile = null;

        if ($size > 0) {
            $latestFile = false;
        } elseif (!empty($files)) {
            $latestFile = $files[0];
        }

        return view('workers.report')->with('files', $files)->with('latestFile', $latestFile);
    }

    public function makeReport()
    {
        $queue = App::make('queue.connection');
        $size = $queue->size();
        $message = 'Um relatório já foi solicitado anteriormente. Aguarde alguns instantes e atualize a página';

        if ($size == 0) {
            $job = new WorkersWithMissingVaccinesReportJob;
            WorkersWithMissingVaccinesReportJob::dispatch($job);
            $message = 'O relatório foi solicitado e estará pronto em breve. Atualize a página para tentar novamente';
        }

        return redirect(route('workers.non-vaccinated-report'))->with('message', $message);
    }

    public function getReport($type, $report)
    {
        $filePath = "reports/$type/$report";

        if (!Storage::fileExists($filePath)) {
            return route('workers.non-vaccinated-report');
        }
        return Storage::download($filePath);
    }
}
