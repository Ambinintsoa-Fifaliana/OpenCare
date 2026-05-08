<?php
?>
<label>Date de naissance: </label><br>
<input type="text" name="date_naissance" ><br>
<label>Adresse: </label><br>
<input type="text" name="adresse" ><br>
<label>Cas: </label><br>
<select name="cas">
    <option value="maladie">Maladie</option>
    <option value="accident">Accident/Bléssure</option>
</select><br>
<label>Type de consultation: </label><br>
<select name="type_consultation">
    <option value="i">Initiale</option>
    <option value="s">Suivi</option>
    <option value="po">Pré-opératoire</option>
</select><br>
<label>Tension arterielle: </label><br>
<input type="text" name="tension" ><br>
<label>Fréquence cardiaque: </label><br>
<input type="text" name="frequence_cardiaque" ><br>
<label>Poids: </label><br>
<input type="number" name="poid" ><br>
<label>Taille: </label><br>
<input type="number" name="taille" required><br>
<label>Temperature: </label><br>
<input type="number" name="temperature" required><br>
<label>Historique: </label><br>
<textarea  name="historique" placeholder="Récit des symptomes, durée, sévérité..."></textarea><br>
<label>Niveau d'urgence: </label><br>
<select name="urgence">
    <option value="1">Niveau 1</option>
    <option value="2">Niveau 2</option>
    <option value="3">Niveau 3</option>
</select><br>
<label>Examens complémentaires demandés: </label><br>
<input type="text" name="examens_plus" placeholder="Biologie, imagerie, ..."><br>
<label>Traitement préscrit: </label><br>
<textarea name="traitement" placeholder="Médicaments : posologie" required></textarea><br>
<label>Chambre: </label><br>
<input type="number" name="chambre" required><br>
<label>Service: </label><br>
<input type="text" name="service" required><br>
<label>Numéro de lit: </label><br>
<input type="number" name="lit" required><br>
<label>Dispositifs: </label><br>
<select name="dispositif">
    <option value="perf">Perf</option>
    <option value="sonde">Sonde</option>
    <option value="drain">Drain</option>
    <option value="oxygene">Oxygene</option>
</select><br><br>