
processing: true,
serverSide: true,
"iDisplayLength": 10,
"aLengthMenu": [
    [
        5,10,25,50,100,200,-1
    ],
    ['5 resultados' , '10  resultados', '25  resultados', '50  resultados', '100  resultados', '200  resultados',
        "Listar Tudo"
    ]
],
"language": {
    "sProcessing": "Carregando dados...",
    "sLengthMenu": "Mostrar _MENU_ registros",
    "sZeroRecords": "Não foram encontrados resultados",
    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
    "sInfoEmpty": "Mostrando de 0 até 0 de 0 registros",
    "sInfoFiltered": "(filtrado de _MAX_ registros no total)",
    "sInfoPostFix": "",
    "sSearch": "Procurar:",
    "sUrl": "",
    "oPaginate": {
        "sFirst": "Primeiro",
        "sPrevious": "Anterior",
        "sNext": "Seguinte",
        "sLast": "Último"
    },
    "buttons": {
        "copy": "Copiar",
        "csv": "Exportar em CSV",
        "excel": "Exportar para Excel (.xlsx)",
        "pdf": "Salvar em PDF",
        "print": "Imprimir",
        "pageLength": "Exibir por página"
    }
},

dom: 'Bfrtip',
buttons: [
    {
    extend: 'pageLength', 
            exportOptions: {
                columns: "thead th:not(.noExport)"
        },
    },
    {
    extend: 'copy', 
            exportOptions: {
                columns: "thead th:not(.noExport)"
        },
    },
    {
    extend: 'csv', 
            exportOptions: {
                columns: "thead th:not(.noExport)"
        },
    },
    {
    extend: 'excel', 
            exportOptions: {
                columns: "thead th:not(.noExport)"
        },
    },
    {
    extend: 'pdf', 
            exportOptions: {
                columns: "thead th:not(.noExport)"
        },
    },
    {
    extend: 'print', 
            exportOptions: {
                columns: "thead th:not(.noExport)"
        }
    }
]
});





