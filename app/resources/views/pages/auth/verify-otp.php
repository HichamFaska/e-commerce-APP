<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Otp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="text-center mb-4">
                        <i class="fa fa-shield-alt me-2"></i>Vérification OTP
                    </h4>

                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>

                    <form method="POST" action="/verify-otp/<?= $token ?>">
                        <div class="mb-3">
                            <label class="form-label">Code reçu par email</label>
                            <input
                                type="text"
                                name="otp"
                                class="form-control text-center fw-bold"
                                maxlength="6"
                                required
                            >
                        </div>

                        <button class="btn btn-success w-100">
                            Vérifier le code
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
</body>
</html>