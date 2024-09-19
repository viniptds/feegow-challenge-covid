<x-layouts.app>
    <h1 class="text-4xl font-extrabold md:text-5xl lg:text-6xl mb-3">Relatório de Funcionários Não-Vacinados</h1>


    @if (!empty($files))
        Último Relatório: <i>{{$files[0]['file']}}</i>
        <button id="getLatestReport" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 ml-3 btnDownloadFile" data-file="{{$files[0]['full_path']}}" >Baixar último relatório</button>
    @endif

    <br>

    <form action="{{ route('workers.make-report') }}" method="POST">
        @csrf
        <button id="makeNewReport" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 " type="submit">Gerar Novo relatório</button>
    </form>
    @if (Session::has('message'))
    <div class="bg-green-100 rounded p-4 w-50">
        <p>{{Session::get('message')}}</p>
    </div>
    @endif

    @if(!empty($files))
    <hr class="h-px my-5 bg-gray-700 border-0 dark:bg-gray-700" />
    <h2 class="text-2xl font-extrabold mb-3">Últimos relatórios</h2>

    <ul>
        @foreach ($files as $file)
            <li>
                <i>{{ $file['file'] }}</i>
                <button type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 ml-3  dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 btnDownloadFile" data-file="{{ $file['full_path'] }}">Baixar</button>
            </li>
        @endforeach
    </ul> 
    @endif
</x-layouts.app>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let downloadButtons = document.querySelectorAll('.btnDownloadFile');
        downloadButtons.forEach(element => {
            element.addEventListener('click', function() {
                let downloadPath = element.dataset.file;

                let url = '{{route("workers")}}/' + downloadPath;
                window.location = url;
            })
        });
});
</script>
