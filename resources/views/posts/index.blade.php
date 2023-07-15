@extends('app')
@section('content')
    @if(session()->has('message'))
        <div id="toast-warning" class="flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-orange-500 bg-orange-100 rounded-lg dark:bg-orange-700 dark:text-orange-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
                </svg>
                <span class="sr-only">Warning icon</span>
            </div>
            <div class="ml-3 text-sm font-normal">{{ session()->get('message') }}</div>
        </div>
    @endif
    <div class="py-12">
        <div class="text-end py-3">
            <a href="{{ route('posts.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Добавить
            </a>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Наименование поста
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Edit/Delete</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $post['id'] }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $post['title'] }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('posts.edit', ['id' => $post['id']]) }}" class="mr-5 font-medium text-blue-600 dark:text-blue-500 hover:underline">Редактировать</a>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('delete-post{{$post['id']}}-form').submit();" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Удалить</a>
                            <form id="delete-post{{$post['id']}}-form" action="{{ route('posts.delete', ['id' => $post['id']]) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
        {{ $posts->links() }}

    </div>
@endsection
