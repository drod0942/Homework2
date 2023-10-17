<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
</head>
<body>
<h2>Add a Song</h2>
    <form action="add_song.php" method="post">
        <label>Title: <input type="text" name="title"></label>
        <label>Artist: <input type="text" name="artist"></label>
        <label>Rating: <input type="text" name="rating"></label>
        <input type="submit" value="Add Song">
    </form>
    
    <h2>List of Songs</h2>
    <iframe src="list_songs.php" width="400" height="200"></iframe>
    
    <h2>Update Song</h2>
    <form action="update_song.php" method="post">
        <label>Existing Title: <input type="text" name="existing_title"></label>
        <label>Existing Artist: <input type="text" name="existing_artist"></label>
        <label>New Title: <input type="text" name="new_title"></label>
        <label>New Artist: <input type="text" name="new_artist"></label>
        <label>New Rating: <input type="text" name="new_rating"></label>
        <input type="submit" value="Update Song">
    </form>
    
    <h2>Delete Song</h2>
    <form action="delete_song.php" method="post">
        <label>Title: <input type="text" name="title"></label>
        <label>Artist: <input type="text" name="artist"></label>
        <input type="submit" value="Delete Song">
    </form>
</body>
</html>
</body>
</html>