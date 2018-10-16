$(document).ready(function () {
    setResultText();
});

function setResultText() {
    if (typeof $('#confirmation_result').html() !== 'undefined') {
        var result_value = $('#confirmation_result').val();
        switch (result_value) {
            case '0':
                $('#confirmation_result_0').removeClass('d-none');
                break;
            case '1':
                $('#confirmation_result_1').removeClass('d-none');
                break;
            case '2':
                $('#confirmation_result_2').removeClass('d-none');
                break;
            default:
                break;
        }
    }
}