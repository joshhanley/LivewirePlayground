<x-app-layout>
    <div class="flex justify-center">
        <form action="/other" method="POST">
            @csrf
            <button class="px-4 py-2 text-white bg-gray-700 rounded shadow">Submit</button>
        </form>
    </div>
</x-app-layout>
