const ingredientButton = document.getElementById('add-ingredient-button');
const ingredients = document.getElementById('ingredients');

var stringToHTML = function (str) {
    var parser = new DOMParser();
    var doc = parser.parseFromString(str, 'text/html');
    return doc.body;
};
var counter = 2;

function addIngredient() {
    ingredients.append(stringToHTML(' <select name="ingredient-' + counter + '" class="ingredient-select" id="ingredients-select-' + counter + '">\n' +
        '</select>\n' +
        '<input name="amount-' + counter + '" type="number" placeholder="amount" class="amount-input" id="amount-' + counter + '">\n' +
        '<select name="amount-type-' + counter + '" class="amount-select" id="amount-type-' + counter + '">\n' +
        '</select>'))

    $('#ingredient-select-1 option').clone().appendTo('#ingredients-select-' + counter);
    $('#amount-type-1 option').clone().appendTo('#amount-type-' + counter);


    counterInput = document.getElementById("counter");
    if (counterInput === null) {
        $('#recipe-form').append('<input type="hidden" name="counter" id="counter" value="' + counter + '" />');
    } else {
        counterInput.setAttribute("value", counter)
    }

    counter++;
}

ingredientButton.addEventListener("click", addIngredient);
