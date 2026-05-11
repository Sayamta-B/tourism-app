<!DOCTYPE html>
<html>
<head>
    <title>Create Category</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 30px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        button {
            background: #0d6efd;
            color: white;
            border: none;
            padding: 12px 18px;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background: #0b5ed7;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Add New Place</h2>

    <form action="{{ route('categories.store') }}" method="POST">

        @csrf

        <!-- PLACE NAME -->
        <div class="form-group">
            <label>Category Name</label>

            <input type="text"
                   name="name"
                   placeholder="Enter category name"
                   required>
        </div>

       
        <button type="submit">
            Save Category
        </button>

    </form>

</div>

</body>
</html>