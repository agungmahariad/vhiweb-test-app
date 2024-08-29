<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- search --}}
            <div class="mb-4">
                <form action="">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md dark:bg-neutral-700 dark:text-neutral-200"
                        placeholder="Search product...">
                </form>
            </div>
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-2 w-full">
                    {{ $products->links() }}
                </div>
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
