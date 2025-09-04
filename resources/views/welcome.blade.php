<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Bienvenue sur notre Plateforme de gestion des patients</h1>

    <div class="mt-4">
        <a href="{{ route('patients.index') }}" class="btn btn-primary">Gestion des Patients</a>
        <a href="{{ route('medecins.index') }}" class="btn btn-success">Gestion des Médecins</a>
    </div>
</body>
</html>
