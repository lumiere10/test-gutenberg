document.addEventListener('DOMContentLoaded', function () {
    const btnClearFilters = document.querySelector('.clear_filters');
    console.log(btnClearFilters);
    btnClearFilters.addEventListener('click', function () {
        var form = document.querySelector('#car-filter-form');
        form.reset();
    });
});