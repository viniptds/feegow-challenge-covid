<?php

namespace App\Http\Controllers;

use App\Jobs\WorkersWithMissingVaccinesReportJob;
use Illuminate\Http\Request;
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

        return view('workers.report')->with('files', $files);
    }

    public function makeReport()
    {
        $job = new WorkersWithMissingVaccinesReportJob;
        WorkersWithMissingVaccinesReportJob::dispatch($job);

        return redirect(route('workers.non-vaccinated-report'))->with('message', 'O relatório foi solicitado e estará pronto em breve. Atualize a página para tentar novamente');
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
