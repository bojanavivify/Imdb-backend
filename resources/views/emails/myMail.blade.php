<!DOCTYPE html>
<html>
<head>
    <title>Imdb</title>
</head>
<body>
    <h1>{{ $details['title'] }}</h1>
    <p>A new movie {{ $details['title-movie']}} is added to the system.</p>
    <p>Movie information:</p>
    <p>
        <b>Title:</b> 
        <i>{{ $details['title-movie']}}</i>
    </p>
    <p>
        <b>Description:</b> 
        <i>{{ $details['description']}}</i>
    </p>
    <img src="{{$message->embed($details['image'])}}"/>
    <p>Thank you</p>
</body>
</html>