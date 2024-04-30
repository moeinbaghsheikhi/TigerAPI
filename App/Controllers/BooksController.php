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
            ->table('book')->get()
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
    public function update($id) {
        // Your logic to update an existing book by ID
        // Receive data from request body ($_POST or php://input)
        // Update the book entry with the given ID
        // Return the updated book
    }

    // Delete a book
    public function destroy($id) {
        // Your logic to delete a book by ID
        // Find the book entry with the given ID
        // Delete the book entry
        // Return a success message
    }
}