<!-- resources/views/student/clearance-phases/library.blade.php -->

<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    <a href="{{ route('student.clearance-phase') }}" class="block text-blue-500 hover:text-blue-700">
        {{ __('Library Unit') }}</a>
</h2>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-scroll shadow-sm sm:rounded-lg p-6">
            <form action="{{ route('student.library') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Hidden input for unit -->
                <input type="hidden" name="unit" value="Library">

                <!-- Form fields specific to the Library Unit -->
                <div class="form-group mb-3">
                    <label class="label" for="library_card_image">Image of the Library Card</label>
                    <input type="file" name="library_card_image" class="form-control" accept="image/*" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="form-control btn btn-primary submit px-3">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
