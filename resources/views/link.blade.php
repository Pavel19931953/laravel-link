<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Shortener</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">URL Shortener</h1>
    <form id="shorten-form" class="mt-4">
        <div class="mb-3">
            <label for="url" class="form-label">Enter URL</label>
            <input type="url" class="form-control" id="url" placeholder="https://example.com" required>
        </div>
        <button type="submit" class="btn btn-primary">Shorten</button>
    </form>
    <div id="result" class="mt-4" style="display: none;">
        <h3>Your Shortened URL:</h3>
        <a href="#" id="short-url" target="_blank"></a>
    </div>
</div>

<script>
    document.getElementById('shorten-form').addEventListener('submit', function (e) {
        e.preventDefault();

        const url = document.getElementById('url').value;
        axios.post('/shorten', { url })
            .then(response => {
                const shortUrl = response.data.short_url;
                document.getElementById('short-url').href = shortUrl;
                document.getElementById('short-url').textContent = shortUrl;
                document.getElementById('result').style.display = 'block';
            })
            .catch(error => {
                alert('An error occurred: ' + error.response.data.message);
            });
    });
</script>
</body>
</html>
