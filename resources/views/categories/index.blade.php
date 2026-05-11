<!DOCTYPE html>
<html>
<head>
    <title>All Categories</title>

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
        }

        /* MAIN */

        .container {
            margin-left: 18%;
            width: 82%;

            padding: 20px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-bottom: 25px;
        }

        .page-header h1 {
            font-size: 30px;
            color: #111827;
        }

        .create-btn {
            background: #2563eb;
            color: white;

            text-decoration: none;

            padding: 10px 18px;
            border-radius: 10px;
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
        }

        tr:hover {
            background: #f9fafb;
        }

        /* ACTIONS */

        .actions {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .edit-btn {
            color: #2563eb;
            text-decoration: none;
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

    </style>
</head>

<body>

<div class="sidebar">

    <h2>Tourism Admin</h2>

    <a href="{{ route('places.index') }}">
        Places
    </a>

    <a href="{{ route('categories.index') }}" class="active">
        Categories
    </a>

    <a href="{{ route('cities.index') }}">
        Cities
    </a>

    <a href="#">
        Users
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

<div class="container">

    <div class="page-header">

        <h1>All Categories</h1>

        <a href="{{ route('categories.create') }}"
           class="create-btn">

            + Add Category

        </a>

    </div>

    <div class="table-wrapper">

        <table>

            <thead>

                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>

            </thead>

            <tbody>

                @forelse($categories as $category)

                    <tr>

                        <td>{{ $category->id }}</td>

                        <td>{{ $category->name }}</td>

                        <td>{{ $category->created_at }}</td>

                        <td>

                            <div class="actions">

                                <a href="{{ route('categories.edit', $category->id) }}"
                                   class="edit-btn">

                                    Edit

                                </a>

                                <form action="{{ route('categories.destroy', $category->id) }}"
                                      method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="delete-btn"
                                            onclick="return confirm('Delete category?')">

                                        Delete

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4">
                            No categories found.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

</body>
</html>