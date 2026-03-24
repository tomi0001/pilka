function loadPage(url) {
    window.location.href = url;
}
// function sortByColumn(colIdx) {
// {
//   let table = document.getElementById("groupTable");
//   let rows = Array.from(table.rows).slice(1); // Pomijamy nagłówek

//   rows.sort((a, b) => {
//     let cellA = a.cells[colIdx].innerText;
//     let cellB = b.cells[colIdx].innerText;
//     // Sortowanie numeryczne lub tekstowe
//     return isNaN(cellA) ? cellA.localeCompare(cellB) : cellA - cellB;
//   });

//   // Dodaj posortowane wiersze z powrotem
//   rows.forEach(row => table.appendChild(row));
// }
// }
function sortByColumn(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("groupTable");
  switching = true;
  // Ustawienie domyślnego sortowania na rosnące
  dir = "asc";

  while (switching) {
    switching = false;
    rows = table.rows;

    // Pętla przez wszystkie wiersze (z wyłączeniem nagłówka)
    for (i = 1; i < (rows.length - 1); i++) {
      shouldSwitch = false;
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];

      // Sprawdzanie kierunku sortowania
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      }
    }

    if (shouldSwitch) {
      // Zamiana wierszy miejscami
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      switchcount ++;
    } else {
      // Jeśli nie było zamiany, przełącz kierunek
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
