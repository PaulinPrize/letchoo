<x-app-layout>
    <x-slot name="header"></x-slot>
    <div class="section1">

        <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
            <h3 class="text-center">
                {{__('messages.A problem with your internet connection ?')}}<br>
                {{__('messages.Please refresh the page')}} 
            </h3>
        </div>
    </div>
</x-app-layout>