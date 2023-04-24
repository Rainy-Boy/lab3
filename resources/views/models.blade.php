<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Models</title>
</head>
<body>
    <h1>All the models for {{$manufacturer_name}}</h1>
    @if (count($carmodels) == 0)
        <p color='red'> There are no records in the database!</p>
    @else
    <ul>
            @foreach ($carmodels as $carmodel)
        <li>
            {{ $carmodel->name }}
        </li>
        @endforeach
    </ul>
    <a href="{{action([App\Http\Controllers\ModelController::class,
        'create'],['id' => $carmodel->manufacturer_id])}}">Add new model</a>
    @endif
</body>
</html>