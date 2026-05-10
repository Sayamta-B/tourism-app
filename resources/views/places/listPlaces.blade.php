<!DOCTYPE html>
<html>
<head>
    <title>All Places</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }

        h1 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
            vertical-align: top;
        }

        th {
            background: #0d6efd;
            color: white;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
        }

        img {
            width: 120px;
            border-radius: 8px;
        }

        .actions a {
            margin-right: 8px;
            text-decoration: none;
            color: #0d6efd;
            font-weight: bold;
        }

        .actions a:hover {
            text-decoration: underline;
        }

    </style>
</head>

<body>

@if(session('success'))
    <div class="alert alert-success" id="success-alert">
        {{ session('success') }}
    </div>

    <script>
        setTimeout(() => {
            const alert = document.getElementById('success-alert');
            if (alert) {
                alert.style.transition = "opacity 0.5s ease";
                alert.style.opacity = "0";
                setTimeout(() => alert.remove(), 500);
            }
        }, 3000); // disappears after 3 seconds
    </script>
@endif

<h1>All Places</h1>

<form method="GET" action="{{ route('places.index') }}" style="margin-bottom:20px;">

    <select name="city">
        <option value="">All Cities</option>

        @foreach($cities as $city)
            <option value="{{ $city->id }}"
                {{ request('city') == $city->id ? 'selected' : '' }}>
                {{ $city->name }}
            </option>
        @endforeach

    </select>

    <select name="category">
        <option value="">All Categories</option>

        @foreach($categories as $category)
            <option value="{{ $category->id }}"
                {{ request('category') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach

    </select>

    <button type="submit">Filter</button>

</form>

<table>

    <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Description</th>
            <th>City</th>
            <th>Category</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>

        @forelse($places as $place)

            <tr>

                <td>{{ $place->id }}</td>

                <td>

                    @if($place->image_url)

                        <img src="/storage/{{ $place->image_url }}"
                             onerror="this.src='https://via.placeholder.com/120x80?text=No+Image'">

                    @else

                        No Image

                    @endif

                </td>

                <td>{{ $place->name }}</td>

                <td>{{ $place->description }}</td>

                <td>{{ $place->city->name ?? 'N/A' }}</td>

                <td>{{ $place->category->name ?? 'N/A' }}</td>

                <td>{{ $place->latitude }}</td>

                <td>{{ $place->longitude }}</td>

                <td>{{ $place->created_at }}</td>

                <td>
                    <a href="{{ route('places.edit', $place->id) }}">Edit</a>

                    <form action="{{ route('places.destroy', $place->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')

                        <button type="submit" onclick="return confirm('Are you sure?')">
                            Delete
                        </button>
                    </form>
                </td>

            </tr>

        @empty

            <tr>
                <td colspan="9">
                    No places found.
                </td>
            </tr>

        @endforelse

    </tbody>

</table>

</body>
</html>