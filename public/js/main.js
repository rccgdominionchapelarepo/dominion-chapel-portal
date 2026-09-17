// Mobile Menu Keyboard Navigation & Accessibility (a11y)
const burger = document.getElementById("burgerBtn");
const links = document.getElementById("navLinks");

function toggleMenu(forceOpen) {
    const isOpen =
        forceOpen !== undefined ? forceOpen : !links.classList.contains("open");

    links.classList.toggle("open", isOpen);
    burger.setAttribute("aria-expanded", isOpen);
    burger.innerHTML = isOpen ? "✕" : "☰";

    if (isOpen) {
        const firstLink = links.querySelector("a, button");
        if (firstLink) firstLink.focus();
        document.body.style.overflow = "hidden"; // Prevent background scrolling
    } else {
        document.body.style.overflow = "";
        burger.focus();
    }
}

burger.addEventListener("click", () => toggleMenu());

// Close menu when clicking nav links (that aren't dropdown toggles)
links.querySelectorAll("a:not(.dropdown-toggle)").forEach((a) => {
    a.addEventListener("click", () => toggleMenu(false));
});

// Close menu on Escape key press
document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && links.classList.contains("open")) {
        toggleMenu(false);
    }
});

// Trap focus inside menu when open
document.addEventListener("keydown", (e) => {
    if (!links.classList.contains("open")) return;

    const focusables = [burger, ...links.querySelectorAll("a, button")];
    const first = focusables[0];
    const last = focusables[focusables.length - 1];

    if (e.key === "Tab") {
        if (e.shiftKey) {
            // Shift + Tab
            if (document.activeElement === first) {
                last.focus();
                e.preventDefault();
            }
        } else {
            // Tab
            if (document.activeElement === last) {
                first.focus();
                e.preventDefault();
            }
        }
    }
});

// --- Dropdown Toggles and Mobile Accordion ---
document.addEventListener("DOMContentLoaded", () => {
    const dropdowns = document.querySelectorAll(".nav-dropdown");

    dropdowns.forEach((dd) => {
        const toggle = dd.querySelector(".dropdown-toggle");
        const menu = dd.querySelector(".dropdown-menu");
        let closeTimeout = null;

        function openDropdown() {
            clearTimeout(closeTimeout);
            dropdowns.forEach((other) => {
                if (other !== dd) {
                    other.classList.remove("active");
                    other
                        .querySelector(".dropdown-toggle")
                        .setAttribute("aria-expanded", "false");
                }
            });
            dd.classList.add("active");
            toggle.setAttribute("aria-expanded", "true");
        }

        function closeDropdown() {
            // 150ms delay before closing to avoid flickering when mouse crosses gaps
            closeTimeout = setTimeout(() => {
                dd.classList.remove("active");
                toggle.setAttribute("aria-expanded", "false");
            }, 150);
        }

        // Desktop Hover Action
        dd.addEventListener("mouseenter", openDropdown);
        dd.addEventListener("mouseleave", closeDropdown);

        // Keyboard Focus Action
        toggle.addEventListener("focus", openDropdown);

        // Close when focus leaves the entire dropdown component
        dd.addEventListener("focusout", (e) => {
            if (!dd.contains(e.relatedTarget)) {
                closeDropdown();
            }
        });

        // Mobile/Tablet Accordion click listener
        toggle.addEventListener("click", (e) => {
            // If mobile width, expand/collapse accordion in place
            if (window.innerWidth <= 900) {
                e.preventDefault();
                e.stopPropagation();

                const isActive = dd.classList.contains("active");

                // Close other accordions
                dropdowns.forEach((other) => {
                    if (other !== dd) {
                        other.classList.remove("active");
                        other
                            .querySelector(".dropdown-toggle")
                            .setAttribute("aria-expanded", "false");
                    }
                });

                if (!isActive) {
                    dd.classList.add("active");
                    toggle.setAttribute("aria-expanded", "true");
                } else {
                    dd.classList.remove("active");
                    toggle.setAttribute("aria-expanded", "false");
                }
            }
        });
    });

    // Close dropdowns when clicking anywhere outside
    document.addEventListener("click", (e) => {
        if (!e.target.closest(".nav-dropdown")) {
            dropdowns.forEach((dd) => {
                dd.classList.remove("active");
                dd.querySelector(".dropdown-toggle").setAttribute(
                    "aria-expanded",
                    "false",
                );
            });
        }
    });
});

// Scroll Reveal Observer
const io = new IntersectionObserver(
    (entries) => {
        entries.forEach((e) => {
            if (e.isIntersecting) e.target.classList.add("in");
        });
    },
    { threshold: 0.12 },
);

document.querySelectorAll(".reveal").forEach((el) => io.observe(el));
