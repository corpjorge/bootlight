document.getElementById("dark-mode").onclick = function () {
    var body = document.getElementsByClassName("dark");
    var element = document.getElementsByTagName("body");
    if (body.length > 0) {
        return element[0].classList.remove("dark");
    }
    return element[0].classList.add("dark");
};
//# sourceMappingURL=bootlight.js.map