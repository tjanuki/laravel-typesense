<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Search</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-8 max-w-lg">

<form action="/search" method="GET">
    <input
        type="search"
        name="q"
        class="border border-b-gray-300 border-b-0 w-full py-2 px-4"
        value="{{request('q')}}"
    >
</form>

<ul class="border border-gray-300 py-2 px-4">
    @forelse($results as $result)
        <li>{!! $result !!}</li>
    @empty
        <li>No matching result</li>
    @endforelse
</ul>

</body>
</html>
