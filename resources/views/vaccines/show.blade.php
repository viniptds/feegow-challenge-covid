<x-layouts.app>
    <a href="{{ route('vaccines') }}"
        class="py-2.5 px-5 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-full border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Vacinas</a>
    / Vacina #{{ $vaccine->id }}

    <div class="item my-5 mt-4">
        <h2 class="text-4xl mt-4 mb-4">Dados da Vacina</h2>
        <div class="card">
            <p>Nome: {{ $vaccine->name }}</p>

            <p>Lote: {{ $vaccine->batch }}</p>

            <p>Data de Criação: {{ $vaccine->created_at }}</p>

            <p>Data de Validade: {{ $vaccine->due_date }}</p>

            <button type="button"
                class="btnDeleteVaccine mt-4 text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                data-id="{{ $vaccine->id }}">Apagar Vacina</button>
        </div>
    </div>
</x-layouts.app>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let deleteButtons = document.querySelectorAll('.btnDeleteVaccine');
        deleteButtons.forEach(element => {
            element.addEventListener('click', function() {
                let vaccineId = element.dataset.id;
                fetch(`{{ route('vaccines') }}/` + vaccineId, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-Token': document.querySelector('input[name="_token"]')
                            .value
                    }
                }).then(response => response.json()).then(json => {
                    if (json.status == true) {
                        window.location = json.redirect;
                    }
                });

            })
        });
    });
</script>
