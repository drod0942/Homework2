<!DOCTYPE html>
<html>
<head>
    <title>Update Rating</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        h1 {
            font-size: 24px;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
        <h1>Update Rating</h1>
    </header>
    <div class="container">
        <form action="#" method="post"> <!-- Specify the action for the PHP script when implementing -->
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" placeholder="Song Title">
            
            <label for="artist">Artist:</label>
            <input type="text" id="artist" name="artist" placeholder="Artist Name">
            
            <label for="rating">New Rating:</label>
            <input type="text" id="rating" name="rating" placeholder="New Rating">
            
            <input type="submit" value="Update Rating">
        </form>
    </div>
</body>
</html>
