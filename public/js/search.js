const search = document.querySelector('input[placeholder="search"]');
const recipesSection = document.querySelector(".recipes");

search.addEventListener("keyup", function (event) {
    if (event.key === "Enter") {
        event.preventDefault();

        const data = {search: this.value};

        fetch("/search", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function (response) {
            return response.json();
        }).then(function (recipes) {
            recipesSection.innerHTML = "";
            loadRecipes(recipes)
        });
    }
});

function loadRecipes(recipes) {
    recipes.forEach(recipe => {
        loadRecipe(JSON.parse(recipe));
    });
}

function loadRecipe(recipe) {

    const template = document.querySelector("#recipe-template");

    const clone = template.content.cloneNode(true);
    const div = clone.querySelector("div");
    div.id = recipe.id;
    const link = div.querySelector("a")
    link.href = '/recipe/' + recipe.id;

    const image = clone.querySelector("img");
    image.src = `/public/uploads/${recipe.image}`;
    const title = clone.querySelector("h2");
    title.innerHTML = recipe.title;
    const description = clone.querySelector("p");
    description.innerHTML = recipe.description;

    const authorDiv = div.querySelector(".user-container");
    const author = authorDiv.querySelector("a");
    author.innerHTML = recipe.author;

    recipesSection.appendChild(clone);
}
