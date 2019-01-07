$(document).ready(function () {
    var myTree = [
        {
            text: "Генеральный директор",
            nodes: [
                {
                    text: "Начальник ИТ-отдела",
                    nodes: [
                        {
                            text: "Главный системный аналитик",
                            nodes: [
                                {
                                    text: "Системный администратор"

                                },
                            ],
                        },
                        {
                            text: "Администратор БД"

                        },
                        {
                            text: "Програмист",
                            nodes: [
                                {
                                    text: "Комьюнити-менеджер"

                                },
                            ],

                        },
                        {
                            text: "Web-дизайнер"

                        },
                    ],
                },
            ]
        },
    ];
    $('#my_tree').treeview({
        data: myTree
    });
});