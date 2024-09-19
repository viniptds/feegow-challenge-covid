<x-layouts.app>

    <h1 class="text-4xl font-extrabold md:text-5xl lg:text-6xl mb-3">{{ __('Vaccines') }}</h1>
    <a href="{{ route('vaccines.create') }}"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-4 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        + Nova Vacina</a>

    <div class="relative overflow-x-auto">
        <table class="mt-4 w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">

                <th class="px-6 py-4">Nome</th>
                <th class="px-6 py-4">Lote</th>
                <th class="px-6 py-4">Data de Validade</th>
                <th class="px-6 py-4">Ver</th>
            </thead>
            <tbody>
                @if (empty($vaccines))
                    <tr aria-colspan="5" colspan=5 class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <p>Não existem vacinas cadastradas</p>
                    </tr>
                @else
                    @foreach ($vaccines as $vaccine)
                        <tr id="vaccine_{{ $vaccine->id }}"
                            class="p-4 bg-white border-b dark:bg-gray-800 dark:border-gray-700 h-50">
                            <td class="px-6 py-4">{{ $vaccine->name }}</td>
                            <td class="px-6 py-4">{{ $vaccine->batch }}</td>
                            <td class="px-6 py-4">{{ $vaccine->due_date }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('vaccines.show', $vaccine) }}"
                                    class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Ver</a>
                            </td>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</x-layouts.app>
