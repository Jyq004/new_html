function search() {
    var input = document.getElementById("input-box").value.toLowerCase().trim('');

    var pageMappings = {
        'adopt': 'adopt.php',
        'gallery': 'gallery.php',
        'surrender': 'surrender.php',
        'shop': 'gallery.html',
        'report': 'gallery.html',
        'donation': 'gallery.html',
        'volunter': 'volunteer.php',
        'event': 'event.php',
        'news letter': 'gallery.html',
        'blog': 'viewblog.php',
        'education': 'edupage.php',
        'faq': 'faq.html',
        'home':'index.php'
    };

    if (input in pageMappings) {
        window.location.href = pageMappings[input];
    } else {
        alert("No matching found for your search.");
    }
}

document.getElementById("input-box").addEventListener("keyup", function(event) {
    if (event.key === "Enter") {
        search();
    }
});