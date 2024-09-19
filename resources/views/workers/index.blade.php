<x-layouts.app>
    <h1 class="text-4xl font-extrabold md:text-5xl lg:text-6xl mb-3">{{ __('Workers') }}</h1>
    <a href="{{ route('workers.create') }}"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-4 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        + Novo
        Colaborador</a>

    <table class="mt-4 w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <th class="px-6 py-4">Nome</th>
            <th class="px-6 py-4">CPF</th>
            <th class="px-6 py-4">Data de Nascimento</th>
            <th class="px-6 py-4">Vacina Aplicada</th>
            <th class="px-6 py-4">Vacinas tomadas</th>
            <th class="px-6 py-4">Possui comorbidades?</th>
            <th class="px-6 py-4">Ver</th>
        </thead>
        <tbody>
            @if (empty($workers))
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td aria-colspan="5" colspan='5'>
                        <p>Não existem funcionários cadastrados</p>
                    </td>
                </tr>
            @else
                @foreach ($workers as $worker)
                    <tr id="worker_{{ $worker->id }}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 h-50">
                        <td class="px-6 py-4">{{ $worker->fullname }}</td>
                        <td class="px-6 py-4">{{ $worker->cpf }}</td>
                        <td class="px-6 py-4">{{ $worker->birthdate }}</td>
                        <td class="px-6 py-4">{{ count($worker->vaccines) ? $worker->vaccines[0]->name : '-' }}</td>
                        <td class="px-6 py-4">{{ count($worker->vaccines) }} / {{Vaccine::MAX_DOSE_COUNT}}</td>
                        <td class="px-6 py-4">{{ $worker->has_comorbidity ? 'Sim' : 'Não' }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('workers.show', $worker) }}" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Ver</button>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</x-layouts.app>
