<!-- layout.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <!-- Add your common stylesheets and scripts here -->
    <link rel="stylesheet" href="../assets/css/styles.css">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <?php include 'header.php'; ?>
    
    <div class="content">
        <?php include $content; ?>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Activate the Bootstrap toast component
        var toastElList = [].slice.call(document.querySelectorAll('.toast'))
        var toastList = toastElList.map(function (toastEl) {
            return new bootstrap.Toast(toastEl)
        });
        toastList.forEach(function (toast) {
            toast.show();
        });
    });
</script>