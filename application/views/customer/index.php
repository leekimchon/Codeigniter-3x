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
                <div class="col-md-12">
                    <h2>Đăng ký thông tin để được nhận tài liệu</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 justify-content-center">
                    <form action="<?php echo base_url('customer'); ?>" method="POST">
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example3">Email</label>
                            <input type="text" name="email" value="<?php echo set_value('email'); ?>" id="form3Example3" class="form-control" />
                            <span class="text-danger"><?php echo form_error('email') ?></span>
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example4">Tên</label>
                            <input type="text" name="name" value="<?php echo set_value('name'); ?>" id="form3Example4" class="form-control" />
                            <span class="text-danger"><?php echo form_error('name') ?></span>
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example5">Ngày sinh</label>
                            <input type="date" name="day_of_birth" value="<?php echo set_value('day_of_birth'); ?>" id="form3Example5" class="form-control" />
                            <span class="text-danger"><?php echo form_error('day_of_birth') ?></span>
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
                            <label class="form-label" for="form3Example5">Nghề nghiệp</label>
                            <input type="text" name="job" value="<?php echo set_value('job'); ?>" id="form3Example5" class="form-control" />
                            <span class="text-danger"><?php echo form_error('job') ?></span>
                        </div>

                        <!-- Submit button -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary mb-4">Đăng ký</button>
                        </div>
                    </form>
                </div>
                <?php if (isset($errors['email_exist'])) { ?>
                    <div class="col-md-3">
                        <form action="<?php echo base_url('customer/resend-mail'); ?>" method="POST">
                            <input type="hidden" name="email" value="<?php echo $data['email'] ?>">
                            <button class="btn btn-primary">Gửi lại email xác minh</button>
                        </form>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>