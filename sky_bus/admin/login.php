document.addEventListener('DOMContentLoaded', function () {
    const routeSwapBtn = document.getElementById('swapCities');
    if (routeSwapBtn) {
        routeSwapBtn.addEventListener('click', function () {
            const source = document.getElementById('source_city');
            const destination = document.getElementById('destination_city');
            if (source && destination) {
                const tmp = source.value;
                source.value = destination.value;
                destination.value = tmp;
            }
        });
    }
});

function toggleSeat(seat) {
    const seatInput = document.getElementById('seat_' + seat);
    const button = document.querySelector('[data-seat="' + seat + '"]');
    if (!button) return;

    if (button.classList.contains('selected')) {
        button.classList.remove('selected');
        button.classList.add('available');
        if (seatInput) seatInput.remove();
    } else {
        button.classList.remove('available');
        button.classList.add('selected');
        if (!seatInput) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'selected_seats[]';
            input.id = 'seat_' + seat;
            input.value = seat;
            document.getElementById('selectedSeatsForm').appendChild(input);
        }
    }
}
