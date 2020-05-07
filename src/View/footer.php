<footer>
    <?php
    if(isset($_SESSION['pseudo']) AND $_SESSION['type'] == "reader"){
    ?>
    <p><a href="mailto:jeanforteroche2020@gmail.com">Contacter Jean Forteroche</a></p>
    <p><button class="btn btn__alert" type="button" data-toggle="modal" data-target="#Modal">Supprimer mon compte</button></p>
    <!-- Modal -->
    <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmation de suppression</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr(e) de vouloir supprimer votre compte ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn__no" data-dismiss="modal">Annuler</button>
                    <a href="index.php?action=unsubscribe&pseudo=<?php echo $sessionpseudo; ?>" class="btn btn__ok">Confirmer</a>
                </div>
            </div>
        </div>
    </div>
    <?php
    }else if(!isset($_SESSION['pseudo'])){
    ?>
    <p><a href="mailto:jeanforteroche2020@gmail.com"><i class="fas fa-feather-alt"></i>Contacter Jean Forteroche</a></p>
    <?php
    }
    ?>
    <p>Jean Forteroche. Copyright 2020.</p>
</footer>