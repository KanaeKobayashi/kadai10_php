<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Search</title>
    <link href="https://unpkg.com/sanitize.css" rel="stylesheet" />
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
    <header>
        <h1 class="title">本の検索</h1>
    </header>
    <form class="formWrapper" onsubmit="event.preventDefault(); searchBooks();">
        <label for="searchQuery">検索キーワード:</label>
        <input type="text" id="searchQuery"placeholder="検索キーワードを入れてください" required>
        <button type="submit">
            <i class="fa fa-search"></i> <!-- これはFontAwesomeを使用した虫眼鏡のアイコン -->
        </button>
        <button type="button" onclick="clearResults()">結果をクリア</button> <!-- 新しいクリアボタン -->
    </form>
    <div id="searchResults"></div>
    <script>
        // APIを使った本の検索（今回は題名と著者名と画像のみなのでAPI Keyは使わない、最大４０件のリクエストとする）
        async function searchBooks() {
            const searchQuery = document.getElementById('searchQuery').value;
            const url = `https://www.googleapis.com/books/v1/volumes?q=${encodeURIComponent(searchQuery)}&maxResults=40`;

            try {
                //検索APIを叩く
                const response = await fetch(url);
                //JSONに変換
                const data = await response.json();

                if (data.totalItems > 0) {
                    const resultsDiv = document.getElementById('searchResults');
                    resultsDiv.innerHTML = ''; // 検索結果をクリア

                    const books = data.items;
                    books.forEach((book) => {
                        const title = book.volumeInfo.title;
                        const authors = book.volumeInfo.authors ? book.volumeInfo.authors.join(', ') : 'Unknown Author';
                        const thumbnail = book.volumeInfo.imageLinks ? book.volumeInfo.imageLinks.thumbnail : '';

                        const bookElement = document.createElement('div');
                        bookElement.innerHTML = `
                            <img src="${thumbnail}" alt="${title}" onclick="selectBook('${title}', '${authors}','${thumbnail}')">
                            <p><strong>題名:</strong> ${title}</p>
                            <p><strong>著者:</strong> ${authors}</p>
                        `;
                        resultsDiv.appendChild(bookElement);
                    });
                } else {
                    const resultsDiv = document.getElementById('searchResults');
                    resultsDiv.innerHTML = '<p>検索結果が見つかりません</p>';
                }
            } catch (error) {
                console.log(error);
            }
        }

        function selectBook(title, authors,thumbnail) {
            // 選択した本の情報をローカルストレージに保存
            localStorage.setItem('selectedTitle', title);
            localStorage.setItem('selectedAuthor', authors);
            localStorage.setItem('selectedThumbnail', thumbnail);
            // 元のページに戻る
            window.location.href = 'form.php';
        }

        //検索結果をクリアして入力フィールドをクリアする
        function clearResults() {
        const resultsDiv = document.getElementById('searchResults');
        resultsDiv.innerHTML = ''; // 検索結果をクリア

        const searchInput = document.getElementById('searchQuery');
        searchInput.value = ''; // 検索入力フィールドをクリア
        }
    </script>
</body>
</html>