<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>COBA 1</title>
</head>
<body>
    {{-- Old way --}}
    <h1 class="text-center font-bold text-[40px] py-[40px]">Hello, <?php echo $name; ?> !</h1> 
    
    {{-- New way - php tag is optional --}}
    <h1>Hello, {{$name}} !</h1>
    <h3>Umur anda adalah {{$age}} Tahun !</h3>
</body>
</html>