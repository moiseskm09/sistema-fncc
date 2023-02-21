document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    locale: 'pt-br',
                    plugins: ['interaction', 'dayGrid'],
                    selectable: true,
                    editable: true,
                    eventLimit: true,
                    events: '../ferramentas/listar_eventos.php',
                    extraParams: function () {
                        return {
                            cachebuster: new Date().valueOf()
                        };
                    }
                });

                calendar.render();
            });