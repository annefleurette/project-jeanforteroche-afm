<footer>
    <?php
    if((isset($_SESSION['pseudo']) AND $_SESSION['type'] == "reader") OR (!isset($_SESSION['pseudo']))){
    ?>
    <p><a href="mailto:jeanforteroche2020@gmail.com">Contacter Jean Forteroche</a></p>
    <?php
    }
    ?>
    <p>Jean Forteroche. Copyright 2020.</p>
</footer>