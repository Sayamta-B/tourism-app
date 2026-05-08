<!DOCTYPE html>
<html>
<head>
    <title>Create Place</title>

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

    <form action="{{ route('places.store') }}" method="POST">

        @csrf

        <!-- PLACE NAME -->
        <div class="form-group">
            <label>Place Name</label>

            <input type="text"
                   name="name"
                   placeholder="Enter place name"
                   required>
        </div>

        <!-- DESCRIPTION -->
        <div class="form-group">
            <label>Description</label>

            <textarea name="description"
                      placeholder="Enter description"></textarea>
        </div>

        <!-- LATITUDE -->
        <div class="form-group">
            <label>Latitude</label>

            <input type="text"
                   name="latitude"
                   placeholder="27.7172"
                   required>
        </div>

        <!-- LONGITUDE -->
        <div class="form-group">
            <label>Longitude</label>

            <input type="text"
                   name="longitude"
                   placeholder="85.3240"
                   required>
        </div>

        <!-- IMAGE URL -->
        <div class="form-group">
            <label>Image URL</label>

            <input type="text"
                   name="image_url"
                   placeholder="places/example.jpg">
        </div>

        <!-- CITY -->
        <div class="form-group">
            <label>City</label>

            <select name="city_id" required>

                <option value="">
                    Select City
                </option>

                @foreach($cities as $city)

                    <option value="{{ $city->id }}">
                        {{ $city->name }}
                    </option>

                @endforeach

            </select>
        </div>

        <!-- CATEGORY -->
        <div class="form-group">
            <label>Category</label>

            <select name="category_id" required>

                <option value="">
                    Select Category
                </option>

                @foreach($categories as $category)

                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>

                @endforeach

            </select>
        </div>

        <button type="submit">
            Save Place
        </button>

    </form>

</div>

</body>
</html>