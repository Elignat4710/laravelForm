$(document).ready(function () {
    $('#firstName, #lastName').on('keypress', function (e) {
        var char = /["a-zA-Z ]/;
        var val = String.fromCharCode(e.which);
        var test = char.test(val);

        if(!test) return false
    })

})
