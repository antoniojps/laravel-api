<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <!-- Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    </head>
    <body>
        <div class="container" style="padding:2rem;">
            <div class="row">
                <h1>Upload a picture</h1>
            </div>
            <div class="row">
                <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="file" name="picture"  accept="image/png" style="margin:20px 0;">
                    <input type="submit" class="btn btn-primary" value="Upload">
                </form>
            </div>
            <div class="row">
                </hr>
                @if (file_exists(public_path('storage/uploadedPic.png')))
                <img class="shadow-lg rounded float-left img-fluid" style="height:200px" src="{{ asset('storage/uploadedPic.png') }}"/>
                @else
                <div class="shadow-lg alert alert-light" role="alert">
                    Please upload a picture...
                </div>
                @endif
            </div>
        </div>
    </body>
</html>
