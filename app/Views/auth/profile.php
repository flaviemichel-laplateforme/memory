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

 <div class="profile-container">
     <h1>📝 Mon Profil</h1>
     <form action="" method="POST">

         <div class="form-group">
             <label>Login :</label>
             <input type="text" name="login" value="<?= $user['login'] ?>" required>
         </div>

         <div class="form-group">
             <label>Email :</label>
             <input type="email" name="email" value="<?= $user['email'] ?>" required>
         </div>

         <div class="form-group">
             <label>Nom :</label>
             <input type="text" name="nom" value="<?= $user['nom'] ?>">
         </div>

         <div class="form-group">
             <label>Prénom :</label>
             <input type="text" name="prenom" value="<?= $user['prenom'] ?>">
         </div>

         <div class="form-group">
             <label>Nouveau mot de passe :</label>
             <input type="password" name="password" placeholder="Laisser vide pour ne pas modifier le mot de passe">
         </div>

         <button type="submit" class="btn-primary">Mettre à jour</button>

     </form>
 </div>