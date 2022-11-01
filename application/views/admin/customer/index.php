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
                var base_url = 'http://localhost:8080/';
                $("#grid").kendoGrid({
                    dataSource: {
                        transport: {
                            read: {
                                url: base_url + 'api/customers',
                                dataType: "json",
                            },
                        },
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
                                        type: "date"
                                    },
                                    gender: {
                                        type: "string"
                                    },
                                    day_of_birth: {
                                        type: "date"
                                    },
                                    downloaded_at: {
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
                    columns: [{
                            field: "name",
                            title: "Tên",
                            filterable: false,
                        },
                        {
                            field: "gender",
                            title: "Giới tính",
                            values: [{
                                    text: 'Nam',
                                    value: 1
                                },
                                {
                                    text: 'Nữ',
                                    value: 0
                                },
                            ],
                            filterable: false,
                        },
                        {
                            field: "day_of_birth",
                            title: "Ngày sinh",
                            format: "{0:dd/MM/yyyy}",
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
                            filterable: {
                                multi: true,
                                search: true
                            },
                            values: [{
                                    text: 'Đã xác minh',
                                    value: 1
                                },
                                {
                                    text: 'Chưa xác minh',
                                    value: 0
                                },
                            ],
                        },
                        {
                            field: "email_readed_at",
                            title: "Mail đã đọc",
                            filterable: {
                                multi: true,
                                search: true
                            },
                            template: "#if(email_readed_at){#  Đã đọc # }else{#  Chưa đọc  #}#"
                        },
                        {
                            field: "downloaded",
                            title: "Download",
                            filterable: {
                                multi: true,
                                search: true
                            },
                            values: [{
                                    text: 'Đã download',
                                    value: 1
                                },
                                {
                                    text: 'Chưa download',
                                    value: 0
                                },
                            ],
                        },
                        {
                            field: "downloaded_at",
                            title: "Ngày download",
                            format: "{0:dd-MMM-yyyy hh:mm:ss tt}",
                            filterable: false,
                            template: function(item) {
                                if (item.downloaded_at) {
                                    return item.downloaded_at;
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
                        url: base_url + 'customer/resend-mail',
                        type: 'POST',
                        data: {
                            email: dataItem.email,
                        },
                        success: function(data) {
                            alert('Gửi mail xác minh thành công');
                        },
                        error: function() {
                            alert('Gửi mail xác minh thất bại');
                        }
                    })
                });

                $(document).on('click', '.btn-resendMailDownload', function(e) {
                    e.preventDefault();
                    var grid = $("#grid").data("kendoGrid");
                    var dataItem = grid.dataItem($(this).closest('tr'));

                    $.ajax({
                        url: base_url + 'customer/confirm',
                        type: 'POST',
                        data: {
                            code: dataItem.code,
                        },
                        success: function() {
                            alert('Gửi mail download thành công');
                        },
                        error: function() {
                            alert('Gửi mail download thất bại');
                        }
                    })
                });
            });
        </script>
    </div>


</body>

</html>