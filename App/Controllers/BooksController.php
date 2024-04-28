<?php

namespace App\Controllers;

use App\Traits\ResponseTrait;

class BooksController {
    use ResponseTrait;
    // Retrieve all books
    public function index() {
        // Your logic to retrieve all books
        $books = [["name" => "پدر پولدار", "price" => 50000]]; // Mock data
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
    public function store() {
        // Your logic to store a new book
        // Receive data from request body ($_POST or php://input)
        // Create a new book entry
        // Return the newly created book
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