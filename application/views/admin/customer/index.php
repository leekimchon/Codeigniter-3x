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
                            title: "T??n",
                            filterable: false,
                        },
                        {
                            field: "gender",
                            title: "Gi???i t??nh",
                            values: [{
                                    text: 'Nam',
                                    value: 1
                                },
                                {
                                    text: 'N???',
                                    value: 0
                                },
                            ],
                            filterable: false,
                        },
                        {
                            field: "day_of_birth",
                            title: "Ng??y sinh",
                            format: "{0:dd/MM/yyyy}",
                            filterable: false,
                        },
                        {
                            field: "job",
                            title: "Ngh??? nghi???p",
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
                            title: "Mail ???? x??c minh",
                            filterable: {
                                multi: true,
                                search: true
                            },
                            values: [{
                                    text: '???? x??c minh',
                                    value: 1
                                },
                                {
                                    text: 'Ch??a x??c minh',
                                    value: 0
                                },
                            ],
                        },
                        {
                            field: "email_readed_at",
                            title: "Mail ???? ?????c",
                            filterable: {
                                multi: true,
                                search: true
                            },
                            template: "#if(email_readed_at){#  ???? ?????c # }else{#  Ch??a ?????c  #}#"
                        },
                        {
                            field: "downloaded",
                            title: "Download",
                            filterable: {
                                multi: true,
                                search: true
                            },
                            values: [{
                                    text: '???? download',
                                    value: 1
                                },
                                {
                                    text: 'Ch??a download',
                                    value: 0
                                },
                            ],
                        },
                        {
                            field: "downloaded_at",
                            title: "Ng??y download",
                            format: "{0:dd-MMM-yyyy hh:mm:ss tt}",
                            filterable: false,
                            template: function(item) {
                                if (item.downloaded_at) {
                                    return item.downloaded_at;
                                } else {
                                    return 'Ch??a download';
                                }
                            }
                        },
                        {
                            field: "option",
                            title: "G???i l???i mail",
                            filterable: false,
                            template: "<button class='btn-resendMailVerifi'>k??ch ho???t</button> <button class='btn-resendMailDownload'>Download</button>"
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
                            alert('G???i mail x??c minh th??nh c??ng');
                        },
                        error: function() {
                            alert('G???i mail x??c minh th???t b???i');
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
                            alert('G???i mail download th??nh c??ng');
                        },
                        error: function() {
                            alert('G???i mail download th???t b???i');
                        }
                    })
                });
            });
        </script>
    </div>


</body>

</html>