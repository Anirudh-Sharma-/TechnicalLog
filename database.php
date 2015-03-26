<?php
/*
 * creates the new note, takes two argument the title and 
 * the whole content of the note.
 */

function createNote($title, $content) {

    try {
        $connection = new PDO('mysql:host=127.0.0.1;port=3306;dbname=minotes', "minotes", "minotes");
       // $connection->exec('SET search_path TO public');
        $query = $connection->prepare("INSERT INTO notes (content, title) VALUES (:content, :title);");
        $query->bindParam(':content', $content);
        $query->bindParam(':title', $title);
        $query->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

/*
 * fetch all the notes in the database in the descending order 
 * based on their last modification date.
 */
function getNotes() {
    try {
        $connection = new PDO('mysql:host=127.0.0.1;port=3306;dbname=minotes', "minotes", "minotes");
        //$connection->exec('SET search_path TO public');

        $query = $connection->prepare("SELECT * FROM notes ORDER BY last_modified DESC;");
        $query->execute();

        return $query->fetchAll();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
/*
 * selects the note with min id
 */
function getMinId() {
    try {
        $connection = new PDO('mysql:host=127.0.0.1;port=3306;dbname=minotes', "minotes", "minotes");
        //$connection->exec('SET search_path TO public');

        $query = $connection->prepare("SELECT min(id) FROM notes;");
        $query->execute();

        return $query->fetch()[0];
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
/*
 * selects the note with max id
 */
function getMaxId() {
    try {
        $connection = new PDO('mysql:host=127.0.0.1;port=3306;dbname=minotes', "minotes", "minotes");
        //$connection->exec('SET search_path TO public');

        $query = $connection->prepare("SELECT max(id) FROM notes;");
        $query->execute();

        return $query->fetch()[0];
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

/*
 * fetch's the note of the particular id sent
 */
function isValid($id) {
    try {
        $connection = new PDO('mysql:host=127.0.0.1;port=3306;dbname=minotes', "minotes", "minotes");
        //$connection->exec('SET search_path TO public');

        $query = $connection->prepare("SELECT * FROM notes WHERE id = :id;");
        $query->bindParam(':id', $id);
        $query->execute();

        return count($query->fetchAll()) > 0;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

/*
 * deletes the note with id passed
 */

function deleteNote($id) {
    try {
       $connection = new PDO('mysql:host=127.0.0.1;port=3306;dbname=minotes', "minotes", "minotes");
        //$connection->exec('SET search_path TO public');

        $query = $connection->prepare("DELETE FROM notes WHERE id = :id;");
        $query->bindParam(':id', $id);
        $query->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

/*
 * modifies the note with the new values
 */
function updateNote($id, $newTitle, $newContent) {
    try {
      $connection = new PDO('mysql:host=127.0.0.1;port=3306;dbname=minotes', "minotes", "minotes");
        //$connection->exec('SET search_path TO public');

        $query = $connection->prepare("UPDATE notes
                                       SET title = :title,
                                           content = :content,
                                           last_modified = CURRENT_TIMESTAMP
                                       WHERE id = :id");
        $query->bindParam(':id', $id);
        $query->bindParam(':title', $newTitle);
        $query->bindParam(':content', $newContent);
        $query->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

/*
 * fetch all the notes from the database
 */
function fetchPdfData(){
        try {
        $connection = new PDO('mysql:host=127.0.0.1;port=3306;dbname=minotes', "minotes", "minotes");
        //$connection->exec('SET search_path TO public');

        $query = $connection->prepare("SELECT * FROM notes;");
        $query->execute();

        return $query->fetchAll();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    
}


/*
 * fetch's the note with id passed
 */
function getNote($id){
        try {
       $connection = new PDO('mysql:host=127.0.0.1;port=3306;dbname=minotes', "minotes", "minotes");
        //$connection->exec('SET search_path TO public');

        $query = $connection->prepare("SELECT * FROM notes WHERE id = :id;");
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetch();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}



?>


