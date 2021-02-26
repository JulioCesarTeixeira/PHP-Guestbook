<?php

use JetBrains\PhpStorm\ArrayShape;

class Post
{
    private string $title;
    private string $date;
    private string $content;
    private string $author;


    public function __construct(string $title, string $content, string $author)
    {
        $this->title = $title;
        $this->date = date("Y/m/d  H:i:s");
        $this->content = $content;
        $this->author = $author;
    }

    #[ArrayShape(['title' => "string", 'date' => "string", 'content' => "string", 'author' => "string"])]
    public function toArray(): array {
        return [
            'title'=> $this->title,
            'date'=> $this->date,
            'content'=> $this->content,
            'author'=> $this->author,
        ];
    }

//    public function getTitle(): string
//    {
//        return $this->title;
//    }
//
//    public function setTitle(string $title): Post
//    {
//        $this->title = $title;
//        return $this;
//    }
//
//    public function getDate(): string
//    {
//        return $this->date;
//    }
//
//    public function setDate(string $date): Post
//    {
//        $this->date = $date;
//        return $this;
//    }
//
//    public function getContent(): string
//    {
//        return $this->content;
//    }
//
//    public function setContent(string $content): Post
//    {
//        $this->content = $content;
//        return $this;
//    }
//
//    public function getAuthor(): string
//    {
//        return $this->author;
//    }
//
//    public function setAuthor(string $author): Post
//    {
//        $this->author = $author;
//        return $this;
//    }


}