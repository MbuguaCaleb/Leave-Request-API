<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <style>
        body {
            font: 15px/1.5 Arial, Helvetica, sans-serif;
            padding: 0;
            margin: 0;
            background-color: #f4f4f4;
        }

        /* Global */
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        ul {
            margin: 0;
            padding: 0;
        }

        .button_1 {
            height: 38px;
            background: #ff9900;
            border: 0;
            padding-left: 20px;
            padding-right: 20px;
            color: #ffffff;
        }

        .dark {
            padding: 15px;
            background: #35424a;
            color: #ffffff;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        /* Header */
        header {
            background: #35424a;
            color: #ffffff;
            padding-top: 30px;
            min-height: 70px;
            border-bottom: #ff9900 3px solid;
        }

        header a {
            color: #ffffff;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 10px;
        }


        header #branding {
            float: left;
        }

        header #branding h1 {
            margin: 0;
        }

        header nav {
            float: right;
            margin-top: 10px;
        }

        header .highlight,
        header .current a {
            color: #ff9900;
            font-weight: bold;
        }

        header .highlighttwo {

            color: #ffffff;
        }

        header a:hover {
            color: #cccccc;
            font-weight: bold;
        }

        /* Showcase */
        #showcase {
            min-height: 400px;
            background: url('http://www.mvminfotech.com/blog/wp-content/uploads/1920x1200-3.jpg.png') no-repeat;
            text-align: left;
            color: #ffffff;
        }

        #showcase h1 {
            margin-top: 100px;
            font-size: 15px;
            margin-bottom: 10px;
            color: #ffffff;
        }

        #showcase p {
            font-size: 15px;

        }

        #showcase a {
            color: #ff9900;

        }


        /* newsletter */
        #newsletter {
            padding: 15px;
            color: #ffffff;
            background: #35424a;
        }

        #newsletter h1 {
            float: left;
        }

        #newsletter form {
            float: right;
            margin-top: 15px;
        }

        #newsletter input[type="email"] {
            padding: 4px;
            height: 25px;
            width: 250px;
        }

        /* boxes*/
        #boxes {
            margin-top: 20px;
        }

        #boxes .box {
            float: left;
            text-align: center;
            width: 30%;
            padding: 10px;
        }

        #boxes .box img {
            width: 90px;
        }

        /* Sidebar */
        aside#sidebar {
            float: right;
            width: 30%;
            margin-top: 10px;
        }

        aside#sidebar .quote input,
        aside#sidebar .quote textarea {
            width: 90%;
            padding: 5px;
        }

        /*Main-col*/
        article#main-col {
            float: left;
            width: 65%;
        }

        p {
            color: #ffffff;
        }

        /* Services */
        ul#services li {
            list-style: none;
            padding: 20px;
            border: #cccccc solid 1px;
            margin-bottom: 5px;
            background: #e6e6e6;
        }

        /* footer */
        footer {
            padding: 20px;
            margin-top: 0px;
            color: #ffffff;
            background-color: #ff9900;
            text-align: center;
        }

        p.initial-margin {
            margin-top: 1.5rem;

        }


        blockquote {
            color: #ffffff;
            margin: 1rem;
        }

        /* Media Queries */
        @media(max-width: 768px) {

            header #branding,
            header nav,
            header nav li,
            #newlsetter h1,
            #newsletter form,
            #boxes .box,
            article#main-col,
            aside#sidebar {
                float: none;
                text-align: center;
                width: 100%
            }

            header {
                padding-bottom: 20px;
            }

            #showcase h1 {
                margin-top: 40px;
            }

            #newletter button,
            .quote button {
                display: block;
                width: 100%;
            }

            footer p {
                width: 80%;
                margin: auto;
                color: #35424a;
            }

            #newsletter form input[type="email"],
            .quote input,
            .quote textarea {
                width: 100%;
                margin-bottom: 20px
            }
        }
    </style>

</head>


<body>
    <header>
        <div class="container">
            <div id="branding">
                <h1><span class="highlight">Yum Deliveries </span><span class="highlighttwo ">Ltd</span> </h1>
            </div>

        </div>
    </header>

    <section id="showcase">
        <div class="container">

            <p class="initial-margin">
                Dear :{{$user->username}}

            </p>


            <p class="initial-margin">Congratulations!You have successfully completed your registration process.


            </p>


            <p class="initial-margin"> Kindly log in with Your set Password.


                <a href="https://yum.co.ke/">Yum Deliveries Limited</a>

                <br><br>
                <p class="initial-margin">We mind about how fast your food gets to You. </p>

        </div>


    </section>

    <footer>
        <p>Yum Deliveries &#169; 2020</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>


</html>