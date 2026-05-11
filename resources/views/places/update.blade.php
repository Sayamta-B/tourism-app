<!DOCTYPE html>
<html>
<head>
    <title>Update Place</title>

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

        input, textarea, select {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        button {
            background: #198754;
            color: white;
            border: none;
            padding: 12px 18px;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background: #157347;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Update Place</h2>

    <form action="{{ route('places.update', $place->id) }}" method="POST">

        @csrf
        @method('PUT')

        <!-- NAME -->
        <div class="form-group">
            <label>Place Name</label>
            <input type="text"
                   name="name"
                   value="{{ $place->name }}"
                   required>
        </div>

        <!-- DESCRIPTION -->
        <div class="form-group">
            <label>Description</label>
            <textarea name="description">{{ $place->description }}</textarea>
        </div>

        <!-- LATITUDE -->
        <div class="form-group">
            <label>Latitude</label>
            <input type="text"
                   name="latitude"
                   value="{{ $place->latitude }}"
                   required>
        </div>

        <!-- LONGITUDE -->
        <div class="form-group">
            <label>Longitude</label>
            <input type="text"
                   name="longitude"
                   value="{{ $place->longitude }}"
                   required>
        </div>

        <!-- IMAGE -->
        <div class="form-group">
            <label>Image URL</label>
            <input type="text"
                   name="image_url"
                   value="{{ $place->image_url }}">
        </div>

        <!-- CITY -->
        <div class="form-group">
            <label>City</label>
            <select name="city_id" required>

                @foreach($cities as $city)
                    <option value="{{ $city->id }}"
                        {{ $place->city_id == $city->id ? 'selected' : '' }}>
                        {{ $city->name }}
                    </option>
                @endforeach

            </select>
        </div>

        <!-- CATEGORY -->
        <div class="form-group">
            <label>Category</label>
            <select name="category_id" required>

                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $place->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach

            </select>
        </div>

        <button type="submit">
            Update Place
        </button>

    </form>

</div>

</body>
</html>