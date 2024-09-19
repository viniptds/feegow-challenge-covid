<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplyVaccineRequest;
use App\Models\Vaccine;
use App\Models\Worker;
use Exception;

class WorkerVaccineController extends Controller
{
    public function applyVaccine(ApplyVaccineRequest $request, Worker $worker)
    {
        $data = $request->validated();

        $workerVaccines = $worker->vaccines;
        $totalVaccines = count($workerVaccines);

        if ($totalVaccines >= Vaccine::MAX_DOSE_COUNT) {
            throw new Exception("Este colaborador já recebeu {$totalVaccines}/" . Vaccine::MAX_DOSE_COUNT . ' dose(s) da vacina');
        }

        if ($totalVaccines > 0 && $workerVaccines[0]->id != $data['vaccine_id']) {
            throw new Exception("A vacina aplicada deve ser a mesma da primeira dose");
        }

        $vaccineSelected = Vaccine::find($data['vaccine_id']);

        if (date('Y-d-m H:i:s', strtotime($vaccineSelected->due_date)) < date('Y-m-d H:i:s', strtotime($data['applied_at']))) {
            throw new Exception('A vacina está vencida e não pode ser aplicada nesta data');
        }

        $vaccine = [[
            'worker_id' => $worker->id,
            'vaccine_id' => $data['vaccine_id'],
            'applied_at' => $data['applied_at'],
        ]];

        $worker->vaccines()->sync($vaccine, false);

        return response()->json([
            'status' => true,
            'redirect' => route('workers.show', $worker)
        ]);
    }
}
