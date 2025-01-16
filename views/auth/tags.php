<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
</head>
<body>
<!-- Select -->

<form action="/tag" method="POST">
    <input name="tags" value='' placeholder='Enter tags' autofocus>
    <button type="submit">Submit</button>
</form>
<script>
    var input = document.querySelector('input[name=tags]');

    new Tagify(input, {
        originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(',') // Convert to comma-separated string
    });
</script>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tags'])) {
    $tagsString = $_POST['tags'];

    $tagsArray = explode(',', $tagsString);

    echo "<pre>";
    print_r($tagsArray);
    echo "</pre>";
} else {
    echo "No tags submitted!";
}
