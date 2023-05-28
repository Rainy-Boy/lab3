<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New model for {{ $manufacturer->name }}</title>
</head>
<body>
    <h1>New model for {{ $manufacturer->name }}</h1>
    <form method="POST" action={{ action([App\Http\Controllers\ModelController::class, 'store']) }}>
        @csrf
        <input type="hidden" name="manufacturer_id" value="{{ $manufacturer->id }}">
        <label for='model_name'>Model name</label>
        <input type="text" name="model_name" id="model_name" value="{{old('model_name')}}">
        @error('model_name')
            <p>{{$message}}</p>
        @enderror
        <label for='production_started'>Production started</label>
        <input type="text" name="production_started" id="production_started" value="{{old('production_started')}}">
        @error('production_started')
            <p>{{$message}}</p>
        @enderror
        <label for='min_price'>Min price</label>
        <input type="text" name="min_price" id="min_price" value="{{old('min_price')}}">
        @error('min_price')
            <p>{{$message}}</p>
        @enderror
        <button type="submit" value="Add">Save</button>
    </form>
</body>
</html>