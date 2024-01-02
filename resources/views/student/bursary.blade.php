<!-- resources/views/student/clearance-phases/bursary.blade.php -->
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    <a href="{{ route('student.clearance-phase') }}" class="block text-blue-500 hover:text-blue-700">
        {{ __('Bursary Unit') }}</a>
</h2>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-scroll shadow-sm sm:rounded-lg p-6">
            <form action="{{ route('student.bursary') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Hidden input for unit -->
                <input type="hidden" name="unit" value="Bursary">

                <!-- Form fields for Bursary Unit -->
                <div class="form-group mb-3">
                    <label class="label" for="first_year_school_fees">First Year School Fees Image (Upload)</label>
                    <input type="file" name="first_year_school_fees_image" class="form-control" accept="image/*"
                        required>
                </div>

                <div class="form-group mb-3">
                    <label class="label" for="second_year_school_fees">Second Year School Fees Image
                        (Upload)</label>
                    <input type="file" name="second_year_school_fees_image" class="form-control" accept="image/*"
                        required>
                </div>

                <div class="form-group">
                    <button type="submit" class="form-control btn btn-primary submit px-3">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
