<!DOCTYPE html>
<html>
<head>
    <title>Word Count</title>
</head>
<body>

<form method="post">
    <label for="text">Enter your text:</label><br>
    <textarea id="text" name="text" rows="4" cols="50"></textarea><br>
    <input type="submit" value="Count Words">
</form>

<?php

function countWords($text) {
    // Convert the text to lowercase to make the counting case-insensitive
    $text = strtolower($text);
    
    // Remove punctuation marks
    $text = preg_replace('/[^\w\s]/', '', $text);
    
    // Split the text into an array of words
    $words = explode(' ', $text);
    
    // Initialize an empty array to store word counts
    $wordCounts = array();
    
    // Loop through each word in the array
    foreach ($words as $word) {
        // Trim the word to remove any leading or trailing spaces
        $word = trim($word);
        
        // If the word is not empty, count it
        if (!empty($word)) {
            // If the word already exists in the wordCounts array, increment its count
            if (array_key_exists($word, $wordCounts)) {
                $wordCounts[$word]++;
            } else {
                // Otherwise, add the word to the wordCounts array with a count of 1
                $wordCounts[$word] = 1;
            }
        }
    }
    
    // Return the array of word counts
    return $wordCounts;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the text from the form
    $text = $_POST["text"];

    // Get word counts
    $wordCounts = countWords($text);

    // Output word counts in HTML table
    echo "<h2>Word Counts:</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Word</th><th>Count</th></tr>";
    foreach ($wordCounts as $word => $count) {
        echo "<tr><td>$word</td><td>$count</td></tr>";
    }
    echo "</table>";
}

?>

</body>
</html>
