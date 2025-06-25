<?php

use Illuminate\Support\Facades\Route;
use Typesense\Client;

//Route::get('/create-collection', function (Client $client) {
//
//    $bookSchema = [
//        'name' => 'books',
//        'fields' => [
//            ['name' => 'title', 'type' => 'string'],
//            ['name' => 'authors', 'type' => 'string[]', 'facet' => true],
//            ['name' => 'publication_year', 'type' => 'int32'],
//            ['name' => 'ratings_count', 'type' => 'int32'],
//            ['name' => 'average_rating', 'type' => 'float'],
//        ],
//        'default_sorting_field' => 'ratings_count',
//    ];
//
//    $client->collections['books']->delete();
//
//    $client->collections->create($bookSchema);
//
//    return 'Collection created';
//});
//
//Route::get('/import-collection', function (Client $client) {
//
//    $books = file_get_contents(base_path('books.jsonl'));
//
//    $results = $client->collections['books']->documents->import($books);
//
//    return 'Books imported';
//});
//
//Route::get('/search-collection', function (Client $client) {
//
//    $books = file_get_contents(base_path('books.jsonl'));
//
//    $results = $client->collections['books']->documents->search([
//       'q' => request('q'),
//        'query_by' => 'title,authors',
//        'sort_by' => '_text_match:desc,publication_year:desc',
//    ]);
//
//    $titles = collect($results['hits'])->map(fn($hit) => $hit['document']['title']);
//
//    return $titles;
//});
//
//Route::get('/filter-search', function (Client $client) {
//
//    $books = file_get_contents(base_path('books.jsonl'));
//
//    $results = $client->collections['books']->documents->search([
//        'q' => request('q'),
//        'query_by' => 'title',
//        'sort_by' => '_text_match:desc,ratings_count:desc',
//        'per_page' => 50,
//        'filter_by' => 'publication_year:[1990..2000, 2010..2020]',
//    ]);
//
//    return $results;
//});
//
//Route::get('/faceting', function (Client $client) {
//
//    $results = $client->collections['books']->documents->search([
//        'q' => request('q'),
//        'query_by' => 'title',
//        'sort_by' => '_text_match:desc,ratings_count:desc',
//        'per_page' => 50,
//        'facet_by' => 'authors',
//    ]);
//
//    return $results;
//});

Route::get('/search', function (Client $client) {
    $query = request('q', '*');

    $results = $client->collections['books']->documents->search([
        'q' => $query,
        'query_by' => 'title',
    ]);

    $results = collect($results['hits'])->pluck('document.title');

    return view('search', [
        'results' => $results,
    ]);
});
