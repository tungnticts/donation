<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">

    <title>Hello, world!</title>
    <style>
        .left {
            margin-left: 10px;
        }

        .text_right {
            text-align: right;
        }

        .text_size_10 {
            font-size: 12px;
        }

        .margin_bottom_10 {
            margin-bottom: 5px;
        }

        .italic {
            font-style: italic;
        }

        .margin_bottom_15 {
            margin-bottom: 15px;
        }
        .margin_bottom_30 {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light margin_bottom_15">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="http://getbootstrap.com/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top"
                    alt=""> Bootstrap
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Trang chủ
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown link
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                </ul>
            </div>
            <form class="form-inline">
                <button class="btn btn-sm btn-outline-success" type="button">Main button</button>
                <button class="btn btn-sm btn-outline-secondary left" type="button">Smaller button</button>
            </form>
        </div>
    </nav>
    <div class="container">
        @yield('content')
        <div class="row">
            <div class="col-md-4 margin_bottom_30">
                <div class="card">
                    <img class="card-img-top" src="images/default.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <div class="row margin_bottom_10">
                            <span class="col-md-6">4.000.000 VND</span>
                            <span class="col-md-6 text_right">25%</span>
                        </div>
                        <div class="progress margin_bottom_10">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="row margin_bottom_10 italic">
                            <span class="col-md-6 text_size_10">Còn 10 ngày</span>
                            <span class="col-md-6 text_size_10 text_right">10 người ủng hộ</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 margin_bottom_30">
                <div class="card">
                    <img class="card-img-top" src="images/default.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <div class="row margin_bottom_10">
                            <span class="col-md-6">4.000.000 VND</span>
                            <span class="col-md-6 text_right">25%</span>
                        </div>
                        <div class="progress margin_bottom_10">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="row margin_bottom_10 italic">
                            <span class="col-md-6 text_size_10">Còn 10 ngày</span>
                            <span class="col-md-6 text_size_10 text_right">10 người ủng hộ</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 margin_bottom_30">
                <div class="card">
                    <img class="card-img-top" src="images/default.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <div class="row margin_bottom_10">
                            <span class="col-md-6">4.000.000 VND</span>
                            <span class="col-md-6 text_right">25%</span>
                        </div>
                        <div class="progress margin_bottom_10">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="row margin_bottom_10 italic">
                            <span class="col-md-6 text_size_10">Còn 10 ngày</span>
                            <span class="col-md-6 text_size_10 text_right">10 người ủng hộ</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 margin_bottom_30">
                <div class="card">
                    <img class="card-img-top" src="images/default.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <div class="row margin_bottom_10">
                            <span class="col-md-6">4.000.000 VND</span>
                            <span class="col-md-6 text_right">25%</span>
                        </div>
                        <div class="progress margin_bottom_10">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="row margin_bottom_10 italic">
                            <span class="col-md-6 text_size_10">Còn 10 ngày</span>
                            <span class="col-md-6 text_size_10 text_right">10 người ủng hộ</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

</html>