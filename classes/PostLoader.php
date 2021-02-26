<?php


class PostLoader
{
    //properties
    private array $allPosts = [];


    //methods
    public function getAllPosts(): array
    {
        return $this->allPosts;
    }

    //save data from all_posts.txt and store them in a temporary variable
    public function setAllPosts(string $fileName): void
    {
        foreach ($this->readFile($fileName) as $temp) {
            $this->allPosts[] = $temp;
        }
    }

    //get data from all_posts.txt if file exist. It should return an array
    public function readFile(string $fileName): ? array
    {
        if (!file_get_contents($fileName)) {
            return null;
        }
        try {
            return json_decode(file_get_contents($fileName), true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            if ($e) {
                var_dump($e);
            }
            return null;
        }
    }

    //two things. If $fileName doesn't exist, store Post object (which is user input) in $addPosts as an array (toArray() method)
    //Then, use file_put_contents to create $fileName and add the array stored in $addPosts
    //Else, store Post object in $addPosts as an array in the same way, but then use the readFile method to
    //retrieve all the data from $fileName, store it in a temp variable and put it all together in $fileName
    //That is a simpler method than FILE_APPEND and avoids overwriting
    public function writePost(string $fileName, Post $post): void
    {
        if (!file_get_contents($fileName)) {
            $addPosts[] = $post->toArray();

            try {
                file_put_contents($fileName, json_encode($addPosts, JSON_THROW_ON_ERROR));

            } catch (JsonException $e) {
                if ($e) {
                    var_dump($e);
                }
                return;
            }
        } else {

            try {
                $addPosts[] = $post->toArray();
                foreach ($this->readFile($fileName) as $temp) {
                    $addPosts[] = $temp;
                }
                file_put_contents($fileName, json_encode($addPosts, JSON_THROW_ON_ERROR));

            } catch (JsonException $e) {
                if ($e) {
                    var_dump($e);
                }
                return;
            }
        }
    }


}

//if reading the file
// postLoader has to be able to receive the post from the code and read back the code saved in the file.
//return it with a method from the postLoader
