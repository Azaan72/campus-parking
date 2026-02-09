<x-base-layout>
    <h1 class="text-2xl font-bold mb-4">Add New User</h1>

    <form action="{{ route('users.store') }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow-md">
        @csrf

        {{-- Firstname --}}
        <div>
            <label class="block font-semibold">First name</label>
            <input
                type="text"
                name="firstname"
                class="border rounded w-full p-2"
                required
            >
        </div>

        {{-- Prefix --}}
        <div>
            <label class="block font-semibold">Prefix</label>
            <input
                type="text"
                name="prefix"
                class="border rounded w-full p-2"
                placeholder="van, de, van der"
            >
        </div>

        {{-- Lastname --}}
        <div>
            <label class="block font-semibold">Last name</label>
            <input
                type="text"
                name="lastname"
                class="border rounded w-full p-2"
                required
            >
        </div>

        {{-- Role --}}
        <div>
            <label class="block font-semibold">Role</label>
            <select name="role" class="border rounded w-full p-2" required>
                <option value="">-- Select Role --</option>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        {{-- Email --}}
        <div>
            <label class="block font-semibold">Email</label>
            <input
                type="email"
                name="email"
                class="border rounded w-full p-2"
                required
            >
        </div>

 

        {{-- Phone number --}}
        <div>
            <label class="block font-semibold">Phone number</label>
            <input
                type="text"
                name="phone_number"
                class="border rounded w-full p-2"
            >
        </div>

        {{-- Streetname --}}
        <div>
            <label class="block font-semibold">Street name</label>
            <input
                type="text"
                name="streetname"
                class="border rounded w-full p-2"
            >
        </div>

        {{-- House number --}}
        <div>
            <label class="block font-semibold">House number</label>
            <input
                type="text"
                name="house_number"
                class="border rounded w-full p-2"
            >
        </div>

        {{-- Zipcode --}}
        <div>
            <label class="block font-semibold">Zipcode</label>
            <input
                type="text"
                name="zipcode"
                class="border rounded w-full p-2"
            >
        </div>

        {{-- City --}}
        <div>
            <label class="block font-semibold">City</label>
            <input
                type="text"
                name="city"
                class="border rounded w-full p-2"
            >
        </div>

        {{-- Country --}}
        <div>
            <label class="block font-semibold">Country</label>
            <input
                type="text"
                name="country"
                class="border rounded w-full p-2"
            >
        </div>

        <button type="submit" class="btn-primary">
            Add User
        </button>
    </form>
</x-base-layout>
