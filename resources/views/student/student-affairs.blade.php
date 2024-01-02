<!-- resources/views/student/clearance-phases/student-affairs.blade.php -->

<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    <a href="{{ route('student.clearance-phase') }}" class="block text-blue-500 hover:text-blue-700">
        {{ __('Student Affairs Unit') }}</a>
</h2>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-scroll shadow-sm sm:rounded-lg p-6">
            <form action="{{ route('student.student-affairs') }}" method="POST">
                @csrf

                <!-- Hidden input for unit -->
                <input type="hidden" name="unit" value="Student Affairs">

                <!-- Form fields for Student Affairs Unit -->
                <div class="form-group mb-3">
                    <label class="label" for="convocation_fee_rrr">Convocation Fee RRR</label>
                    <input type="text" name="convocation_fee_rrr" class="form-control"
                        placeholder="Convocation Fee RRR" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="form-control btn btn-primary submit px-3">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
