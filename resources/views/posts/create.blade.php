@extends('app')
@section('content')
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Создание поста</h2>
    </div>
    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="{{ route('posts.store') }}" method="POST" autocomplete="off">
            @csrf
            <div>
                <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Название</label>
                <div class="mt-2">
                    <input id="title" name="title" type="text" autocomplete="off" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    @if ($errors->has('title'))
                        <span class="text-red-700">{{ $errors->first('title') }}</span>
                    @endif
                </div>
            </div>

            <div>
                <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Текст</label>
                <div class="mt-2">
                    <textarea name="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                    @if ($errors->has('text'))
                        <span class="text-red-700">{{ $errors->first('text') }}</span>
                    @endif
                </div>
            </div>

            <div>
                <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Автор</label>
                <div class="mt-2">
                    <input id="author_name" name="author_name" type="text" autocomplete="off" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    @if ($errors->has('author_name'))
                        <span class="text-red-700">{{ $errors->first('author_name') }}</span>
                    @endif
                </div>
            </div>

            <div>
                <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Создать</button>
            </div>
        </form>
    </div>
@endsection
