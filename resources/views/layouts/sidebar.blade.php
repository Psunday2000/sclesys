@auth
    @php
        $roleId = Auth::user()->role_id;
    @endphp

    @switch($roleId)
        @case(1)
            {{-- Superadmin --}}
            @include('sidebar.superadmin')
        @break

        @case(2)
            {{-- Admin --}}
            @include('sidebar.admin')
        @break

        @case(3)
            {{-- Staff --}}
            @include('sidebar.staff')
        @break

        @case(4)
            {{-- Student --}}
            @include('sidebar.student')
        @break

        @default
            {{-- Default --}}
            {{-- Include a default sidebar or handle accordingly --}}
            <p>No specific sidebar for this user role.</p>
    @endswitch
@endauth
