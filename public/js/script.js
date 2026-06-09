function loadPage(url) {
    window.location.href = url;
}



function closeGroup(countCountry, countGroups) {
    $("#closeGroup").show();
    $("#buttonCloseGroup").hide();

}

function changeSession(url, number, route) {
    window.location.href = url + '?number=' + number + '&route=' + route;
}


