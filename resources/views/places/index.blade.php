<!DOCTYPE html>
<html>
<head>
    <title>All Places</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;

            display: flex;
        }

        /* SIDEBAR */

        .sidebar {
            width: 18%;
            height: 100vh;

            background: #111827;

            position: fixed;
            left: 0;
            top: 0;

            padding: 25px 18px;

            display: flex;
            flex-direction: column;
        }

        .sidebar h2 {
            color: white;
            margin-bottom: 35px;
            font-size: 24px;
        }

        .sidebar a {
            color: #d1d5db;
            text-decoration: none;

            padding: 12px 16px;
            border-radius: 10px;

            margin-bottom: 8px;

            transition: 0.2s ease;
            font-weight: 500;
        }

        .sidebar a:hover {
            background: #1f2937;
            color: white;
        }

        .sidebar a.active {
            background: #2563eb;
            color: white;
        }

        .logout-form {
            margin-top: auto;
        }

        .logout-btn {
            width: 100%;

            background: #dc2626;
            color: white;

            border: none;
            border-radius: 10px;

            padding: 12px;
            cursor: pointer;

            font-weight: bold;
            transition: 0.2s ease;
        }

        .logout-btn:hover {
            background: #b91c1c;
        }

        /* MAIN CONTENT */

        .container {
            margin-left: 240px;
            width: 92%;
            overflow: hidden;

            padding: 20px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-bottom: 25px;
        }

        .page-header h1 {
            color: #111827;
            font-size: 30px;
        }

        .create-btn {
            background: #2563eb;
            color: white;

            text-decoration: none;

            padding: 10px 18px;
            border-radius: 10px;

            transition: 0.2s ease;
        }

        .create-btn:hover {
            background: #1d4ed8;
        }

        /* FILTERS */

        .filters {
            background: white;

            padding: 20px;
            border-radius: 12px;

            margin-bottom: 25px;

            display: flex;
            gap: 15px;
            align-items: center;

            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .filters select,
        .filters button {
            padding: 10px 14px;

            border-radius: 8px;
            border: 1px solid #d1d5db;

            font-size: 14px;
        }

        .filters button {
            background: #2563eb;
            color: white;

            border: none;
            cursor: pointer;
        }

        .filters button:hover {
            background: #1d4ed8;
        }

        /* TABLE */

        .table-wrapper {
            background: white;

            border-radius: 12px;
            overflow: hidden;

            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: auto;
        }

        th {
            background: #111827;
            color: white;

            padding: 14px;
            text-align: left;
        }

        td {
            padding: 14px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: top;
        }

        tr:hover {
            background: #f9fafb;
        }

        img {
            width: 120px;
            border-radius: 10px;
        }

        /* ACTIONS */

        .actions {
            display: flex;
            flex-direction: column;
            gap: 10px;
            align-items: center;
        }

        .edit-btn {
            text-decoration: none;
            color: #2563eb;
            font-weight: bold;
        }

        .delete-btn {
            background: #dc2626;
            color: white;

            border: none;
            padding: 8px 12px;

            border-radius: 6px;
            cursor: pointer;
        }

        .delete-btn:hover {
            background: #b91c1c;
        }

        /* ALERT */

        .top-alert {
            position: fixed;
            top: 20px;
            right: 20px;
            width: 80%;

            background: #d1fae5;
            color: #065f46;

            padding: 14px 20px;
            border-radius: 10px;

            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;

            box-shadow: 0 4px 14px rgba(0,0,0,0.1);

            z-index: 9999;
        }

        .close-btn {
            background: none;
            border: none;

            font-size: 20px;
            cursor: pointer;

            color: #065f46;
        }

    </style>
</head>

<body>

{{-- SUCCESS ALERT --}}
@if(session('success'))

    <div id="success-alert" class="top-alert">

        <span>{{ session('success') }}</span>

        <button onclick="closeAlert()" class="close-btn">
            &times;
        </button>

    </div>

    <script>
        function closeAlert() {
            const alert = document.getElementById('success-alert');

            if (alert) {
                alert.style.transition = "0.3s ease";
                alert.style.opacity = "0";
                alert.style.transform = "translateY(-10px)";

                setTimeout(() => {
                    alert.remove();
                }, 300);
            }
        }

        setTimeout(() => {
            closeAlert();
        }, 3000);
    </script>

@endif

{{-- SIDEBAR --}}
<div class="sidebar">

    <h2>Tourism Admin</h2>

    <a href="{{ route('places.index') }}" class="active">
        Places
    </a>

    <a href="{{ route('categories.index') }}">
        Categories
    </a>

    <a href="{{ route('cities.index') }}">
        Cities
    </a>

    <form method="POST"
          action="{{ route('logout') }}"
          class="logout-form">

        @csrf

        <button type="submit" class="logout-btn">
            Logout
        </button>

    </form>

</div>

{{-- MAIN CONTENT --}}
<div class="container">

    <div class="page-header">

        <h1>All Places</h1>

        <a href="{{ route('places.create') }}"
           class="create-btn">

            + Add Place

        </a>

    </div>

    {{-- FILTERS --}}
    <form method="GET"
          action="{{ route('places.index') }}"
          class="filters">

        <select name="city">

            <option value="">
                All Cities
            </option>

            @foreach($cities as $city)

                <option value="{{ $city->id }}"
                    {{ request('city') == $city->id ? 'selected' : '' }}>

                    {{ $city->name }}

                </option>

            @endforeach

        </select>

        <select name="category">

            <option value="">
                All Categories
            </option>

            @foreach($categories as $category)

                <option value="{{ $category->id }}"
                    {{ request('category') == $category->id ? 'selected' : '' }}>

                    {{ $category->name }}

                </option>

            @endforeach

        </select>

        <button type="submit">
            Filter
        </button>

    </form>

    {{-- TABLE --}}
    <div class="table-wrapper">

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
                    <th>Created</th>
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

                            <div class="actions">

                                <a href="{{ route('places.edit', $place->id) }}"
                                   class="edit-btn">

                                    Edit

                                </a>

                                <form action="{{ route('places.destroy', $place->id) }}"
                                      method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="delete-btn"
                                            onclick="return confirm('Are you sure?')">

                                        Delete

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="10">
                            No places found.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

</body>
</html>