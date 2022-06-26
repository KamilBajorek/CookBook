const saveButtons = document.querySelectorAll(".save");
const unsaveButtons = document.querySelectorAll(".unsave");
const deleteButtons = document.querySelectorAll(".delete");

function save() {
    const element = this;
    const container = element.parentElement.parentElement;
    const id = container.getAttribute("id");

    fetch(`/save/${id}`)
        .then(function () {
            element.display = "none";
        })
}

function unsave() {
    const element = this;
    const container = element.parentElement.parentElement;
    const id = container.getAttribute("id");

    fetch(`/unSave/${id}`)
        .then(function () {
            element.display = "none";
        })
}

function deleteRecipe() {
    const element = this;
    const container = element.parentElement.parentElement;
    const id = container.getAttribute("id");

    fetch(`/delete/${id}`)
        .then(function () {
            element.display = "none";
        })
}

saveButtons.forEach(button => button.addEventListener("click", save));
unsaveButtons.forEach(button => button.addEventListener("click", unsave));
deleteButtons.forEach(button => button.addEventListener("click", deleteRecipe));