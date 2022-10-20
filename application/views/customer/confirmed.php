<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center text-center mt-3">
            <?php if ($customer) { ?>
                <h2>đã gửi tài liệu, vui lòng kiểm tra email!</h2>
            <?php } else { ?>
                <h2>Lỗi, bạn chưa đăng ký!</h2>
            <?php } ?>

        </div>
    </div>
</body>

</html>