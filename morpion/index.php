<?php  include '../config.php'; ?>
<?php  include '../header.php'; ?>

    <head>
        <style href="morpion/morpionstyle.css"></style>
    </head>
    <div class="general-content">
        <h1>Le morpion</h1>
        <h2>Explications sur l'exercice</h2>
        <p>Faire un jeu de morpion, l'adversaire et l'ordinateur, il n'y a pas deux joueurs.
        </p>
        <h2>Faire une partie</h2>

        <div class="board" id="board">
            <div class="cell" data-index="0"></div>
            <div class="cell" data-index="1"></div>
            <div class="cell" data-index="2"></div>
            <div class="cell" data-index="3"></div>
            <div class="cell" data-index="4"></div>
            <div class="cell" data-index="5"></div>
            <div class="cell" data-index="6"></div>
            <div class="cell" data-index="7"></div>
            <div class="cell" data-index="8"></div>
        </div>
        <button id="resetButton">Reset</button>
        <script src="morpionscript.js"></script>
        <!-- Début php -->


    <!-- Fin php -->
    <script>
        $(document).ready(function() {
            $('.menu-link').menuFullpage();
        } );
    </script>
<?php  include '../footer.php'; ?>