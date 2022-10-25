<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2022.3.913/styles/kendo.default-ocean-blue.min.css" />
    <script src="https://kendo.cdn.telerik.com/2022.3.913/js/jquery.min.js"></script>
    <script src="https://kendo.cdn.telerik.com/2022.3.913/js/kendo.all.min.js"></script>
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
                    <form id="registerForm">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var validationSuccess = $("#validation-success");
            var base_url = 'http://localhost:8080/';

            $("#registerForm").kendoForm({
                formData: {
                    day_of_birth: new Date(),
                    gender: 'Nam'
                },
                items: [{
                    type: "group",
                    items: [{
                            field: "email",
                            label: "Email:",
                            validation: {
                                required: {
                                    message: 'Vui lòng nhập Email'
                                },
                                email: {
                                    message: 'Emai không đúng định dạng'
                                }
                            }
                        },
                        {
                            field: "name",
                            label: "Họ tên:",
                            validation: {
                                required: {
                                    message: 'Vui lòng nhập Họ tên'
                                },
                            }
                        },
                        {
                            field: "day_of_birth",
                            label: "Ngày sinh",
                            format: "{0:dd/MM/yyyy}",
                            validation: {
                                required: {
                                    message: 'Vui lòng nhập Ngày sinh'
                                },
                            }
                        },
                        {
                            field: "gender",
                            editor: "RadioGroup",
                            label: "Giới tính",
                            editorOptions: {
                                layout: "group",
                                items: ["Nam", "Nữ"],
                            },
                        },
                        {
                            field: "job",
                            label: "Nghề nghiệp",
                            validation: {
                                required: {
                                    message: 'vui lòng nhập Nghề nghiệp'
                                }
                            }
                        },
                    ]
                }],
                submit: function(e) {
                    e.preventDefault();
                    e.model.day_of_birth = $('#day_of_birth').val().split("/").reverse().join("/");
                    if (e.model.gender == 'Nam') {
                        e.model.gender = 1;
                    } else {
                        e.model.gender = 0;
                    }
                    $.ajax({
                        url: base_url + 'customer',
                        type: 'POST',
                        data: e.model,
                        success: function(res) {
                            res = JSON.parse(res);

                            if (!$.isEmptyObject(res)) {
                                if (confirm('Email đã đăng ký, gửi lại email xác minh')) {
                                    $.ajax({
                                        url: base_url + 'customer/resend-mail',
                                        type: 'POST',
                                        data: res.data_inserts,
                                        success: function(res) {
                                            alert('Gửi lại email xác minh thành công');
                                            location.reload();
                                        },
                                        error: function() {
                                            alert('Gửi lại email xác minh thất bại');
                                        }
                                    })
                                }
                            } else {
                                var form = $("#registerForm").data("kendoForm");
                                alert('Đăng ký thành công, vui lòng xác minh email');
                                location.reload();
                            }
                        },
                        error: function() {
                            alert('Đăng ký thất bại');
                        }
                    })
                },
            });

            var form = $("#registerForm").data("kendoForm");

            $("#clear").click(function() {
                form.clear();
            });
        });
    </script>

</body>

</html>