<div >

  <form method="post" action="index.php?action=commenter">

    <div >Auteur: <input type="text" name="auteur" value="<?= $_SESSION['username']; ?>" readonly></div>
    <textarea placeholder="Votre commentaire." name="contenu" rows="4" style="overflow: hidden; word-wrap: break-word; resize: none; height: 160px; "></textarea>  
    <br>
    <input type="hidden" name="id" value="<?= $billet['id'] ?>" />
    <input type="submit" value="Commenter">
    
  </form>

</div>
