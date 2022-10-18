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
        <div class="row">
            <div class="row mt-3 mb-2">
                <div class="col-md-12 text-center">
                    <h2>Đăng ký thông tin để được nhận tài liệu</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form action="" method="POST">
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example3">Email</label>
                            <input type="email" name="email" id="form3Example3" class="form-control" />
                            <!-- <span class="text-danger">sgsf</span> -->
                        </div>
    
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example4">Tên</label>
                            <input type="text" name="name" id="form3Example4" class="form-control" />
                        </div>
    
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example5">Tuổi</label>
                            <input type="number" name="age" id="form3Example5" class="form-control" />
                        </div>
    
                        <div class="form-outline mb-4">
                            <label class="form-check-label">Giới tính</label>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="radio1" name="gender" value="male" checked>
                                <label class="form-check-label" for="radio1">Nam</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="radio2" name="gender" value="female">
                                <label class="form-check-label" for="radio2">Nữ</label>
                            </div>
                        </div>
                        
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example5">Công việc</label>
                            <input type="text" name="job" id="form3Example5" class="form-control" />
                        </div>
    
                        <!-- Submit button -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary mb-4">Đăng ký</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>