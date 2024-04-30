<?php

namespace App\Controllers;

use App\Traits\ResponseTrait;
use App\Database\QueryBuilder;

class BooksController {
    use ResponseTrait;
    protected $queryBuilder;

    public function __construct() {
        $this->queryBuilder = new QueryBuilder();
    }


    // Retrieve all books
    public function index() {
        $books =
            $this->queryBuilder
            ->table('book')->getAll()
            ->execute();

        // For demonstration purposes, I'll just return the SQL string
        return $this->sendResponse($books, "success", 200);
    }

    // Retrieve a specific book by ID
    public function show($id) {
        // Your logic to retrieve a book by ID
        $book = ["name" => "پدر پولدار", "price" => 50000, "id" => $id]; // Mock data
        if ($book) {
            return $this->sendResponse($book, "success", 200);
        } else {
            return $this->sendResponse($book, "Book not found", 404);
        }
    }

    // Store a new book
    public function store($request) {
        $newBook = $this->queryBuilder
            ->table("book")
            ->insert([
                "title" => $request->title,
                "description"=> $request->description,
                "price"  => $request->price
            ])
            ->execute();

        return $this->sendResponse(message: "success");
    }

    // Update an existing book
    public function update($id, $request) {
        $deleteBook = $this->queryBuilder
            ->table("book")
            ->update([
                "title" => $request->title,
                "description"=> $request->description,
                "price"  => $request->price
            ])
            ->where("id", "=", $id)
            ->execute();

        return $this->sendResponse(message: "success");
    }

    // Delete a book
    public function destroy($id) {
        $deleteBook = $this->queryBuilder
            ->table("book")
            ->delete()
            ->where("id", "=", $id)
            ->execute();

        return $this->sendResponse(message: "success");
    }
}