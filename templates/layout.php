<!-- layout.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximun-scale=1.0, user-scalable=1">
    <title> <?php echo $labels['sign-in_hub_tittle']; ?> </title>
    <!-- Add your common stylesheets and scripts here -->
    <link rel="stylesheet" href="../assets/css/styles.css">

    <!-- FONT Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <!-- AJAX -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/css/select2.min.css" rel="stylesheet" />

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">  

</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container text-center">
          <h1> <?php echo $labels['afg_slogan']; ?> </h1>
    </div>    
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