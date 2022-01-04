function DelPin(event) {
    event.preventDefault();
    let text = "do you want to delete this pin"
    if (confirm(text) === true) {
        let form = document.getElementById("form-delete")
        form.submit()
    } else {
        event.preventDefault();
    }


}







document.addEventListener("DOMContentLoaded", function() {

    let button = document.getElementById("delete")
    button.addEventListener("click", DelPin)
});