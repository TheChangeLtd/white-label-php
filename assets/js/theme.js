const themeButtons = $(".header__theme-button");

function applyTheme(theme) {
    localStorage.setItem("theme", theme);
    $("html").attr("data-theme", theme);
}

const savedTheme = $("html").attr("data-theme") || "light";
applyTheme(savedTheme);

function updateActiveButton(theme) {
    themeButtons.each(function () {
        const isActive = $(this).hasClass(`header__theme-button--${theme}`);
        $(this).toggleClass("active", isActive);
    });
}

updateActiveButton(savedTheme);

themeButtons.on("click", function () {
    const theme = $(this).hasClass("header__theme-button--light") ? "light" : "dark";
    applyTheme(theme);
    updateActiveButton(theme);
});
