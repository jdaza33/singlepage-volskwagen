function insertCar(dato) {

    $('#car').val(dato);

}

function send() {

    let name = $('#name').val();
    let phone = $('#phone').val();
    let car = $('#car').val();
    let email = $('#email').val();

    validar(name, phone, car, email) ?

        axios.post('php/enviar-correo.php', {
            name: name,
            phone: phone,
            car: car,
            email: email
        })
        .then((res) => {
            alert('Formulario enviado.');
            $('#name').val('');
            $('#phone').val('');
            $('#car').val('');
            $('#email').val('');
        })
        .catch((err) => {
            console.log(err);
        }) :
        alert('Por favor complete todos los campos');
}

function removeAdds() {
    $("a[target = '_blank']").remove();
}

function validar(name, phone, car, email) {
    return name == '' || phone == '' || car == '' || email == '' ? false : true;
}