export default function getCurrentDate(string) {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, "0");
    var mm = String(today.getMonth() + 1).padStart(2, "0");
    var yyyy = today.getFullYear();

    today = yyyy + "/" + mm + "/" + dd;

    if (string == "date") {
        return dd;
    } else if (string == "month") {
        return mm;
    } else if (string == "year") {
        return yyyy;
    } else if (string == "all") {
        return today;
    } else {
        return false;
    }
}
