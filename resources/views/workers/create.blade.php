<x-layouts.app>
    <a href="{{ route('workers') }}"
        class="py-2.5 px-5 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-full border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Colaboradores</a>
    / Cadastro

    <div class="item mt-4">
        <h2 class="text-4xl mb-4">Dados do Colaborador</h2>
        <form action="{{ route('workers.store') }}" method="POST" class="mx-2">
            @csrf

            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> Nome completo: </label>
                    <input type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        name="fullname" required value="{{ old('fullname') }}">
                </div>
            </div>

            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CPF: (somente
                        números)</label>
                    <input type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        name="cpf" required maxlength="11" value="{{ old('cpf') }}">
                </div>
            </div>

            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data de Nascimento:
                    </label>
                    <input type="date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        name="birthdate" required value="{{ old('birthdate') }}">
                </div>
            </div>

            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Possui comorbidades?:
                    </label>
                    <input type="radio"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                        name="has_comorbidity" value="1" id="has_comorbidity_true" required
                        {{ old('has_comorbidity') === '1' ? 'checked' : '' }}>
                    <label class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 me-3"
                        for="has_comorbidity_true">Sim</label>
                    <input type="radio"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                        name="has_comorbidity" value="0" id="has_comorbidity_false" required
                        {{ old('has_comorbidity') === '0' ? 'checked' : '' }}>
                    <label class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                        for="has_comorbidity_false">Não</label>
                </div>
            </div>

            @if ($errors->any())
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <div class="bg-red-100 rounded p-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <button type="submit"
                class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Salvar</button>
        </form>

    </div>
</x-layouts.app>
