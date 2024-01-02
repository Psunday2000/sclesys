<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reject Clearance Request') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-scroll shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <h3 class="font-semibold text-lg mb-4">Provide Rejection Comment</h3>

                    <form method="POST" action="{{ route('admin.submit-rejection', $clearanceRequest->id) }}">
                        @csrf

                        <div class="mb-4">
                            <label for="comment" class="block text-sm font-medium text-gray-600">Comment</label>
                            <textarea id="comment" name="comment" rows="4" class="form-input mt-1 block w-full" required></textarea>
                        </div>

                        <div class="flex items-center">
                            <button type="submit" class="btn btn-danger">
                                Submit Rejection
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
