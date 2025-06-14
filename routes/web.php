<?php

use Illuminate\Support\Facades\Route;
use Typesense\Client;

Route::get('/', function () {
    $client = new Client([
        'api_key' => config('services.typesense.api_key'),
        'nodes' => [
            [
                'host' => config('services.typesense.host'),
                'port' => config('services.typesense.port'),
                'protocol' => config('services.typesense.protocol'),
            ],
        ],
        'connection_timeout_seconds' => 2,
    ]);

    $bookSchema = [
        'name' => 'books',
        'fields' => [
            ['name' => 'title', 'type' => 'string'],
            ['name' => 'author', 'type' => 'string[]'],
            ['name' => 'publication_year', 'type' => 'int32'],
            ['name' => 'ratings_count', 'type' => 'int32'],
            ['name' => 'average_rating', 'type' => 'float'],
        ],
        'default_sorting_field' => 'ratings_count',
    ];

//    $client->collections->create($bookSchema);

    $books = file_get_contents(base_path('books.jsonl'));

    $client->collections['books']->documents->import($books);


    return 'Books imported';
});
