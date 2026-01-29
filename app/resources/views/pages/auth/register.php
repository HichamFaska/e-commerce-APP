<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h2 class="text-center mb-4 fw-bold">Inscription</h2>
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger">
                            <i class="fa-solid fa-circle-exclamation me-1"></i>
                            <?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>
                    <form method="POST" action="/register">
                        <div class="mb-3">
                            <label class="form-label">Nom</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa-solid fa-user"></i>
                                </span>
                                <input type="text" name="username" class="form-control" value = "<?= isset($_POST['username']) ? $_POST['username'] : '' ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa-solid fa-envelope"></i>
                                </span>
                                <input type="email" name="email" class="form-control" value = "<?= isset($_POST['email']) ? $_POST['email'] : '' ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mot de passe</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa-solid fa-lock"></i>
                                </span>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirmer le mot de passe</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa-solid fa-lock"></i>
                                </span>
                                <input type="password" name="confirm_password" class="form-control" required>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark">
                                <i class="fa-solid fa-user-check me-1"></i>
                                S'inscrire
                            </button>
                        </div>

                    </form>
                    <hr>
                    <div class="text-center">
                        <small>
                            Déjà un compte ?
                            <a href="/login" class="text-decoration-none">Se connecter</a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
