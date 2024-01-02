<!-- resources/views/student/clearance-phases/guidance.blade.php -->

<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    <a href="{{ route('student.clearance-phase') }}" class="block text-blue-500 hover:text-blue-700">
        {{ __('Guidance and Counselling Unit') }}</a>
</h2>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-scroll shadow-sm sm:rounded-lg p-6">
            <form action="{{ route('student.guidance') }}" method="POST">
                @csrf

                <!-- Hidden input for unit -->
                <input type="hidden" name="unit" value="Guidance and Counselling">


                <div class="form-group">
                    <button type="submit" class="form-control btn btn-primary submit px-3">Request
                        Clearance</button>
                </div>
            </form>
        </div>
    </div>
</div>
