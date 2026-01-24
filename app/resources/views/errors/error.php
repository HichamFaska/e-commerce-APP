<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Erreur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="text-center">
        <h1 class="display-4 text-danger">Erreur</h1>
        <p class="lead"><?= htmlspecialchars($message) ?></p>
        <a href="/" class="btn btn-dark mt-3">Retour à l’accueil</a>
    </div>
</body>
</html>
