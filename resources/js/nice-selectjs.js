import "../../node_modules/nice-select2/dist/css/nice-select2.css";
import "../../node_modules/nice-select2/dist/js/nice-select2.js";
let tipoDePropertyOptions = {
    searchable: true,
    placeholder: "Tipo de imóvel",
    searchtext: "Pesquisar...",
    selectedtext: "selected",
};

if (document.getElementById("tipo-de-property-select")) {
    NiceSelect.bind(
        document.getElementById("tipo-de-property-select"),
        tipoDePropertyOptions
    );
}

let neighborhoodsOptions = {
    searchable: true,
    placeholder: "Neighborhoods",
    searchtext: "Pesquisar...",
    selectedtext: "selected",
};
if (document.getElementById("neighborhoods-select")) {
    NiceSelect.bind(document.getElementById("neighborhoods-select"), neighborhoodsOptions);
}
