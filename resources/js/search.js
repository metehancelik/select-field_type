(function (window, document) {

    let fields = Array.from(
        document.querySelectorAll('select[data-provides="anomaly.field_type.select"][data-search]')
    );

    fields.forEach(function (field) {
        new Choices(field);
    });
})(window, document);
