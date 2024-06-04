@extends('layouts.master')


@section('content')


        <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg">
            <div class="py-6 px-4 sm:px-6 lg:px-8">
                    <h2 class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __('Pagina principala') }}
                    </h2>
            </div>
        </div>

        <div class="py-12">
            <div class="sm:px-6 lg:px-8 flex flex-col">
                <div class="bg-white dark:bg-gray-800 overflow-hidden mt-3 mb-3 shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __("Esti autentificat!") }}
                    </div>
                </div>

                <a style="padding: 20px; color: white; background-color: #44bb92"
                   class="mt-3 mb-3 shadow-sm sm:rounded-lg"
                   href="{{route('client.privateIndex')}}">
                    Contact
                </a>

                <a style="padding: 20px; color: white; background-color: #44bb92;"
                   class="mt-3 mb-3 shadow-sm sm:rounded-lg"
                   href="{{route('numbers.privateIndex')}}">
                    Pagina Numerele companiei
                </a>

                <a style="padding: 20px; color: white; background-color: #44bb92;"
                   class="mt-3 mb-3 shadow-sm sm:rounded-lg"
                   href="{{route('jobs.privateIndex')}}">
                    Pagina Cariera
                </a>

                <a style="padding: 20px; color: white; background-color: #44bb92;"
                   class="mt-3 mb-3 shadow-sm sm:rounded-lg"
                   href="{{route('events.privateIndex')}}">
                    Pagina Evenimente
                </a>

                <a style="padding: 20px; color: white; background-color: #44bb92;"
                   class="mt-3 mb-3 shadow-sm sm:rounded-lg"
                   href="{{route('persons.privateIndex')}}">
                    Pagina Reprezentanti
                </a>

                <a style="padding: 20px; color: white; background-color: #44bb92;"
                   class="mt-3 mb-3 shadow-sm sm:rounded-lg"
                   href="{{route('partners.privateIndex')}}">
                    Pagina Parteneri
                </a>

                <a style="padding: 20px; color: white; background-color: #44bb92;"
                   class="mt-3 mb-3 shadow-sm sm:rounded-lg"
                   href="{{route('partners.privateIndex')}}">
                    Pagina Producatori
                </a>

            </div>
        </div>


@endsection
