<?php
    session_start();
    if (!isset($_SESSION['username'])) { 
        header("location:login.php"); 
    }

    if ($_SESSION['role'] != 'user') {
        header("location:logout.php");
    }

    include "koneksi.php"; 

?>



<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Forza Ferrari</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        
        <link rel="stylesheet" href="style.css">
        <link rel="icon" href="img/icon.png">
        <style>
            body {
                background-color: white;
                color: black;
            }
            .navbar-light {
                background-color: white !important;
                color: black;
            }

            /* Dark Theme Styles */
            body.dark-mode {
                background-color: #121212;
                color: white;
            }
            .navbar-dark {
                background-color: #121212 !important;
                color: white;
            }

            .navbar-dark a{
                color: white;
            }

            i.dark-mode{
                color: white;
            }
        </style>

    </head>
    <body >
        <nav class="navbar navbar-expand-lg  sticky-top navbar-light">
            <div class="container">
                <div class="col">
                    <img src="img/icon.png" width="64" alt="">
                    <a class="navbar-brand" href="#">Forza Ferrari</a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-dark align-items-center">
                        <li class="nav-item">
                            <a class="nav-link" href="#hero">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#article">Article</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#gallery">Gallery</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#schedule">Schedule</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about-me">About Me</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                        <li>
                            <button id="themeSwitcher" class="btn btn-outline-dark rounded-pill" type="button" title="theme">
                                <i class="bi bi-moon-fill"></i>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <section id="hero" class="text-center p-5 bg-danger text-sm-start">
            <div class="container">
                <div class="d-sm-flex flex-sm-row-reverse align-items-center">
                    <img src="img/banner.jpg" class="img-fluid" width="300"  alt="banner">
                    <div class="container">
                        <h1 class="fw-bold display-4"><q>Racing is a great mania to which one must sacrifice everything, without reticence, without hesitation.</q></h1>
                        <h4 class="lead display-6">- Enzo Ferrari -</h4>
                    </div>
                </div>
            </div>
        </section>
        <section id="article" class="text-center p-5">
  <div class="container">
    <h1 class="fw-bold display-4 pb-3">article</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
      <?php
      $sql = "SELECT * FROM article ORDER BY tanggal DESC";
      $hasil = $conn->query($sql); 

      while($row = $hasil->fetch_assoc()){
      ?>
        <div class="col">
          <div class="card h-100">
            <img src="img/<?= $row["gambar"]?>" class="card-img-top" alt="..." />
            <div class="card-body">
              <h5 class="card-title"><?= $row["judul"]?></h5>
              <p class="card-text">
                <?= $row["isi"]?>
              </p>
            </div>
            <div class="card-footer">
              <small class="text-body-secondary">
                <?= $row["tanggal"]?>
              </small>
            </div>
          </div>
        </div>
        <?php
      }
      ?> 
    </div>
  </div>
</section>
        <section id="gallery" class="text-center p-5 bg-danger">
            <div class="container">
                <h1 class="fw-bold display-4 pb-3">gallery</h1>
                <div id="carouselExample" class="carousel slide">
                    <div class="carousel-inner">
                        <?php
                            $sql = "SELECT * FROM gallery";
                            $hasil = $conn->query($sql);

                            while($row = $hasil->fetch_assoc()){
                        ?>
                            <div class="carousel-item active">
                                <img src="img/<?= $row["gambar"]?>"  class="d-block w-100" alt="...">
                            </div>
                        <?php
                            }
                        ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </section>
        <section id="schedule">
            <div class="container text-center">
                <h1 class="fw-bold display-4 pb-3">Schedule</h1>
                <div class="row row-cols-1 row-cols-md-4 g-4 justify-content-evenly">
                    <div class="col d-flex align-items-stretch">
                        <div class="card w-100">
                            <div class="card-header bg-danger text-white">
                                Senin
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    Etika Profesi <br>
                                    16.20-18.00 | H.4.4
                                </li>
                                <li class="list-group-item">
                                    Sistem Operasi <br>
                                    18.30-21.00 | H.4.8
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col d-flex align-items-stretch">
                        <div class="card w-100">
                            <div class="card-header bg-danger text-white">
                                Selasa
                            </div>
                            <ul class="list-group list-group-flush" >
                                <li class="list-group-item">
                                    Pendidikan Kewarganegaraan <br>
                                    12.30-13.10 | Kulino
                                </li>
                                <li class="list-group-item">
                                    Probabilitas dan Statistik <br>
                                    15.30-18.00 | H.4.9
                                </li>
                                <li class="list-group-item">
                                    Kecerdasan Buatan <br>
                                    18.30-21.00 | H.4.11
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col d-flex align-items-stretch">
                        <div class="card w-100">
                            <div class="card-header bg-danger text-white">
                                Rabu
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    Manajemen Proyek Teknologi Informasi <br>
                                    15.30-18.00 | H.4.6
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col d-flex align-items-stretch">
                        <div class="card w-100">
                            <div class="card-header bg-danger text-white">
                                Kamis
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    Bahasa Indonesia <br>
                                    12.30-14.10 | Kulino
                                </li>
                                <li class="list-group-item">
                                    Pendidikan Agama Islam <br>
                                    16.20-18.00 | Kulino
                                </li>
                                <li class="list-group-item">
                                    Penambangan Data<br>
                                    18.30-21.00 | H.4.9
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col d-flex align-items-stretch">
                        <div class="card w-100">
                            <div class="card-header bg-danger text-white">
                                Jumat
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    Pemrograman Web Lanjut <br>
                                    10.20-12.00 | D.2.K
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col d-flex align-items-stretch" >
                        <div class="card w-100">
                            <div class="card-header bg-danger text-white">
                                Sabtu
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    FREE <br>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        
        
        </section>
        <section id="about-me" class="text-center mt-5 p-5 bg-danger-subtle text-sm-start d-flex justify-content-center">
            <div class="container m-5 me-xs-auto ms-xs-auto">
                <div class="d-sm-flex align-items-center justify-content-center">
                    <button id="profile-img-button" type="button" class="rounded-circle bg-transparent border-0">
                        <img id="profile-img" class="img-fluid rounded-circle object-fit-fill" width="300" src="https://i1.sndcdn.com/artworks-46Iy8SxkMaxepPTL-u5icpA-t500x500.jpg" 
                        alt="profile-img">
                    </button>
                    <div id="profile-info" class="showed ms-sm-5">
                        <h4 class="fw-lighter">A11.2023.15114</h4>
                        <h1 class="display-6 fw-bold">Bryant Fawwaz Bernhard</h1>
                        <h5 class="fw-lighter">Program Studi Teknik Informatika</h5>
                        <h5 class="fw-bold">Universitas Dian Nuswantoro</h5>
                    </div>
                    

                    
                </div>
            </div>
        </section>
        <footer class="text-center p-5">
            <div>
                <i class="bi bi-instagram h2 p-2 "></i>
                <i class="bi bi-twitter-x h2 p-2 "></i>                
                <i class="bi bi-whatsapp h2 p-2 "></i>
            </div>
            <div>
                Bryant Fawwaz Bernhard &copy; 2023
            </div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", () => {
                const themeSwitcher = document.getElementById("themeSwitcher");
                const body = document.body;
                const navbar = document.querySelector(".navbar");

                // Check for saved user theme preference
                const savedTheme = localStorage.getItem("theme");
                if (savedTheme === "dark") {
                    body.classList.add("dark-mode");
                    navbar.classList.replace("navbar-light", "navbar-dark");
                    themeSwitcher.innerHTML = '<i class="bi bi-sun-fill"></i>';
                }

                // Toggle theme on button click
                themeSwitcher.addEventListener("click", () => {
                    body.classList.toggle("dark-mode");
                    navbar.classList.toggle("navbar-dark");
                    navbar.classList.toggle("navbar-light");

                    // Update button icon and save theme preference
                    if (body.classList.contains("dark-mode")) {
                        themeSwitcher.innerHTML = '<i class="bi bi-sun-fill"></i>';
                        localStorage.setItem("theme", "dark");
                    } else {
                        themeSwitcher.innerHTML = '<i class="bi bi-moon-fill"></i>';
                        localStorage.setItem("theme", "light");
                    }
                });
            });
            
            document.getElementById('profile-img-button').onclick = function () {
                if (document.getElementById("profile-info")) {
                    // document.getElementsByClassName("showed").classList.add("hidden")
                    // document.getElementsByClassName("showed").classList.remove("showed")
                    if (document.getElementById("profile-info").innerHTML != "") {
                        document.getElementById("profile-info").innerHTML = ""
                    } else {
                        document.getElementById("profile-info").innerHTML = ' <h4 class="fw-lighter">A11.2023.15114</h4> <h1 class="display-6 fw-bold">Bryant Fawwaz Bernhard</h1> <h5 class="fw-lighter">Program Studi Teknik Informatika</h5> <h5 class="fw-bold">Universitas Dian Nuswantoro</h5>'
                    }
                    
                } 

            }

        </script>
    </body>
</html>