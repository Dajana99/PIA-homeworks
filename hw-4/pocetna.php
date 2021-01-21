<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php include('index.php');?>

    <?php 
        $sql = "SELECT * FROM filmovi";
        $movies = $database->query($sql);
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">FilmoviPregled</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse " id="navbarSupportedContent">

            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="">Pocetna <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <a class="nav-link" href="index.php?logout=1"><?php echo $_SESSION['username']?> - Odjavi se</a>
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>

        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <?php while($movie = $movies->fetch_assoc()):?>
            <div class="col-md-3 m-3 card" style="width: 18rem;">
                <?php echo '<img class = "w-50 card-img-top w-100" src="data:image/jpeg;base64,'.base64_encode( $movie['poster'] ).'"/>';?>
                <div class="card-body d-flex justify-content-around flex-column">
                    <h5 class="card-title"><?php echo $movie['naslov'];?></h5>
                    <p class="card-text"><?php echo $movie['opis'];?></p>
                    <a href="detalji_filma.php?id=<?php echo $movie['id']?>" class="btn btn-primary mt-auto d-block">Detaljnije</a>
                </div>
            </div>
            <?php endwhile?>
        </div>


    </div>



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
</body>

</html>