function setActiveNavitem() {
	var navItems = document.getElementById("navbar").childNodes;
	for (var i = 0; i < navItems.length; i++) {
		if (navItems[i].nodeName != "LI") {
			continue;
		}
		var itemPage = navItems[i].firstChild.getAttribute("href").split("/");
		itemPage = itemPage[itemPage.length - 1];
		var currentPage = window.location.pathname.split("/");
		currentPage = currentPage[currentPage.length - 1];
		if (itemPage == currentPage) {
			navItems[i].setAttribute("class", "active");
		}
	}
}