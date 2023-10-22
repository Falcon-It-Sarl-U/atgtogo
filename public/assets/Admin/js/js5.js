document.addEventListener("DOMContentLoaded", function() {
    var date = new Date(Date.now() - 5 * 24 * 60 * 60 * 1000);
    var defaultDate = date.getUTCFullYear() + "-" + (date.getUTCMonth() + 1) + "-" + date.getUTCDate();
    document.getElementById("datetimepicker-dashboard").flatpickr({
        inline: true,
        prevArrow: "<span class=\"fas fa-chevron-left\" title=\"Previous month\"></span>",
        nextArrow: "<span class=\"fas fa-chevron-right\" title=\"Next month\"></span>",
        defaultDate: defaultDate
    });
});