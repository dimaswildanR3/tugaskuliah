<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="apple-touch-icon" sizes="57x57" href="./favicon/apple-icon-57x57.png" />
<link rel="apple-touch-icon" sizes="60x60" href="./favicon/apple-icon-60x60.png" />
<link rel="apple-touch-icon" sizes="72x72" href="./favicon/apple-icon-72x72.png" />
<link rel="apple-touch-icon" sizes="76x76" href="./favicon/apple-icon-76x76.png" />
<link rel="apple-touch-icon" sizes="114x114" href="./favicon/apple-icon-114x114.png" />
<link rel="apple-touch-icon" sizes="120x120" href="./favicon/apple-icon-120x120.png" />
<link rel="apple-touch-icon" sizes="144x144" href="./favicon/apple-icon-144x144.png" />
<link rel="apple-touch-icon" sizes="152x152" href="./favicon/apple-icon-152x152.png" />
<link rel="apple-touch-icon" sizes="180x180" href="./favicon/apple-icon-180x180.png" />
<link rel="icon" type="image/png" sizes="192x192" href="./favicon/android-icon-192x192.png" />
<link rel="icon" type="image/png" sizes="32x32" href="./favicon/favicon-32x32.png" />
<link rel="icon" type="image/png" sizes="96x96" href="./favicon/favicon-96x96.png" />
<link rel="icon" type="image/png" sizes="16x16" href="./favicon/favicon-16x16.png" />
<link rel="manifest" href="./favicon/manifest.json" />
<meta name="msapplication-TileColor" content="#ffffff" />
<meta name="msapplication-TileImage" content="./favicon/ms-icon-144x144.png" />
<meta name="theme-color" content="#ffffff" />
<title>Tugas WEB Programing</title>
<script src="https://kit.fontawesome.com/eaa4609b2f.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="./css/style.css" />



<style>

.container {
    max-width: 960px;
    margin: 0 auto;
    padding: 20px;
}

.editor-h1 {
    font-size: 28px;
    margin-bottom: 20px;
}

.articles {
    display: flex;
    flex-wrap: wrap; /* Ini akan membuat artikel otomatis pindah ke baris baru */
    gap: 20px;
}

.article-card {
    background-color: #fff;
    border: 1px solid #e0e0e0;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    padding: 20px;
    transition: transform 0.2s ease-in-out;
    max-width: calc(50% - 10px);
    box-sizing: border-box;
}

.article-card:hover {
    transform: translateY(-5px);
}

.article-image {
    max-width: 100%;
    height: auto;
    margin-bottom: 10px;
}

.article-category {
    font-size: 14px;
    color: #777;
    margin-bottom: 10px;
}

.article-title {
    font-size: 20px;
    margin: 0;
}

.article-excerpt {
    font-size: 16px;
    line-height: 1.4;
    margin-bottom: 10px;
    word-wrap: break-word; /* Ini akan membuat teks pindah ke baris baru jika melebihi lebar card */
    overflow-wrap: break-word; /* Ini juga memastikan bahwa kata-kata dipecah ketika melebihi lebar */

    white-space: normal !important; /* Ini akan memaksa teks untuk selalu pindah ke baris baru */
}

.read-more {
    color: #007bff;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.2s ease-in-out;
}

.read-more:hover {
    color: #0056b3;
}


</style>
</head>
<body>
<div class="preloader">
<div></div>
<div>WEB artkel</div>
</div>
<nav>
<div class="container">
<div class="logo">
<i class="fas fa-globe fa-3x"></i>
<h1>Dimas<span>ARTIKEL</span></h1>
</div>

<div class="options">
<a href="./login" class="current">Login</a>
{{-- <a href="./html/about.html">About</a> --}}
</div>
</div>
</nav>
<header class="showcase">
<div class="container">
<div class="text-content">
<p class="sports-category">NEWS</p>
<h1> Dimas wildan Al furqaan</h1>
<p>
    Berikut adalah artikel yang saya buat saya untuk mengedit artikel memakai CKEDITOR dan juga menambah artikel memakai ck editor di bagian admin hanya kusus admin yang login masuk ke admin nya 
</p>
<a href="#">Baca Selengkapnya</a>
</div>
</div>
</header>
<section>
    <div class="container">
        <h1 class="editor-h1">Artikel Populer</h1>
        <div class="articles">
            @foreach ($datas as $data)
            <div class="article-card">
                <img src="/foto_upload/{{ $data->cover }}" alt="{{ $data->judul }}" class="article-image" />
                <div class="article-details">
                    <p class="article-category">News</p>
                    <h2 class="article-title">{{ $data->judul }}</h2>
                    <div class="article-excerpt">
                        <div>{!! $data->isi !!}</div> <!-- Konten dari CKEditor -->
                    </div>
                    {{-- <a href="{{ route('berita.show', $data->id) }}" class="read-more">Baca Selengkapnya</a> --}}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


<script src="./js/script.js"></script>
</body>
</html>

<script>const preloader = document.querySelector(".preloader");
  window.addEventListener('load', () => {
  preloader.remove();
  })</script>