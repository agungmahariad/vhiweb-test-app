<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <button id="openModalButton" class="px-4 py-2 mb-4 text-white bg-indigo-500 rounded">
                Create Product
            </button>

            <dialog id="modal" class="relative p-6 bg-white rounded-lg shadow-lg" style="width: 500px">
                <div class="flex flex-row justify-between">
                    <h2 class="mb-4 text-lg font-semibold">Create Product</h2>
                    <button id="closeModalButtonTop" class="close-button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700 hover:text-gray-900"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form action="{{ Route('product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col gap-2 w-full">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="name" id="name" required
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-200 rounded-md">
                        </div>
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" required
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-200 rounded-md"></textarea>
                        </div>
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Photo</label>
                            <input
                                className="mt-1 flex h-9 w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors"
                                id="photo" name="photo" type="file" required>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-2 mt-4 gap-2">
                        <button type="button" id="closeModalButtonBottom"
                            class="px-4 py-2 text-white bg-red-600 rounded">
                            Close
                        </button>
                        <button type="submit" id="secondaryActionButton"
                            class="px-4 py-2 text-white bg-indigo-500 rounded">Submit</button>

                    </div>
                </form>
            </dialog>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="w-full divide-y divide-gray-200 dark:divide-neutral-700">
                    <thead>
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Name</th>
                            <th scope="col"
                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Description</th>
                            <th scope="col"
                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Photo</th>
                            <th scope="col"
                                class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                        @foreach ($products as $buyer)
                            <tr>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                    {{ $buyer->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                    {{ $buyer->description }}</td>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                    <img src="{{ asset('images/' . $buyer->photo) }}" alt="{{ $buyer->name }}"
                                        class="w-10 h-10 rounded-full">
                                </td>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                    <form action="{{ Route('product.destroy', $buyer->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-red-600 hover:text-red-800 focus:outline-none focus:text-red-800 disabled:opacity-50 disabled:pointer-events-none dark:text-red-500 dark:hover:text-red-400 dark:focus:text-red-400">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        const modal = document.getElementById("modal");
        const openModalButton = document.getElementById("openModalButton");
        const closeModalButtonTop = document.getElementById(
            "closeModalButtonTop"
        );
        const closeModalButtonBottom = document.getElementById(
            "closeModalButtonBottom"
        );
        const secondaryActionButton = document.getElementById(
            "secondaryActionButton"
        );

        openModalButton.addEventListener("click", () => {
            modal.classList.remove("closing");
            modal.showModal();
            modal.classList.add("showing");
        });

        closeModalButtonTop.addEventListener("click", closeModal);
        closeModalButtonBottom.addEventListener("click", closeModal);
        secondaryActionButton.addEventListener("click", () => {
            console.log("Secondary action executed");
        });

        function closeModal() {
            modal.classList.remove("showing");
            modal.classList.add("closing");
            modal.close();
            modal.addEventListener(
                "animationend",
                () => {
                    modal.close();
                    modal.classList.remove("closing");
                }, {
                    once: true
                }
            );
        }
    </script>
</x-app-layout>
