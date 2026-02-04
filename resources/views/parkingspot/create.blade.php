<x-base-layout>
    <h1 class="text-2xl font-bold mb-4">Add New Feature</h1>

    <form action="{{ route('features.store') }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow-md">
        @csrf
        <div>
            <label class="block font-semibold">Feature Name</label>
            <input type="text" name="feature_name" class="border rounded w-full p-2" required>
        </div>

        <button type="submit" class="btn-primary">Add Feature</button>
    </form>
</x-base-layout>