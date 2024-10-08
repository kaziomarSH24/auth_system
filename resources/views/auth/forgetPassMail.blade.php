<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$data['title']}}</title>
    
</head>
<body>
    <p>{{$data['body']}}</p>
    <a href="{{ $data['url'] }}">Reset your password</a>
</body>
</html>


<script>
    
    fetch('http://127.0.0.1:8000/verify-email/'+data['url'], {
    method: 'GET',
    headers: {
        'Authorization': 'Bearer ' + localStorage.getItem('user_token'), 
        'Content-Type': 'application/json',
    },
    body: JSON.stringify({
        
    }),
})
.then(response => response.json())
.then(data => console.log(data))
.catch(error => console.error('Error:', error));

</script>