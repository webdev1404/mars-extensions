const moduleUsers = {
    logout: function (url) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = url;

        document.body.appendChild(form);

        form.submit();
    }
}