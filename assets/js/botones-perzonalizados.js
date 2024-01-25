const dom = "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
"<'row'<'col-sm-12'tr>>" +
"<'row'<'col-sm-5'i><'col-sm-7'p>>";
            const buttons = [{
                //Botón para Excel
                extend: 'excelHtml5',
                footer: true, 
                messageTop: 'ROBLES TREJO MARISOL CECILIA 🏹',
                title: 'CASA DE LOS PÁSTICOS',
                filename: 'NUEVO REPORTE...',
                //Aquí es donde generas el botón personalizado
                text: '<span class="badge bg-success"><i class="fas fa-file-excel"></i></span>'
            },
            //Botón para PDF
            {
                extend: 'pdfHtml5',
                download: 'open',
                footer: true,
                messageTop: 'ROBLES TREJO MARISOL CECILIA 🏹',
                title: 'CASA DE LOS PLÁSTICOS',
                filename: 'NUEVO REPORTE...',
                text: '<span class="badge bg-danger"><i class="fas fa-file-pdf"></i></span>',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            //Botón para copiar
            {
                extend: 'copyHtml5',
                footer: true,
                messageTop: 'ROBLES TREJO MARISOL CECILIA 🏹',
                title: 'CASA DE LOS PLÁSTICOS',
                filename: 'NUEVO REPORTE...',
                text: '<span class="badge bg-primary"><i class="fas fa-copy"></i></span>',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            //Botón para print
            {
                extend: 'print',
                footer: true,
                messageTop: 'ROBLES TREJO MARISOL CECILIA 🏹',
                title: 'CASA DE LOS PLÁSTICOS',
                filename: 'NUEVO REPORTE...',
                text: '<span class="badge bg-dark"><i class="fas fa-print"></i></span>'
            },
            //Botón para cvs
            {
                extend: 'csvHtml5',
                footer: true,
                title: 'CASA DE LOS PLÁSTICOS',
                filename: 'NUEVO REPORTE...',
                text: '<span class="badge bg-success"><i class="fas fa-file-csv"></i></span>'
            }
            // ,
            // {
            //     extend: 'colvis',
            //     text: '<span class="badge bg-info"><i class="fas fa-columns"></i></span>',
            //     postfixButtons: ['colvisRestore']
            // }
        ]