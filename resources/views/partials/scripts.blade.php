<script>
(function () {
    "use strict";

    /* ---------- Navbar scroll state ---------- */
    var navbar = document.getElementById("navbar");
    function onScroll() {
        if (navbar) navbar.classList.toggle("scrolled", window.scrollY > 40);
    }
    window.addEventListener("scroll", onScroll, { passive: true });
    onScroll();

    /* ---------- Mobile nav ---------- */
    var toggle = document.getElementById("nav-toggle");
    var menu = document.getElementById("nav-menu");
    var backdrop = document.getElementById("nav-backdrop");

    if (toggle && menu) {
        function setMenu(open) {
            menu.classList.toggle("open", open);
            toggle.classList.toggle("active", open);
            if (backdrop) backdrop.classList.toggle("show", open);
            document.body.classList.toggle("nav-open", open);
            toggle.setAttribute("aria-expanded", open ? "true" : "false");
        }

        toggle.addEventListener("click", function () {
            setMenu(!menu.classList.contains("open"));
        });
        if (backdrop) backdrop.addEventListener("click", function () { setMenu(false); });
        menu.querySelectorAll("a").forEach(function (link) {
            link.addEventListener("click", function () { setMenu(false); });
        });
        window.addEventListener("keydown", function (e) {
            if (e.key === "Escape") setMenu(false);
        });
    }

    /* ---------- Scroll reveal ---------- */
    var revealEls = document.querySelectorAll(".reveal");
    if ("IntersectionObserver" in window) {
        var revealObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add("visible");
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: "0px 0px -40px 0px" });
        revealEls.forEach(function (el) { revealObserver.observe(el); });
    } else {
        revealEls.forEach(function (el) { el.classList.add("visible"); });
    }

    /* ---------- Accordion (details/summary enhancement) ---------- */
    document.querySelectorAll(".accordion-item").forEach(function (item) {
        var summary = item.querySelector("summary");
        if (!summary) return;
        summary.addEventListener("click", function (e) {
            e.preventDefault();
            var isOpen = item.hasAttribute("open");
            document.querySelectorAll(".accordion-item[open]").forEach(function (other) {
                if (other !== item) other.removeAttribute("open");
            });
            if (isOpen) {
                item.removeAttribute("open");
            } else {
                item.setAttribute("open", "");
            }
        });
    });
})();
</script>
