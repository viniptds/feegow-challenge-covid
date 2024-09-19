<x-layouts.app>
    <a href="{{ route('workers') }}"
        class="py-2.5 px-5 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-full border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">{{ __('Workers') }}</a>
    / Colaborador #{{ $worker->id }}

    <div class="item my-5 mx-2">
        <h2 class="text-4xl mt-4 mb-4">Dados do Colaborador </h2>
        <p>Nome completo: {{ $worker->fullname }}</p>
        <p>CPF: {{ $worker->cpf }}</p>
        <p>Data de Nascimento: {{ $worker->birthdate }}</p>
        <p>Possui comorbidades? {{ $worker->has_comorbidity ? 'Sim' : 'Não' }}</p>

        <button type="button"
            class="btnDeleteWorker mt-4 text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
            data-id="{{ $worker->id }}">Apagar</button>
    </div>
    <hr class="h-px my-5 bg-gray-700 border-0 dark:bg-gray-700" />
    <div class="vaccines">
        <h2 class="text-4xl mt-4 mb-4">Vacinas Aplicadas</h2>

        @if (count($worker->vaccines) == 0)
            <p class="my-3">Não há vacinas aplicadas</p>
        @else
            <ul>
                @foreach ($worker->vaccines as $dose => $workerVaccine)
                    <li
                        class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 mb-3">
                        Vacina: {{ $workerVaccine->name }} - {{ $workerVaccine->batch }}
                        <br>
                        Dose: Dose {{ $dose + 1 }}
                        <br>
                        Data da Aplicação: {{ $workerVaccine->pivot->applied_at }}
                    </li>
                @endforeach
            </ul>
        @endif

        @if (count($worker->vaccines) < 3)

            <div id="add-vaccine" class="block border rounded shadow bg-white p-6">
                <h3 class="text-2xl mb-4">Aplicar Vacina</h3>
                <form action="{{ route('workers.apply-vaccine', $worker) }}">
                    @csrf
                    @if (count($worker->vaccines) == 0)
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <label for="vaccine_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selecione a vacina:</label>
                                <select name="vaccine_id" id="vaccine_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Selecione</option>
                                    @foreach ($vaccines as $vaccine)
                                        <option value="{{ $vaccine->id }}">{{ $vaccine->name }} -
                                            {{ $vaccine->due_date }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    @else
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <label for="vaccine_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vacina selecionada:</label>
                                <input type="hidden" id="vaccine_id" name="vaccine_id"
                                    value="{{ $worker->vaccines[0]->id }}">
                                <input type="text" readonly
                                    value="{{ $worker->vaccines[0]->name }} - {{ $worker->vaccines[0]->due_date }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                        </div>
                    @endif

                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data de Aplicação: </label>
                            <input type="datetime-local" name="applied_at" id="applied_at" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ date('Y-m-d H:i:s') }}">
                        </div>
                    </div>
                    <button type='button' id="btnAddVaccine"
                        class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Confirmar
                        aplicação</button>

                </form>
            </div>

        @endif

    </div>
</x-layouts.app>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let deleteButtons = document.querySelectorAll('.btnDeleteWorker');
        deleteButtons.forEach(element => {
            element.addEventListener('click', function() {
                let workerId = element.dataset.id;
                fetch(`{{ route('workers') }}/` + workerId, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-Token': document.querySelector('input[name="_token"]')
                            .value
                    }
                }).then(response => response.json()).then(json => {
                    if (json.status == true) {
                        window.location = json.redirect;
                    }
                }).catch(e => {
                    window.location = "{{ route('workers') }}";
                });

            })
        });

        let addVaccineButton = document.querySelector('#btnAddVaccine');
        addVaccineButton.addEventListener('click', function() {
            let data = {
                vaccine_id: document.querySelector('#vaccine_id').value,
                applied_at: document.querySelector('#applied_at').value,
            }

            fetch("{{ route('workers.apply-vaccine', $worker) }}", {
                method: 'POST',
                body: JSON.stringify(data),
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    'X-CSRF-Token': document.querySelector('input[name="_token"]')
                        .value
                }
            }).then(response => response.json()).then(json => {
                if (json.status == true) {
                    window.location = json.redirect;
                    window.location.reload(true);
                    window.location.href = window.location.href;
                } else {
                    alert(json.message)
                }

            }).catch(e => {
                console.log(e)
            })
        })
    });
</script>
