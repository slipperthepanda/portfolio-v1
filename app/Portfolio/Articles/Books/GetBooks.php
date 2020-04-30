<?php

namespace Ellllllen\Portfolio\Articles\Books;

use Illuminate\Support\Collection;

class GetBooks
{
    private $books;

    public function __construct(BooksInterface $books)
    {
        $this->books = $books;
    }

    public function get(): Collection
    {
        return $this->books->all();
    }
}