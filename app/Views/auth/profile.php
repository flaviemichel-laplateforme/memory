 <?php if (has_flash_messages('error')): ?>
     <div class="alert alert-error">
         <?php foreach (get_flash_messages('error') as $message): ?>
             <p><?= esc($message) ?></p>
         <?php endforeach; ?>
     </div>
 <?php endif; ?>

 <?php if (has_flash_messages('success')): ?>
     <div class="alert alert-success">
         <?php foreach (get_flash_messages('success') as $message): ?>
             <p><?= esc($message) ?></p>
         <?php endforeach; ?>
     </div>
 <?php endif; ?>

 <form action="" method="POST">

     <div class="#">
         <label>Login :</label>
         <input type="text" name="login" value="<?= $user['login'] ?>" required>
     </div>

     <div class="#">
         <label>Email :</label>
         <input type="email" name="email" value="<?= $user['email'] ?>" required>
     </div>

     <div class="#">
         <label>Nom :</label>
         <input type="text" name="nom" value="<?= $user['nom'] ?>">
     </div>

     <div class="#">
         <label>Prénom :</label>
         <input type="text" name="prenom" value="<?= $user['prenom'] ?>">
     </div>

     <div class="#">
         <label>Nouveau mot de passe :</label>
         <input type="password" name="password" placeholder="Laisser vide pour ne pas modifier le mot de passe">
     </div>

     <button type="submit" class="#">Mettre à jour</button>

 </form>