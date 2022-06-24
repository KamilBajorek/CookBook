$(document).ready(
    function ($) {
        $('add-ingredient-button').click(function (event) {
            console.log('das')
            $('ingredients').append(' <select name="ingredient" class="ingredient-select">\n' +
                '                </select>\n' +
                '                <input name="amount" type="number" placeholder="amount" class="amount-input">\n' +
                '                <select name="amount-type" class="amount-select">\n' +
                '                </select>')
        })
    })