<h1>Dossier de {{ $patient->nom }} {{ $patient->prenom }}</h1>
<p><strong>Nom :</strong> {{ $patient->nom }}</p>
<p><strong>Prénom :</strong> {{ $patient->prenom }}</p>
<p><strong>Date de naissance :</strong> {{ $patient->date_naissance ?? 'Non spécifiée' }}</p>
<p><strong>Genre :</strong> {{ ucfirst($patient->genre) ?? 'Non spécifié' }}</p>
<p><strong>Adresse :</strong> {{ $patient->adresse ?? 'Non spécifiée' }}</p>
<p><strong>Téléphone :</strong> {{ $patient->telephone ?? 'Non spécifié' }}</p>
<p><strong>Courriel :</strong> {{ $patient->courriel ?? 'Non spécifié' }}</p>
<p><strong>Groupe sanguin :</strong> {{ $patient->groupe_sanguin ?? 'Non spécifié' }}</p>
<p><strong>Antécédents médicaux :</strong> {{ $patient->antecedents_medicaux ?? 'Aucun' }}</p>