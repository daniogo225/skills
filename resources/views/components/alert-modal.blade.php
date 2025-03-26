<div x-data="{ show: true, type: '{{ session('type', 'success') }}' }"
     x-show="show"
     x-cloak
     x-init="setTimeout(() => { show = false; $wire.closeAlertModal() }, 5000)"
     class="fixed inset-0 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" x-show="show" @click="show = false; $wire.closeAlertModal()"></div>

        <div x-show="show"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="relative bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-sm sm:w-full sm:p-6">
            <div>
                <div :class="{
                    'mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full': true,
                    'bg-green-100': type === 'success',
                    'bg-red-100': type === 'error',
                    'bg-yellow-100': type === 'warning',
                    'bg-blue-100': type === 'info'
                }">
                    <!-- Success Icon -->
                    <svg x-show="type === 'success'" class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>

                    <!-- Error Icon -->
                    <svg x-show="type === 'error'" class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>

                    <!-- Warning Icon -->
                    <svg x-show="type === 'warning'" class="h-6 w-6 text-yellow-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>

                    <!-- Info Icon -->
                    <svg x-show="type === 'info'" class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                    </svg>
                </div>
                <div class="mt-3 text-center sm:mt-5">
                    <h3 :class="{
                        'text-lg leading-6 font-medium': true,
                        'text-green-900': type === 'success',
                        'text-red-900': type === 'error',
                        'text-yellow-900': type === 'warning',
                        'text-blue-900': type === 'info'
                    }">
                        <span x-show="type === 'success'">Opération réussie</span>
                        <span x-show="type === 'error'">Erreur</span>
                        <span x-show="type === 'warning'">Attention</span>
                        <span x-show="type === 'info'">Information</span>
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">{{ session('message') }}</p>
                    </div>
                </div>
            </div>
            <div class="mt-5 sm:mt-6">
                <button type="button"
                        @click="show = false; $wire.closeAlertModal()"
                        class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">
                    Fermer
                </button>
            </div>
        </div>
    </div>
</div>
