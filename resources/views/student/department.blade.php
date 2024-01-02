<!-- resources/views/student/clearance-phases/department.blade.php -->

<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    <a href="{{ route('student.clearance-phase') }}" class="block text-blue-500 hover:text-blue-700">
        {{ __('Department Unit') }}</a>
</h2>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-scroll shadow-sm sm:rounded-lg p-6">

            <form action="{{ route('student.department') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Hidden input for unit -->
                <input type="hidden" name="unit" value="Department">

                <!-- Form fields specific to the Department Unit -->
                <div class="form-group mb-3">
                    <label class="label" for="registration_number">Registration Number</label>
                    <input type="text" name="registration_number" class="form-control"
                        placeholder="Enter Registration Number" required>
                </div>

                <div class="form-group mb-3">
                    <label class="label" for="name">Name of Student</label>
                    <input type="text" name="name_of_student" class="form-control" value="{{ Auth::user()->name }}"
                        readonly>
                </div>

                <div class="form-group mb-3">
                    <label class="label" for="programme">Programme</label>
                    <select name="programme" class="form-control" required>
                        @foreach ($programmes as $programme)
                            <option value="{{ $programme->slug }}">{{ $programme->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="form-control btn btn-primary submit px-3">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
