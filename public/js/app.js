function updateTime() {
    var now = new Date().toLocaleString('en-US', { timeZone: 'Asia/Tokyo' });
    document.getElementById('current-time').textContent = now.split(',')[1];
}

updateTime();
setInterval(updateTime, 1000);

function toggleDisplay() {
    let dialog = document.getElementById('contactDialog');
    if (dialog.style.display == "none") {
        dialog.style.display = "block"
        dialog.style.display = "flex"
    } else {
        dialog.style.display = "none"
    }
}
function toggleTab() {
    let icon = document.getElementById('tab-icon')
    let tab = document.getElementById('sub-menu')

    if (icon.style.rotate == '180deg') {
        icon.style.rotate = '0deg'
    } else {
        icon.style.rotate = '180deg'
    }

    tab.classList.toggle('d-none');
}

function toggleMenu() {
    let menu = document.getElementById("menu");
    menu.style.display = (menu.style.display === "none") ? "block" : "none";
}

function responsiveMenu() {
    let menu = document.getElementById("menu");

}
if (window.innerWidth < 1007) {
    document.getElementById("menu").style.display = "none";
}