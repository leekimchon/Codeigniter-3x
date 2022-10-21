<!DOCTYPE html>
<html>

<head>
    <base href="https://demos.telerik.com/kendo-ui/grid/local-data-binding">
    <style>
        html {
            font-size: 14px;
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
    <title></title>
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2022.3.913/styles/kendo.default-ocean-blue.min.css" />

    <script src="https://kendo.cdn.telerik.com/2022.3.913/js/jquery.min.js"></script>


    <script src="https://kendo.cdn.telerik.com/2022.3.913/js/kendo.all.min.js"></script>



</head>

<body>
    <div id="example">
        <div id="grid"></div>

        <script>
            $(document).ready(function() {
                var customers = <?php echo $customers ?>;

                $("#grid").kendoGrid({
                    dataSource: {
                        data: customers,
                        schema: {
                            model: {
                                fields: {
                                    name: {
                                        type: "string"
                                    },
                                    email: {
                                        type: "string"
                                    },
                                    mail_active: {
                                        type: "string"
                                    },
                                    email_readed_at: {
                                        type: "string"
                                    },
                                    gender: {
                                        type: "string"
                                    },
                                    day_of_birth: {
                                        type: "string"
                                    },
                                    job: {
                                        type: "string"
                                    },
                                }
                            }
                        },
                        pageSize: 20
                    },
                    height: 550,
                    scrollable: true,
                    sortable: true,
                    filterable: true,
                    pageable: {
                        input: true,
                        numeric: false
                    },
                    columns: [
                        {
                            field: "name",
                            title: "Tên",
                            filterable: false,
                        },
                        {
                            field: "gender",
                            title: "Giới tính",
                            values: [
                                {text: 'Nam', value: 1},
                                {text: 'Nữ', value: 0},
                            ],
                            filterable: false,
                        },
                        {
                            field: "day_of_birth",
                            title: "Ngày sinh",
                            filterable: false,
                        },
                        {
                            field: "job",
                            title: "Nghề nghiệp",
                            filterable: false,
                        },
                        {
                            field: "email",
                            width: 200,
                            title: "Mail",
                            filterable: false,
                        },
                        {
                            field: "mail_active",
                            width: 160,
                            title: "Mail đã xác minh",
                            filterable: { multi: true, search: true},
                            values: [
                                {text: 'Đã xác minh', value: 1},
                                {text: 'Chưa xác minh', value: 0},
                            ],
                        },
                        {
                            field: "email_readed_at",
                            title: "Mail đã đọc",
                            filterable: { multi: true, search: true},
                            template: "#if(email_readed_at){#  Đã đọc # }else{#  Chưa đọc  #}#"
                        },
                        {
                            field: "dowloaded_at",
                            title: "Download",
                            filterable: { multi: true, search: true},
                            template: "#if(dowloaded_at){#  Đã download # }else{#  Chưa download  #}#"
                        },
                        {
                            field: "dowloaded_at",
                            title: "Ngày download",
                            filterable: false,
                            template: function(item) {
                                if (item.dowloaded_at) {
                                    return item.dowloaded_at;
                                } else {
                                    return 'Chưa download';
                                }
                            }
                        },
                        {
                            field: "option",
                            title: "Gửi lại mail",
                            filterable: false,
                            template: "<button class='btn-resendMailVerifi'>kích hoạt</button> <button class='btn-resendMailDownload'>Download</button>"
                        },
                    ],
                });

                $(document).on('click', '.btn-resendMailVerifi', function(e) {
                    e.preventDefault();
                    var grid = $("#grid").data("kendoGrid");
                    var dataItem = grid.dataItem($(this).closest('tr'));

                    $.ajax({
                        url: 'http://localhost:8080/customer/resend-mail',
                        type: 'POST',
                        data: {
                            email: dataItem.email,
                        },
                        success: function (data)
                        {
                            alert('Gửi mail xác minh thành công');
                        },
                        error: function (){
                            alert('Gửi mail xác minh thất bại');
                        }
                    })
                });

                $(document).on('click', '.btn-resendMailDownload', function(e) {
                    e.preventDefault();
                    var grid = $("#grid").data("kendoGrid");
                    var dataItem = grid.dataItem($(this).closest('tr'));

                    $.ajax({
                        url: 'http://localhost:8080/customer/confirm/'+dataItem.code,
                        type: 'get',
                        success: function ()
                        {
                            alert('Gửi mail download thành công');
                        },
                        error: function (){
                            alert('Gửi mail download thất bại');
                        }
                    })
                });
            });
        </script>
    </div>


</body>

</html>