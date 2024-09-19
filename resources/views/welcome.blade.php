<x-layouts.app>
    <h1 class="text-4xl font-extrabold md:text-5xl lg:text-6xl">Aplicação para gerenciamento de <br> Colaboradores e Vacinas</h1>

    <p class="text-gray-500 my-3">Para aplicar uma vacina a um colaborador, garanta que tenha os seguintes requisitos:</p>
    <ul class="text-gray-500 list-disc list-inside dark:text-gray-400">
        <li>Vacina cadastrada via <a class="text-blue-600 dark:text-blue-500 hover:underline" href="{{ route('vaccines.create') }}">cadastro de vacinas</a></li>
        <li>Colaborador cadastrado via <a class="text-blue-600 dark:text-blue-500 hover:underline" href="{{ route('workers.create') }}">cadastro de colaboradores</a></li>
        <li>Data de aplicação da vacina deve ser anterior ou igual a agora</li>
        <li>Data de validade da vacina deve ser superior ou igual à data de aplicação</li>
        <li>A vacina ficará fixa depois de aplicada a 1a dose, com possibilidade de aplicação da mesma vacina para doses
            seguintes </li>
    </ul>
</x-layouts.app>
