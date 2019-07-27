<?php 

    class HeaderView {

        function __construct() {
        }

        function display(){
            return '
                <!doctype html>
                <html>
                
                    <head>
                        <!-- Required meta tags -->
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                        
                        <link rel="stylesheet" href="src/styles/style.css">
                
                        <title>Scrum.it</title>
                
                    </head>
                
                <body>
                    <nav class="navbar bg-light">
                        <span class="navbar-brand">
                            <a href="/scrumit/">
                                <img src="src/img/316794-200.png" width="30" height="30" class="d-inline-block align-top" alt="">
                                Scrum.it
                            </a>
                        </span>
                    </nav>';
        }
    }

?>